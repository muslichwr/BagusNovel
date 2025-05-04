/**
 * Novel Reader Application JavaScript
 * Menyediakan fungsionalitas interaktif untuk aplikasi baca novel
 */

document.addEventListener('DOMContentLoaded', function() {
    initializeApp();
});

/**
 * Inisialisasi aplikasi
 */
function initializeApp() {
    setupReadingPreferences();
    setupChapterNavigation();
    setupBookmarkSystem();
    setupDarkModeToggle();
    setupFontSizeControls();
    setupReadingProgressTracker();
}

/**
 * Menyiapkan preferensi membaca
 */
function setupReadingPreferences() {
    const savedFontSize = localStorage.getItem('fontSize') || '16px';
    const savedTheme = localStorage.getItem('theme') || 'light';
    
    document.documentElement.style.setProperty('--reading-font-size', savedFontSize);
    if (savedTheme === 'dark') {
        document.body.classList.add('dark-mode');
    }
}

/**
 * Menyiapkan navigasi antar chapter
 */
function setupChapterNavigation() {
    const prevBtn = document.querySelector('.nav-button.prev');
    const nextBtn = document.querySelector('.nav-button.next');
    
    if (prevBtn) {
        prevBtn.addEventListener('click', navigateToPreviousChapter);
    }
    
    if (nextBtn) {
        nextBtn.addEventListener('click', navigateToNextChapter);
    }
}

/**
 * Navigasi ke chapter sebelumnya
 */
function navigateToPreviousChapter() {
    const currentChapter = getCurrentChapter();
    if (currentChapter > 1) {
        navigateToChapter(currentChapter - 1);
    }
}

/**
 * Navigasi ke chapter selanjutnya
 */
function navigateToNextChapter() {
    const currentChapter = getCurrentChapter();
    const totalChapters = getTotalChapters();
    
    if (currentChapter < totalChapters) {
        navigateToChapter(currentChapter + 1);
    }
}

/**
 * Mendapatkan nomor chapter saat ini
 */
function getCurrentChapter() {
    const chapterElement = document.querySelector('.chapter-indicator');
    if (chapterElement) {
        const chapterText = chapterElement.textContent;
        const chapterMatch = chapterText.match(/Chapter (\d+)/);
        if (chapterMatch && chapterMatch[1]) {
            return parseInt(chapterMatch[1], 10);
        }
    }
    return 1;
}

/**
 * Mendapatkan total chapter
 */
function getTotalChapters() {
    const chapterListItems = document.querySelectorAll('.chapter-list li');
    return chapterListItems.length || 1;
}

/**
 * Navigasi ke chapter tertentu
 */
function navigateToChapter(chapterNumber) {
    const novelId = getNovelId();
    if (novelId) {
        window.location.href = `detail-novel.php?id=${novelId}&chapter=${chapterNumber}`;
    }
}

/**
 * Mendapatkan ID novel saat ini
 */
function getNovelId() {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get('id');
}

/**
 * Menyiapkan sistem bookmark
 */
function setupBookmarkSystem() {
    const bookmarkBtn = document.querySelector('.bookmark');
    
    if (bookmarkBtn) {
        bookmarkBtn.addEventListener('click', toggleBookmark);
        
        // Periksa status bookmark
        const novelId = getNovelId();
        const chapter = getCurrentChapter();
        const isBookmarked = checkBookmarkStatus(novelId, chapter);
        
        if (isBookmarked) {
            bookmarkBtn.classList.add('active');
            bookmarkBtn.setAttribute('aria-label', 'Remove Bookmark');
        }
    }
}

/**
 * Periksa status bookmark
 */
function checkBookmarkStatus(novelId, chapter) {
    if (!novelId) return false;
    
    const bookmarks = JSON.parse(localStorage.getItem('bookmarks') || '[]');
    return bookmarks.some(bookmark => 
        bookmark.novelId === novelId && bookmark.chapter === chapter
    );
}

/**
 * Toggle bookmark
 */
function toggleBookmark() {
    const novelId = getNovelId();
    const chapter = getCurrentChapter();
    const novelTitle = document.querySelector('.novel-title').textContent;
    
    if (!novelId) return;
    
    let bookmarks = JSON.parse(localStorage.getItem('bookmarks') || '[]');
    const existingIndex = bookmarks.findIndex(bookmark => 
        bookmark.novelId === novelId && bookmark.chapter === chapter
    );
    
    const bookmarkBtn = document.querySelector('.bookmark');
    
    if (existingIndex >= 0) {
        // Hapus bookmark
        bookmarks.splice(existingIndex, 1);
        bookmarkBtn.classList.remove('active');
        bookmarkBtn.setAttribute('aria-label', 'Bookmark');
        showToast('Bookmark dihapus');
    } else {
        // Tambah bookmark
        bookmarks.push({
            novelId,
            chapter,
            title: novelTitle,
            timestamp: new Date().toISOString()
        });
        bookmarkBtn.classList.add('active');
        bookmarkBtn.setAttribute('aria-label', 'Remove Bookmark');
        showToast('Bookmark ditambahkan');
    }
    
    localStorage.setItem('bookmarks', JSON.stringify(bookmarks));
}

/**
 * Menyiapkan toggle dark mode
 */
function setupDarkModeToggle() {
    const themeToggle = document.querySelector('.theme-toggle');
    
    if (themeToggle) {
        themeToggle.addEventListener('click', function() {
            document.body.classList.toggle('dark-mode');
            
            const isDarkMode = document.body.classList.contains('dark-mode');
            localStorage.setItem('theme', isDarkMode ? 'dark' : 'light');
            
            themeToggle.textContent = isDarkMode ? '☀' : '☽';
        });
        
        // Set initial state
        if (document.body.classList.contains('dark-mode')) {
            themeToggle.textContent = '☀';
        }
    }
}

/**
 * Menyiapkan kontrol ukuran font
 */
function setupFontSizeControls() {
    const decreaseBtn = document.querySelector('.font-size-control.decrease');
    const increaseBtn = document.querySelector('.font-size-control.increase');
    
    if (decreaseBtn) {
        decreaseBtn.addEventListener('click', decreaseFontSize);
    }
    
    if (increaseBtn) {
        increaseBtn.addEventListener('click', increaseFontSize);
    }
}

/**
 * Mengurangi ukuran font
 */
function decreaseFontSize() {
    const currentSize = getCurrentFontSize();
    if (currentSize > 12) {
        setFontSize(currentSize - 2);
    }
}

/**
 * Menambah ukuran font
 */
function increaseFontSize() {
    const currentSize = getCurrentFontSize();
    if (currentSize < 24) {
        setFontSize(currentSize + 2);
    }
}

/**
 * Mendapatkan ukuran font saat ini
 */
function getCurrentFontSize() {
    const fontSizeStr = getComputedStyle(document.documentElement)
        .getPropertyValue('--reading-font-size') || '16px';
    return parseInt(fontSizeStr, 10);
}

/**
 * Mengatur ukuran font
 */
function setFontSize(size) {
    const newSize = `${size}px`;
    document.documentElement.style.setProperty('--reading-font-size', newSize);
    localStorage.setItem('fontSize', newSize);
}

/**
 * Menyiapkan pelacak kemajuan membaca
 */
function setupReadingProgressTracker() {
    const contentElement = document.querySelector('.chapter-content');
    
    if (contentElement) {
        window.addEventListener('scroll', updateReadingProgress);
        
        // Initial progress update
        updateReadingProgress();
    }
}

/**
 * Memperbarui kemajuan membaca
 */
function updateReadingProgress() {
    const contentElement = document.querySelector('.chapter-content');
    const progressBar = document.querySelector('.progress-bar');
    const progressText = document.querySelector('.progress-text');
    
    if (!contentElement || !progressBar) return;
    
    const scrollTop = window.scrollY;
    const contentHeight = contentElement.offsetHeight;
    const windowHeight = window.innerHeight;
    const scrollableDistance = contentHeight - windowHeight;
    
    if (scrollableDistance <= 0) return;
    
    const scrollPercentage = Math.min(
        Math.round((scrollTop / scrollableDistance) * 100),
        100
    );
    
    progressBar.style.width = `${scrollPercentage}%`;
    
    if (progressText) {
        const remainingPercentage = 100 - scrollPercentage;
        const estimatedRemainingMinutes = Math.ceil((remainingPercentage / 100) * getEstimatedReadingTime());
        progressText.textContent = `${scrollPercentage}% · ${estimatedRemainingMinutes} menit tersisa`;
    }
    
    // Simpan kemajuan membaca
    saveReadingProgress(scrollPercentage);
}

/**
 * Mendapatkan perkiraan waktu baca
 */
function getEstimatedReadingTime() {
    const contentElement = document.querySelector('.chapter-content');
    if (!contentElement) return 5;
    
    const wordCount = contentElement.textContent.trim().split(/\s+/).length;
    const wordsPerMinute = 200;
    
    return Math.max(1, Math.ceil(wordCount / wordsPerMinute));
}

/**
 * Simpan kemajuan membaca
 */
function saveReadingProgress(percentage) {
    const novelId = getNovelId();
    const chapter = getCurrentChapter();
    
    if (!novelId) return;
    
    let readingProgress = JSON.parse(localStorage.getItem('readingProgress') || '{}');
    
    if (!readingProgress[novelId]) {
        readingProgress[novelId] = {};
    }
    
    readingProgress[novelId][chapter] = {
        percentage,
        lastRead: new Date().toISOString()
    };
    
    localStorage.setItem('readingProgress', JSON.stringify(readingProgress));
}

/**
 * Menampilkan toast notification
 */
function showToast(message, duration = 3000) {
    let toast = document.getElementById('toast-notification');
    
    if (!toast) {
        toast = document.createElement('div');
        toast.id = 'toast-notification';
        document.body.appendChild(toast);
    }
    
    toast.textContent = message;
    toast.classList.add('show');
    
    setTimeout(() => {
        toast.classList.remove('show');
    }, duration);
} 