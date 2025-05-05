<?php
/**
 * Halaman Membaca Novel BagusNovel
 */

// Informasi halaman
$pageTitle = "BagusNovel | Baca Novel";
$currentPage = "read";

// Include file konfigurasi
require_once('includes/config.php');

// Include file data
require_once('includes/data.php');

// Mendapatkan ID novel dan nomor chapter dari parameter URL
$novelId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$chapterNumber = isset($_GET['chapter']) ? intval($_GET['chapter']) : 1;

// Mengambil data novel berdasarkan ID
$novel = getNovelById($novelId);

// Jika novel tidak ditemukan, redirect ke halaman daftar novel
if (!$novel) {
    header('Location: list-novel.php');
    exit;
}

// Mendapatkan data chapter yang diminta
$currentChapter = null;
foreach ($novel['chapters'] as $chapter) {
    if ($chapter['number'] == $chapterNumber) {
        $currentChapter = $chapter;
        break;
    }
}

// Jika chapter tidak ditemukan, gunakan chapter pertama
if (!$currentChapter && !empty($novel['chapters'])) {
    $currentChapter = $novel['chapters'][0];
    $chapterNumber = $currentChapter['number'];
}

// Jika tidak ada chapter sama sekali, redirect ke halaman detail novel
if (!$currentChapter) {
    header('Location: detail-novel.php?id=' . $novelId);
    exit;
}

// Mengubah judul halaman sesuai judul chapter
$pageTitle = "BagusNovel | " . $novel['title'] . " - Bab " . $chapterNumber . ": " . $currentChapter['title'];

// Menentukan chapter sebelumnya dan selanjutnya
$prevChapter = null;
$nextChapter = null;

foreach ($novel['chapters'] as $index => $chapter) {
    if ($chapter['number'] == $chapterNumber) {
        if ($index > 0) {
            $prevChapter = $novel['chapters'][$index - 1];
        }
        if ($index < count($novel['chapters']) - 1) {
            $nextChapter = $novel['chapters'][$index + 1];
        }
        break;
    }
}

// Membuat konten dummy untuk chapter
$chapterContent = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris sodales eget risus sit amet facilisis. Mauris aliquam dolor mauris, at lacinia augue facilisis sed. Cras non quam vel mauris tristique laoreet. Donec id facilisis justo. Morbi vitae tortor nibh. Integer nulla mauris, porttitor et condimentum ut, finibus vel orci. Aenean tempor vulputate tortor, ac venenatis neque vestibulum eget. Nullam et eros et lorem condimentum maximus ut vitae metus. Praesent imperdiet mi eget lectus tempus, quis mattis sapien tempus. Nunc semper eros ut varius ultricies. Nulla ex lectus, viverra eu volutpat sit amet, sollicitudin nec mi. Proin sollicitudin, nisl eget ultricies efficitur, elit lacus porta urna, at ultrices diam magna sit amet neque. Vestibulum aliquet ipsum non metus pellentesque molestie.

Quisque vitae risus risus. Integer eleifend felis in odio vehicula, at ultrices tortor facilisis. Duis a gravida elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Morbi vitae justo at lacus condimentum dapibus. Maecenas sollicitudin nisl luctus, maximus metus et, pretium turpis. Aliquam tempor, mi at aliquet suscipit, quam risus pretium leo, nec faucibus nibh diam a erat.

Duis ut tempus risus. Donec vitae tellus et ante dignissim maximus et ac lacus. Nulla facilisi. Vestibulum eget semper neque. Morbi ut sem malesuada, placerat metus vel, volutpat massa. Vivamus ultricies odio turpis, in scelerisque elit consectetur at. Aenean ipsum massa, facilisis vestibulum finibus vitae, porttitor eget nisl. Nulla feugiat venenatis pellentesque. Aliquam eu hendrerit leo, vel ultricies mauris. Morbi at ipsum et felis tincidunt bibendum. Nulla porta velit sit amet elementum malesuada. In lorem purus, pretium ac maximus eget, porttitor ullamcorper mauris. Aliquam elementum enim ut nisl maximus, nec volutpat felis fringilla. Etiam et purus non nulla ultricies iaculis.

Aenean vulputate ac dolor ut placerat. Aliquam ut neque iaculis, congue lorem in, malesuada sapien. Duis a purus diam. Maecenas ut felis volutpat, dapibus felis sit amet, euismod purus. Aenean pharetra ante in hendrerit eleifend. In tempus porttitor gravida. Fusce a justo ligula. Proin lectus risus, finibus a neque in, lobortis hendrerit ipsum. Sed tincidunt, massa in fermentum placerat, enim nisi euismod nulla, eget euismod felis justo faucibus est. Nunc vitae urna a purus faucibus vulputate rhoncus quis magna. Ut malesuada sollicitudin velit malesuada laoreet. Mauris faucibus facilisis aliquet. Cras dignissim, nulla eget sollicitudin viverra, sem nisl imperdiet mi, id sodales justo turpis sit amet enim. Cras at velit mattis, lobortis nulla id, elementum sem. Vivamus nec nulla fermentum, elementum purus quis, dictum quam. Ut diam orci, gravida non rutrum a, congue id justo.

Aliquam ac leo ultrices, gravida sem id, dapibus orci. Mauris porta semper purus, id mattis massa suscipit id. Nam faucibus iaculis nulla, a vestibulum sapien vehicula eget. Etiam venenatis sagittis quam sit amet aliquam. Sed rutrum congue dui, nec mollis augue suscipit sit amet. Integer vitae metus eu massa molestie consectetur. Mauris ultricies orci eu lectus vulputate tempor. Donec et diam suscipit, consectetur diam nec, molestie orci. Mauris eleifend vitae sem sit amet fermentum. Suspendisse non dignissim quam, eu convallis tortor. Donec id lacus eu lectus consequat semper at sed diam. Etiam placerat tortor nisi, a tincidunt magna dignissim sit amet. Nullam ac nisl molestie, faucibus metus eu, volutpat nisl.";

// Atur opsi sidebar
$showSavedNovels = false;
$showReadingHistory = true;
$showCategories = false;

// Include header
require_once('includes/header.php');
?>

<!-- Main Content -->
<div class="main-content full-width">
    <!-- Novel Reading Area -->
    <div class="reading-container">
        <!-- Reading Header -->
        <div class="reading-header">
            <div class="novel-info">
                <h1 class="novel-title"><?php echo $novel['title']; ?></h1>
                <h2 class="chapter-title">Bab <?php echo $chapterNumber; ?>: <?php echo $currentChapter['title']; ?></h2>
            </div>
            <div class="chapter-navigation">
                <?php if ($prevChapter): ?>
                <a href="read.php?id=<?php echo $novelId; ?>&chapter=<?php echo $prevChapter['number']; ?>" class="chapter-nav-button prev-chapter">
                    <i class="fas fa-chevron-left"></i> Bab Sebelumnya
                </a>
                <?php else: ?>
                <span class="chapter-nav-button disabled">
                    <i class="fas fa-chevron-left"></i> Bab Sebelumnya
                </span>
                <?php endif; ?>
                
                <a href="detail-novel.php?id=<?php echo $novelId; ?>" class="chapter-nav-button chapter-list">
                    <i class="fas fa-list"></i> Daftar Bab
                </a>
                
                <?php if ($nextChapter): ?>
                <a href="read.php?id=<?php echo $novelId; ?>&chapter=<?php echo $nextChapter['number']; ?>" class="chapter-nav-button next-chapter">
                    Bab Selanjutnya <i class="fas fa-chevron-right"></i>
                </a>
                <?php else: ?>
                <span class="chapter-nav-button disabled">
                    Bab Selanjutnya <i class="fas fa-chevron-right"></i>
                </span>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Reading Progress -->
        <div class="reading-progress-bar">
            <div class="progress-indicator" style="width: 0%;"></div>
        </div>
        
        <!-- Chapter Content -->
        <div class="chapter-content">
            <?php
            // Menampilkan konten chapter dalam format paragraf
            $paragraphs = explode("\n\n", $chapterContent);
            foreach ($paragraphs as $paragraph) {
                echo '<p>' . $paragraph . '</p>';
            }
            ?>
        </div>
        
        <!-- Reading Footer -->
        <div class="reading-footer">
            <div class="chapter-navigation">
                <?php if ($prevChapter): ?>
                <a href="read.php?id=<?php echo $novelId; ?>&chapter=<?php echo $prevChapter['number']; ?>" class="chapter-nav-button prev-chapter">
                    <i class="fas fa-chevron-left"></i> Bab Sebelumnya
                </a>
                <?php else: ?>
                <span class="chapter-nav-button disabled">
                    <i class="fas fa-chevron-left"></i> Bab Sebelumnya
                </span>
                <?php endif; ?>
                
                <a href="detail-novel.php?id=<?php echo $novelId; ?>" class="chapter-nav-button chapter-list">
                    <i class="fas fa-list"></i> Daftar Bab
                </a>
                
                <?php if ($nextChapter): ?>
                <a href="read.php?id=<?php echo $novelId; ?>&chapter=<?php echo $nextChapter['number']; ?>" class="chapter-nav-button next-chapter">
                    Bab Selanjutnya <i class="fas fa-chevron-right"></i>
                </a>
                <?php else: ?>
                <span class="chapter-nav-button disabled">
                    Bab Selanjutnya <i class="fas fa-chevron-right"></i>
                </span>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php 
// Include sidebar
require_once('includes/sidebar.php'); 
?>

<!-- Reading Control Panel -->
<div class="reading-controls">
    <div class="reading-control-item">
        <button class="control-button font-decrease">
            <i class="fas fa-font"></i><i class="fas fa-minus"></i>
        </button>
    </div>
    <div class="reading-control-item">
        <button class="control-button font-increase">
            <i class="fas fa-font"></i><i class="fas fa-plus"></i>
        </button>
    </div>
    <div class="reading-control-item">
        <button class="control-button theme-toggle">
            <i class="fas fa-moon"></i>
        </button>
    </div>
    <div class="reading-control-item">
        <button class="control-button bookmark-toggle">
            <i class="far fa-bookmark"></i>
        </button>
    </div>
</div>

<script>
    // Fungsi untuk mengatur ukuran font
    function changeFontSize(direction) {
        const contentElement = document.querySelector('.chapter-content');
        const currentSize = parseInt(window.getComputedStyle(contentElement).fontSize);
        
        if (direction === 'increase') {
            contentElement.style.fontSize = (currentSize + 1) + 'px';
        } else {
            contentElement.style.fontSize = Math.max(12, currentSize - 1) + 'px';
        }
        
        // Simpan preferensi ke localStorage
        localStorage.setItem('reader-font-size', contentElement.style.fontSize);
    }
    
    // Fungsi untuk mengubah tema
    function toggleTheme() {
        const body = document.body;
        const isDarkMode = body.classList.toggle('dark-mode');
        
        // Ubah ikon
        const themeIcon = document.querySelector('.theme-toggle i');
        if (isDarkMode) {
            themeIcon.classList.remove('fa-moon');
            themeIcon.classList.add('fa-sun');
        } else {
            themeIcon.classList.remove('fa-sun');
            themeIcon.classList.add('fa-moon');
        }
        
        // Simpan preferensi ke localStorage
        localStorage.setItem('reader-theme', isDarkMode ? 'dark' : 'light');
    }
    
    // Fungsi untuk bookmark
    function toggleBookmark() {
        const bookmarkButton = document.querySelector('.bookmark-toggle i');
        const isBookmarked = bookmarkButton.classList.toggle('fas');
        bookmarkButton.classList.toggle('far');
        
        // Simpan bookmark ke localStorage
        const novelId = <?php echo $novelId; ?>;
        const chapterNumber = <?php echo $chapterNumber; ?>;
        
        let bookmarks = JSON.parse(localStorage.getItem('bookmarks') || '[]');
        
        if (isBookmarked) {
            // Tambahkan bookmark
            bookmarks.push({
                novelId: novelId,
                chapter: chapterNumber,
                title: '<?php echo addslashes($novel['title']); ?>',
                chapterTitle: '<?php echo addslashes($currentChapter['title']); ?>',
                date: new Date().toISOString()
            });
        } else {
            // Hapus bookmark
            bookmarks = bookmarks.filter(bookmark => 
                !(bookmark.novelId === novelId && bookmark.chapter === chapterNumber)
            );
        }
        
        localStorage.setItem('bookmarks', JSON.stringify(bookmarks));
    }
    
    // Fungsi untuk memperbarui progress bar
    function updateReadingProgress() {
        const contentElement = document.querySelector('.chapter-content');
        const windowHeight = window.innerHeight;
        const contentHeight = contentElement.offsetHeight;
        const scrollTop = window.scrollY || document.documentElement.scrollTop;
        
        // Hitung persentase
        let percentage = (scrollTop / (contentHeight - windowHeight)) * 100;
        percentage = Math.min(100, Math.max(0, percentage)); // Batasi 0-100%
        
        // Update progress bar
        document.querySelector('.progress-indicator').style.width = percentage + '%';
        
        // Simpan progres ke localStorage jika perlu
        if (percentage > 5) {
            saveReadingProgress(percentage);
        }
    }
    
    // Fungsi untuk menyimpan progres
    function saveReadingProgress(percentage) {
        const novelId = <?php echo $novelId; ?>;
        const chapterNumber = <?php echo $chapterNumber; ?>;
        
        let readingProgress = JSON.parse(localStorage.getItem('readingProgress') || '{}');
        
        if (!readingProgress[novelId]) {
            readingProgress[novelId] = {};
        }
        
        readingProgress[novelId][chapterNumber] = {
            percentage: percentage,
            lastRead: new Date().toISOString()
        };
        
        localStorage.setItem('readingProgress', JSON.stringify(readingProgress));
    }
    
    // Inisialisasi
    document.addEventListener('DOMContentLoaded', function() {
        // Atur event listeners
        document.querySelector('.font-decrease').addEventListener('click', function() {
            changeFontSize('decrease');
        });
        
        document.querySelector('.font-increase').addEventListener('click', function() {
            changeFontSize('increase');
        });
        
        document.querySelector('.theme-toggle').addEventListener('click', toggleTheme);
        document.querySelector('.bookmark-toggle').addEventListener('click', toggleBookmark);
        
        // Atur ukuran font dari preferensi yang disimpan
        const savedFontSize = localStorage.getItem('reader-font-size');
        if (savedFontSize) {
            document.querySelector('.chapter-content').style.fontSize = savedFontSize;
        }
        
        // Atur tema dari preferensi yang disimpan
        const savedTheme = localStorage.getItem('reader-theme');
        if (savedTheme === 'dark') {
            toggleTheme();
        }
        
        // Cek status bookmark
        const novelId = <?php echo $novelId; ?>;
        const chapterNumber = <?php echo $chapterNumber; ?>;
        const bookmarks = JSON.parse(localStorage.getItem('bookmarks') || '[]');
        
        const isBookmarked = bookmarks.some(bookmark => 
            bookmark.novelId === novelId && bookmark.chapter === chapterNumber
        );
        
        if (isBookmarked) {
            const bookmarkIcon = document.querySelector('.bookmark-toggle i');
            bookmarkIcon.classList.remove('far');
            bookmarkIcon.classList.add('fas');
        }
        
        // Set up progress tracking
        window.addEventListener('scroll', updateReadingProgress);
        updateReadingProgress(); // Initial update
    });
</script>

<style>
/* Reading Page Styles */
.full-width {
    width: 100%;
    max-width: 800px;
    margin: 0 auto;
    float: none;
}

.reading-container {
    background: #fff;
    border: 1px solid #e0e0e0;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    margin-bottom: 20px;
    position: relative;
}

.reading-header {
    padding: 15px;
    border-bottom: 1px solid #eee;
}

.novel-title {
    font-size: 18px;
    font-weight: bold;
    margin: 0 0 5px 0;
    color: #333;
}

.chapter-title {
    font-size: 16px;
    margin: 0 0 10px 0;
    color: #666;
}

.chapter-navigation {
    display: flex;
    justify-content: space-between;
    margin-top: 15px;
}

.chapter-nav-button {
    display: inline-block;
    padding: 8px 12px;
    background-color: #f5f5f5;
    border: 1px solid #ddd;
    color: #333;
    text-decoration: none;
    font-size: 12px;
    border-radius: 3px;
    transition: all 0.2s;
}

.chapter-nav-button:hover {
    background-color: #e9e9e9;
}

.chapter-nav-button.disabled {
    color: #aaa;
    cursor: not-allowed;
    background-color: #f9f9f9;
}

.reading-progress-bar {
    height: 4px;
    background-color: #f0f0f0;
    position: relative;
}

.progress-indicator {
    height: 100%;
    background-color: #ff6600;
    width: 0%;
    transition: width 0.3s;
}

.chapter-content {
    padding: 20px;
    line-height: 1.8;
    font-size: 16px;
    color: #333;
}

.chapter-content p {
    margin-bottom: 1.5em;
    text-align: justify;
}

.reading-footer {
    padding: 15px;
    border-top: 1px solid #eee;
}

/* Reading Controls */
.reading-controls {
    position: fixed;
    right: 20px;
    top: 50%;
    transform: translateY(-50%);
    display: flex;
    flex-direction: column;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.reading-control-item {
    padding: 8px;
    border-bottom: 1px solid #eee;
}

.reading-control-item:last-child {
    border-bottom: none;
}

.control-button {
    background: none;
    border: none;
    cursor: pointer;
    font-size: 14px;
    color: #666;
    padding: 5px;
}

.control-button:hover {
    color: #ff6600;
}

/* Dark Mode */
body.dark-mode .reading-container {
    background-color: #2d2d2d;
    border-color: #444;
}

body.dark-mode .reading-header,
body.dark-mode .reading-footer {
    border-color: #444;
}

body.dark-mode .novel-title {
    color: #eee;
}

body.dark-mode .chapter-title {
    color: #ccc;
}

body.dark-mode .chapter-content {
    color: #ddd;
}

body.dark-mode .chapter-nav-button {
    background-color: #444;
    border-color: #555;
    color: #eee;
}

body.dark-mode .chapter-nav-button:hover {
    background-color: #555;
}

body.dark-mode .chapter-nav-button.disabled {
    color: #777;
    background-color: #3d3d3d;
}

body.dark-mode .reading-controls {
    background-color: #333;
    border-color: #444;
}

body.dark-mode .reading-control-item {
    border-color: #444;
}

body.dark-mode .control-button {
    color: #ccc;
}

body.dark-mode .control-button:hover {
    color: #ff6600;
}

/* Responsive styles */
@media (max-width: 768px) {
    .reading-controls {
        position: fixed;
        right: 0;
        top: auto;
        bottom: 0;
        left: 0;
        transform: none;
        flex-direction: row;
        justify-content: space-around;
        border-radius: 0;
        border-left: none;
        border-right: none;
    }
    
    .reading-control-item {
        border-bottom: none;
        border-right: 1px solid #eee;
        flex: 1;
        text-align: center;
    }
    
    .reading-control-item:last-child {
        border-right: none;
    }
}
</style>

<?php 
// Include footer
require_once('includes/footer.php'); 
?> 