/**
 * Novel Reader Application Animations
 * Menyediakan animasi dan efek visual untuk pengalaman membaca yang lebih baik
 */

document.addEventListener('DOMContentLoaded', function() {
    initializeAnimations();
});

/**
 * Inisialisasi animasi
 */
function initializeAnimations() {
    setupPageTransitions();
    setupScrollEffects();
    setupHoverEffects();
    setupBackgroundEffects();
    createSakuraEffect();
}

/**
 * Menyiapkan transisi halaman
 */
function setupPageTransitions() {
    // Deteksi klik pada link halaman dan terapkan animasi
    document.querySelectorAll('a:not([target="_blank"])').forEach(link => {
        link.addEventListener('click', function(e) {
            // Jangan terapkan animasi untuk link eksternal atau link dengan modifier
            if (this.getAttribute('target') === '_blank' || 
                e.ctrlKey || e.metaKey || e.shiftKey || 
                this.getAttribute('href').startsWith('#')) {
                return;
            }
            
            e.preventDefault();
            const href = this.getAttribute('href');
            
            // Animasi fade-out
            document.body.classList.add('page-transition-out');
            
            // Navigasi setelah animasi selesai
            setTimeout(() => {
                window.location.href = href;
            }, 500);
        });
    });
    
    // Animasi saat halaman dimuat
    document.body.classList.add('page-transition-in');
    setTimeout(() => {
        document.body.classList.remove('page-transition-in');
    }, 500);
}

/**
 * Menyiapkan efek scroll
 */
function setupScrollEffects() {
    // Fade-in elemen saat di-scroll
    const fadeElements = document.querySelectorAll('.fade-in-element');
    
    // Observer untuk mendeteksi elemen yang terlihat
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1
    });
    
    // Observe semua elemen fade-in
    fadeElements.forEach(el => {
        observer.observe(el);
    });
    
    // Parallax effect pada gambar latar
    window.addEventListener('scroll', function() {
        const scrolled = window.scrollY;
        
        document.querySelectorAll('.parallax-bg').forEach(bg => {
            const speed = bg.getAttribute('data-speed') || 0.5;
            bg.style.transform = `translateY(${scrolled * speed}px)`;
        });
    });
}

/**
 * Menyiapkan efek hover
 */
function setupHoverEffects() {
    // Efek hover pada tombol
    document.querySelectorAll('.btn, .card, .novel-item').forEach(element => {
        element.addEventListener('mouseenter', function() {
            this.classList.add('hover');
        });
        
        element.addEventListener('mouseleave', function() {
            this.classList.remove('hover');
        });
    });
    
    // Efek hover khusus untuk gambar cover novel
    document.querySelectorAll('.novel-cover').forEach(cover => {
        cover.addEventListener('mouseenter', function() {
            this.classList.add('tilt');
        });
        
        cover.addEventListener('mouseleave', function() {
            this.classList.remove('tilt');
        });
    });
}

/**
 * Menyiapkan efek latar belakang
 */
function setupBackgroundEffects() {
    // Efek gelombang pada latar belakang (seperti kertas washi)
    const background = document.querySelector('.washi-background');
    
    if (background) {
        let posX = 0;
        let posY = 0;
        
        document.addEventListener('mousemove', e => {
            posX = e.clientX / window.innerWidth - 0.5;
            posY = e.clientY / window.innerHeight - 0.5;
            
            background.style.transform = `translateX(${posX * 10}px) translateY(${posY * 10}px)`;
        });
    }
    
    // Perubahan tema berdasarkan waktu hari
    const hour = new Date().getHours();
    const body = document.body;
    
    if (hour >= 6 && hour < 10) {
        // Pagi (asahi - matahari terbit)
        body.setAttribute('data-time-theme', 'morning');
    } else if (hour >= 10 && hour < 17) {
        // Siang (hiruma - siang hari)
        body.setAttribute('data-time-theme', 'day');
    } else if (hour >= 17 && hour < 20) {
        // Sore (yuugure - senja)
        body.setAttribute('data-time-theme', 'evening');
    } else {
        // Malam (yoru - malam)
        body.setAttribute('data-time-theme', 'night');
    }
}

/**
 * Menciptakan efek sakura (bunga sakura jatuh)
 */
function createSakuraEffect() {
    const sakuraContainer = document.getElementById('sakura-container');
    
    if (!sakuraContainer) {
        return;
    }
    
    // Jumlah kelopak sakura
    const petalCount = 15;
    
    // Buat kelopak sakura
    for (let i = 0; i < petalCount; i++) {
        createSakuraPetal(sakuraContainer);
    }
}

/**
 * Membuat satu kelopak sakura
 */
function createSakuraPetal(container) {
    const petal = document.createElement('div');
    petal.classList.add('sakura-petal');
    
    // Set posisi awal acak
    const startPositionX = Math.random() * 100;
    const startPositionY = -10;
    
    // Set ukuran dan rotasi acak
    const size = Math.random() * 10 + 5;
    const initialRotation = Math.random() * 360;
    
    // Set durasi animasi acak
    const animationDuration = Math.random() * 10 + 10;
    
    // Set properti CSS
    petal.style.left = `${startPositionX}%`;
    petal.style.top = `${startPositionY}px`;
    petal.style.width = `${size}px`;
    petal.style.height = `${size}px`;
    petal.style.transform = `rotate(${initialRotation}deg)`;
    petal.style.animationDuration = `${animationDuration}s`;
    
    // Tambahkan kelopak ke container
    container.appendChild(petal);
    
    // Hapus kelopak setelah animasi selesai
    setTimeout(() => {
        petal.remove();
        // Buat kelopak baru untuk menggantikannya
        createSakuraPetal(container);
    }, animationDuration * 1000);
}

/**
 * Efek lipatan kertas untuk transisi halaman
 */
function setupPageFoldEffect() {
    const chapterLinks = document.querySelectorAll('.chapter-link');
    
    chapterLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const href = this.getAttribute('href');
            
            // Container untuk efek
            const pageFold = document.createElement('div');
            pageFold.classList.add('page-fold-effect');
            document.body.appendChild(pageFold);
            
            // Trigger animasi
            setTimeout(() => {
                pageFold.classList.add('folding');
                
                // Navigasi setelah animasi
                setTimeout(() => {
                    window.location.href = href;
                }, 1000);
            }, 100);
        });
    });
}

/**
 * Efek tulisan muncul seperti mengetik
 */
function typewriterEffect(element, text, speed = 50) {
    if (!element) return;
    
    element.textContent = '';
    let i = 0;
    
    const timer = setInterval(() => {
        if (i < text.length) {
            element.textContent += text.charAt(i);
            i++;
        } else {
            clearInterval(timer);
        }
    }, speed);
} 