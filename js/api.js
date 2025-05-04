/**
 * Novel Reader API Handler
 * Menyediakan fungsi untuk komunikasi dengan backend API
 */

/**
 * Kelas utama untuk penanganan API
 */
class NovelAPI {
    constructor() {
        this.baseUrl = ''; // URL base relatif (sama dengan lokasi aplikasi)
        this.cacheTime = 15 * 60 * 1000; // 15 menit dalam milidetik
        this.initializeCache();
    }

    /**
     * Inisialisasi cache
     */
    initializeCache() {
        this.cache = {};
    }

    /**
     * Mendapatkan daftar novel terbaru
     */
    async getLatestNovels(limit = 10, page = 1) {
        const cacheKey = `latest_novels_${limit}_${page}`;
        
        // Cek cache
        const cachedData = this.getFromCache(cacheKey);
        if (cachedData) {
            return cachedData;
        }
        
        try {
            const response = await this.fetchData(`/api/novels/latest?limit=${limit}&page=${page}`);
            this.saveToCache(cacheKey, response);
            return response;
        } catch (error) {
            console.error('Error fetching latest novels:', error);
            throw error;
        }
    }

    /**
     * Mendapatkan novel populer
     */
    async getPopularNovels(limit = 10, page = 1) {
        const cacheKey = `popular_novels_${limit}_${page}`;
        
        // Cek cache
        const cachedData = this.getFromCache(cacheKey);
        if (cachedData) {
            return cachedData;
        }
        
        try {
            const response = await this.fetchData(`/api/novels/popular?limit=${limit}&page=${page}`);
            this.saveToCache(cacheKey, response);
            return response;
        } catch (error) {
            console.error('Error fetching popular novels:', error);
            throw error;
        }
    }

    /**
     * Mendapatkan detail novel
     */
    async getNovelDetail(novelId) {
        const cacheKey = `novel_detail_${novelId}`;
        
        // Cek cache
        const cachedData = this.getFromCache(cacheKey);
        if (cachedData) {
            return cachedData;
        }
        
        try {
            const response = await this.fetchData(`/api/novels/${novelId}`);
            this.saveToCache(cacheKey, response);
            return response;
        } catch (error) {
            console.error(`Error fetching novel detail for ID ${novelId}:`, error);
            throw error;
        }
    }

    /**
     * Mendapatkan daftar chapter novel
     */
    async getNovelChapters(novelId) {
        const cacheKey = `novel_chapters_${novelId}`;
        
        // Cek cache
        const cachedData = this.getFromCache(cacheKey);
        if (cachedData) {
            return cachedData;
        }
        
        try {
            const response = await this.fetchData(`/api/novels/${novelId}/chapters`);
            this.saveToCache(cacheKey, response);
            return response;
        } catch (error) {
            console.error(`Error fetching chapters for novel ID ${novelId}:`, error);
            throw error;
        }
    }

    /**
     * Mendapatkan konten chapter
     */
    async getChapterContent(novelId, chapterNumber) {
        const cacheKey = `chapter_content_${novelId}_${chapterNumber}`;
        
        // Cek cache
        const cachedData = this.getFromCache(cacheKey);
        if (cachedData) {
            return cachedData;
        }
        
        try {
            const response = await this.fetchData(`/api/novels/${novelId}/chapters/${chapterNumber}`);
            this.saveToCache(cacheKey, response);
            return response;
        } catch (error) {
            console.error(`Error fetching chapter ${chapterNumber} for novel ID ${novelId}:`, error);
            throw error;
        }
    }

    /**
     * Mencari novel berdasarkan kata kunci
     */
    async searchNovels(query, limit = 10, page = 1) {
        try {
            return await this.fetchData(`/api/novels/search?query=${encodeURIComponent(query)}&limit=${limit}&page=${page}`);
        } catch (error) {
            console.error('Error searching novels:', error);
            throw error;
        }
    }

    /**
     * Mendapatkan novel berdasarkan genre
     */
    async getNovelsByGenre(genre, limit = 10, page = 1) {
        const cacheKey = `novels_genre_${genre}_${limit}_${page}`;
        
        // Cek cache
        const cachedData = this.getFromCache(cacheKey);
        if (cachedData) {
            return cachedData;
        }
        
        try {
            const response = await this.fetchData(`/api/novels/genre/${encodeURIComponent(genre)}?limit=${limit}&page=${page}`);
            this.saveToCache(cacheKey, response);
            return response;
        } catch (error) {
            console.error(`Error fetching novels for genre ${genre}:`, error);
            throw error;
        }
    }

    /**
     * Mendapatkan rekomendasi novel berdasarkan novel saat ini
     */
    async getRecommendedNovels(novelId, limit = 5) {
        const cacheKey = `recommended_novels_${novelId}_${limit}`;
        
        // Cek cache
        const cachedData = this.getFromCache(cacheKey);
        if (cachedData) {
            return cachedData;
        }
        
        try {
            const response = await this.fetchData(`/api/novels/${novelId}/recommendations?limit=${limit}`);
            this.saveToCache(cacheKey, response);
            return response;
        } catch (error) {
            console.error(`Error fetching recommendations for novel ID ${novelId}:`, error);
            throw error;
        }
    }

    /**
     * Kirim ulasan novel
     */
    async submitReview(novelId, reviewData) {
        try {
            return await this.postData(`/api/novels/${novelId}/reviews`, reviewData);
        } catch (error) {
            console.error(`Error submitting review for novel ID ${novelId}:`, error);
            throw error;
        }
    }

    /**
     * Mendapatkan ulasan novel
     */
    async getNovelReviews(novelId, limit = 10, page = 1) {
        const cacheKey = `novel_reviews_${novelId}_${limit}_${page}`;
        
        // Cek cache
        const cachedData = this.getFromCache(cacheKey);
        if (cachedData) {
            return cachedData;
        }
        
        try {
            const response = await this.fetchData(`/api/novels/${novelId}/reviews?limit=${limit}&page=${page}`);
            this.saveToCache(cacheKey, response);
            return response;
        } catch (error) {
            console.error(`Error fetching reviews for novel ID ${novelId}:`, error);
            throw error;
        }
    }

    /**
     * Fungsi umum untuk fetch data
     */
    async fetchData(endpoint) {
        try {
            const response = await fetch(this.baseUrl + endpoint);
            
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            
            return await response.json();
        } catch (error) {
            console.error(`Error fetching data from ${endpoint}:`, error);
            throw error;
        }
    }

    /**
     * Fungsi umum untuk post data
     */
    async postData(endpoint, data) {
        try {
            const response = await fetch(this.baseUrl + endpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            });
            
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            
            return await response.json();
        } catch (error) {
            console.error(`Error posting data to ${endpoint}:`, error);
            throw error;
        }
    }

    /**
     * Menyimpan data ke cache
     */
    saveToCache(key, data) {
        this.cache[key] = {
            data: data,
            timestamp: Date.now()
        };
    }

    /**
     * Mendapatkan data dari cache
     */
    getFromCache(key) {
        const cachedItem = this.cache[key];
        
        if (!cachedItem) {
            return null;
        }
        
        // Cek apakah cache masih valid
        if (Date.now() - cachedItem.timestamp > this.cacheTime) {
            delete this.cache[key];
            return null;
        }
        
        return cachedItem.data;
    }

    /**
     * Membersihkan cache
     */
    clearCache() {
        this.cache = {};
    }
}

// Inisialisasi API singleton
const novelAPI = new NovelAPI();

/**
 * Data Manager untuk operasi data lokal
 */
class NovelDataManager {
    constructor() {
        this.bookmarks = this.loadBookmarks();
        this.readingProgress = this.loadReadingProgress();
        this.readingHistory = this.loadReadingHistory();
        this.preferences = this.loadPreferences();
    }

    /**
     * Memuat bookmark dari localStorage
     */
    loadBookmarks() {
        return JSON.parse(localStorage.getItem('bookmarks') || '[]');
    }

    /**
     * Memuat kemajuan membaca dari localStorage
     */
    loadReadingProgress() {
        return JSON.parse(localStorage.getItem('readingProgress') || '{}');
    }

    /**
     * Memuat riwayat membaca dari localStorage
     */
    loadReadingHistory() {
        return JSON.parse(localStorage.getItem('readingHistory') || '[]');
    }

    /**
     * Memuat preferensi dari localStorage
     */
    loadPreferences() {
        return JSON.parse(localStorage.getItem('readerPreferences') || '{}');
    }

    /**
     * Menyimpan bookmark
     */
    saveBookmark(novelId, chapterNumber, novelTitle, chapterTitle) {
        const bookmarks = this.loadBookmarks();
        
        // Cek apakah bookmark sudah ada
        const existingIndex = bookmarks.findIndex(bookmark => 
            bookmark.novelId === novelId && bookmark.chapter === chapterNumber
        );
        
        if (existingIndex >= 0) {
            // Update timestamp jika sudah ada
            bookmarks[existingIndex].timestamp = new Date().toISOString();
        } else {
            // Tambah bookmark baru
            bookmarks.push({
                novelId,
                chapter: chapterNumber,
                novelTitle,
                chapterTitle,
                timestamp: new Date().toISOString()
            });
        }
        
        localStorage.setItem('bookmarks', JSON.stringify(bookmarks));
        this.bookmarks = bookmarks;
        
        return bookmarks;
    }

    /**
     * Menghapus bookmark
     */
    removeBookmark(novelId, chapterNumber) {
        let bookmarks = this.loadBookmarks();
        
        // Filter bookmark yang akan dihapus
        bookmarks = bookmarks.filter(bookmark => 
            !(bookmark.novelId === novelId && bookmark.chapter === chapterNumber)
        );
        
        localStorage.setItem('bookmarks', JSON.stringify(bookmarks));
        this.bookmarks = bookmarks;
        
        return bookmarks;
    }

    /**
     * Simpan kemajuan membaca
     */
    saveReadingProgress(novelId, chapterNumber, percentage) {
        const readingProgress = this.loadReadingProgress();
        
        if (!readingProgress[novelId]) {
            readingProgress[novelId] = {};
        }
        
        readingProgress[novelId][chapterNumber] = {
            percentage,
            lastRead: new Date().toISOString()
        };
        
        localStorage.setItem('readingProgress', JSON.stringify(readingProgress));
        this.readingProgress = readingProgress;
        
        // Update reading history
        this.updateReadingHistory(novelId, chapterNumber);
        
        return readingProgress;
    }

    /**
     * Update riwayat membaca
     */
    updateReadingHistory(novelId, chapterNumber) {
        let history = this.loadReadingHistory();
        
        // Cek apakah novel sudah ada di riwayat
        const existingIndex = history.findIndex(item => item.novelId === novelId);
        
        if (existingIndex >= 0) {
            // Hapus entri lama
            history.splice(existingIndex, 1);
        }
        
        // Tambahkan ke awal riwayat (paling baru)
        history.unshift({
            novelId,
            chapter: chapterNumber,
            timestamp: new Date().toISOString()
        });
        
        // Batasi riwayat hingga 20 item
        if (history.length > 20) {
            history = history.slice(0, 20);
        }
        
        localStorage.setItem('readingHistory', JSON.stringify(history));
        this.readingHistory = history;
        
        return history;
    }

    /**
     * Simpan preferensi pembaca
     */
    savePreferences(preferences) {
        const currentPrefs = this.loadPreferences();
        const newPrefs = { ...currentPrefs, ...preferences };
        
        localStorage.setItem('readerPreferences', JSON.stringify(newPrefs));
        this.preferences = newPrefs;
        
        return newPrefs;
    }

    /**
     * Cek status bookmark
     */
    isBookmarked(novelId, chapterNumber) {
        const bookmarks = this.loadBookmarks();
        return bookmarks.some(bookmark => 
            bookmark.novelId === novelId && bookmark.chapter === chapterNumber
        );
    }

    /**
     * Mendapatkan kemajuan membaca untuk novel tertentu
     */
    getNovelProgress(novelId) {
        const readingProgress = this.loadReadingProgress();
        return readingProgress[novelId] || {};
    }

    /**
     * Mendapatkan chapter terakhir yang dibaca untuk novel tertentu
     */
    getLastReadChapter(novelId) {
        const progress = this.getNovelProgress(novelId);
        
        if (Object.keys(progress).length === 0) {
            return null;
        }
        
        let lastReadChapter = null;
        let lastReadTime = 0;
        
        // Temukan chapter dengan waktu baca terakhir
        for (const chapter in progress) {
            const timestamp = new Date(progress[chapter].lastRead).getTime();
            
            if (timestamp > lastReadTime) {
                lastReadTime = timestamp;
                lastReadChapter = chapter;
            }
        }
        
        return lastReadChapter;
    }
}

// Inisialisasi Data Manager singleton
const novelDataManager = new NovelDataManager();
