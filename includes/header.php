<?php
/**
 * Header untuk semua halaman BagusNovel
 * Memerlukan variabel $pageTitle dan $currentPage yang sudah dideklarasikan
 */
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title><?php echo $pageTitle; ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="BagusNovel - Platform Baca Novel Online Terlengkap dengan berbagai genre dan penulis terkenal">
    <?php 
    // Muat CSS melalui file khusus
    require_once('includes/head-styles.php'); 
    ?>
    <!-- Font Awesome untuk icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Performance Monitoring Script -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Monitor Performance
        const startTime = performance.now();
        
        // Buat elemen monitor performa
        const perfMonitor = document.createElement('div');
        perfMonitor.className = 'performance-monitor';
        perfMonitor.style.display = 'none';
        document.body.appendChild(perfMonitor);
        
        // Aktifkan monitor dengan tombol F12
        document.addEventListener('keydown', function(e) {
            if (e.key === 'F12') {
                e.preventDefault();
                perfMonitor.style.display = perfMonitor.style.display === 'none' ? 'block' : 'none';
            }
        });
        
        // Hitung performa halaman
        window.addEventListener('load', function() {
            const loadTime = performance.now() - startTime;
            const resourceCount = performance.getEntriesByType('resource').length;
            const resourceSize = performance.getEntriesByType('resource')
                .reduce((total, resource) => total + (resource.transferSize || 0), 0) / 1024;
            
            let loadClass = 'performance-good';
            if (loadTime > 1000) loadClass = 'performance-warning';
            if (loadTime > 2000) loadClass = 'performance-bad';
            
            perfMonitor.innerHTML = `
                <div><span class="${loadClass}">⏱️ Waktu muat: ${loadTime.toFixed(2)} ms</span></div>
                <div>📦 Resources: ${resourceCount} (${resourceSize.toFixed(2)} KB)</div>
                <div>🧠 Memory: ${(performance.memory?.usedJSHeapSize / 1048576 || 0).toFixed(2)} MB</div>
                <div><small>Tekan F12 untuk menutup panel ini</small></div>
            `;
        });
        
        // Monitor frame rate
        let frameCount = 0;
        let lastTime = performance.now();
        let fps = 0;
        
        function checkFrame() {
            frameCount++;
            const currentTime = performance.now();
            
            if (currentTime - lastTime >= 1000) {
                fps = frameCount;
                frameCount = 0;
                lastTime = currentTime;
                
                const fpsNode = perfMonitor.querySelector('.fps-value');
                if (fpsNode) {
                    let fpsClass = 'performance-good';
                    if (fps < 45) fpsClass = 'performance-warning';
                    if (fps < 30) fpsClass = 'performance-bad';
                    
                    fpsNode.textContent = fps;
                    fpsNode.className = `fps-value ${fpsClass}`;
                } else {
                    const fpsDiv = document.createElement('div');
                    fpsDiv.innerHTML = `🎞️ FPS: <span class="fps-value performance-good">${fps}</span>`;
                    perfMonitor.insertBefore(fpsDiv, perfMonitor.lastChild);
                }
            }
            
            requestAnimationFrame(checkFrame);
        }
        
        requestAnimationFrame(checkFrame);
    });
    </script>
</head>
<body>
    <!-- Header -->
    <div class="header-top-bar">
        <div class="header-top-container">
            <div class="header-top-left">
                <a href="index.php" class="logo">
                    <img src="images/logo.png" alt="BagusNovel">
                    <span>BagusNovel</span>
                </a>
                <ul class="header-nav">
                    <li><a href="index.php" <?php if ($currentPage === 'home') echo 'class="active"'; ?>>Beranda</a></li>
                    <li><a href="list-novel.php" <?php if ($currentPage === 'list-novel') echo 'class="active"'; ?>>Novel</a></li>
                    <li><a href="list-novel.php?project=1" <?php if ($currentPage === 'project') echo 'class="active"'; ?>>Project</a></li>
                    <li><a href="list-novel.php?mirror=1" <?php if ($currentPage === 'mirror') echo 'class="active"'; ?>>Mirror</a></li>
                </ul>
            </div>
            
            <div class="header-top-right">
                <div class="header-search">
                    <form action="list-novel.php" method="get" class="search-form">
                        <input type="text" name="search" placeholder="Cari judul novel, penulis..." class="search-input">
                        <button type="submit" class="search-button"><i class="fas fa-search"></i></button>
                    </form>
                </div>
                
                <div class="user-profile-dropdown">
                    <a href="javascript:void(0);" class="user-avatar" onclick="toggleUserMenu()">
                        <i class="fas fa-user-circle"></i>
                    </a>
                    <div class="user-dropdown-menu" id="userDropdownMenu">
                        <div class="dropdown-header">Menu Pengguna</div>
                        <a href="register.php" class="dropdown-item"><i class="fas fa-book-reader"></i> Rekomendasi Novel</a>
                        <a href="register.php" class="dropdown-item"><i class="fas fa-bookmark"></i> Daftar Bacaan</a>
                        <div class="dropdown-divider"></div>
                        <a href="login.php" class="dropdown-item"><i class="fas fa-sign-in-alt"></i> Login</a>
                        <a href="register.php" class="dropdown-item highlight"><i class="fas fa-user-plus"></i> Daftar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
    function toggleUserMenu() {
        var menu = document.getElementById("userDropdownMenu");
        menu.classList.toggle("show");
        
        // Close the menu when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.user-profile-dropdown')) {
                var dropdowns = document.getElementsByClassName("user-dropdown-menu");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }, { once: true });
    }
    </script>
    
    <!-- Main Container -->
    <div class="main-container"> 