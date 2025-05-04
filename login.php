<?php
/**
 * Halaman Login BagusNovel
 */

// Informasi halaman
$pageTitle = "BagusNovel | Login";
$currentPage = "login";

// Handling form submission
$errorMessage = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Simulasi proses login
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if ($username === 'admin' && $password === 'password') {
        // Login berhasil
        header('Location: index.php');
        exit;
    } else {
        // Login gagal
        $errorMessage = "Username atau password salah";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title><?php echo $pageTitle; ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/css.css">
    <!-- Font Awesome untuk icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <div class="header-top-bar">
        <div class="header-top-container">
            <div class="header-top-left">
                <span><?php echo date("Y年m月d日"); ?> | BagusNovel - Platform Baca Novel Online Terlengkap</span>
            </div>
            <ul class="header-nav">
                <li><a href="login.php" class="active">Login</a></li>
                <li><a href="register.php">Register</a></li>
            </ul>
        </div>
    </div>
    
    <div class="main-header">
        <div class="header-container">
            <div class="logo-container">
                <a href="index.php" class="logo">
                    <img src="images/logo.png" alt="BagusNovel">
                    <span>BagusNovel</span>
                </a>
            </div>
            
            <div class="header-search">
                <form action="list-novel.php" method="get" class="search-form">
                    <input type="text" name="search" placeholder="Cari judul novel, penulis..." class="search-input">
                    <button type="submit" class="search-button"><i class="fas fa-search"></i></button>
                </form>
            </div>
            
            <div class="user-actions">
                <a href="login.php" class="action-button active">Login</a>
                <a href="register.php" class="action-button orange">Daftar</a>
            </div>
        </div>
    </div>
    
    <!-- Navigation -->
    <nav class="main-nav">
        <div class="nav-container">
            <a href="index.php" class="nav-tab">Beranda</a>
            <a href="list-novel.php" class="nav-tab">Daftar Novel</a>
            <a href="list-novel.php?category=popular" class="nav-tab">Novel Populer</a>
            <a href="list-novel.php?category=new" class="nav-tab">Rilis Terbaru</a>
            <a href="list-novel.php?free=1" class="nav-tab">Baca Gratis</a>
        </div>
    </nav>
    
    <!-- Main Container -->
    <div class="main-container">
        <!-- Main Content -->
        <div class="main-content" style="display: flex; justify-content: center; align-items: center; height: 500px;">
            <div style="width: 350px; background-color: var(--color-section-bg); border: 1px solid var(--color-section-border); padding: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <h2 style="font-size: 16px; text-align: center; margin-bottom: 15px; color: var(--color-text);">Login</h2>
                
                <?php if ($errorMessage): ?>
                <div style="background-color: #ffebee; color: #c62828; padding: 10px; border-radius: 3px; margin-bottom: 15px; font-size: 12px;">
                    <?php echo $errorMessage; ?>
                </div>
                <?php endif; ?>
                
                <form action="login.php" method="post">
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; font-size: 12px; margin-bottom: 5px; color: var(--color-secondary-text);">Email atau Username</label>
                        <input type="text" name="username" style="width: 100%; padding: 8px; font-size: 12px; border: 1px solid var(--color-input-border); border-radius: 2px; background-color: var(--color-input-bg); color: var(--color-input-text);" required>
                    </div>
                    
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; font-size: 12px; margin-bottom: 5px; color: var(--color-secondary-text);">Password</label>
                        <input type="password" name="password" style="width: 100%; padding: 8px; font-size: 12px; border: 1px solid var(--color-input-border); border-radius: 2px; background-color: var(--color-input-bg); color: var(--color-input-text);" required>
                    </div>
                    
                    <div style="display: flex; align-items: center; margin-bottom: 15px;">
                        <input type="checkbox" id="remember" name="remember" style="margin-right: 5px;">
                        <label for="remember" style="font-size: 11px; color: var(--color-secondary-text);">Ingat Informasi Login</label>
                        <a href="#" style="font-size: 11px; margin-left: auto; color: var(--color-link);">Lupa Password?</a>
                    </div>
                    
                    <button type="submit" style="width: 100%; background-color: var(--color-button-bg); color: var(--color-button-text); border: none; padding: 10px; font-size: 13px; cursor: pointer; border-radius: 2px; margin-bottom: 15px;">Login</button>
                    
                    <div style="text-align: center; margin-bottom: 15px;">
                        <span style="font-size: 12px; color: var(--color-secondary-text); display: inline-block; margin-bottom: 10px;">Atau</span>
                        <div style="display: flex; gap: 10px;">
                            <a href="#" style="flex: 1; background-color: #3b5998; color: white; text-align: center; padding: 8px; font-size: 12px; border-radius: 2px; text-decoration: none;"><i class="fab fa-facebook-f"></i> Facebook</a>
                            <a href="#" style="flex: 1; background-color: #1da1f2; color: white; text-align: center; padding: 8px; font-size: 12px; border-radius: 2px; text-decoration: none;"><i class="fab fa-twitter"></i> Twitter</a>
                            <a href="#" style="flex: 1; background-color: #db4437; color: white; text-align: center; padding: 8px; font-size: 12px; border-radius: 2px; text-decoration: none;"><i class="fab fa-google"></i> Google</a>
                        </div>
                    </div>
                    
                    <div style="text-align: center; font-size: 12px;">
                        <span style="color: var(--color-secondary-text);">Belum punya akun?</span>
                        <a href="register.php" style="color: var(--color-link-hover); font-weight: 700;">Daftar Akun Baru</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="site-footer">
        <div class="footer-container">
            <div class="footer-links">
                <a href="#">Tentang Kami</a>
                <a href="#">Syarat dan Ketentuan</a>
                <a href="#">Kebijakan Privasi</a>
                <a href="#">Bantuan</a>
                <a href="#">Kontak</a>
            </div>
            <div class="footer-copyright">
                &copy; <?php echo date('Y'); ?> BagusNovel. All Rights Reserved.
            </div>
        </div>
    </footer>
    
    <!-- Dark Mode Toggle -->
    <button class="dark-mode-toggle" id="darkModeToggle">
        <i class="fas fa-moon"></i>
    </button>
    
    <script>
        // Dark Mode Toggle Script
        document.getElementById('darkModeToggle').addEventListener('click', function() {
            document.body.classList.toggle('dark-mode');
            const icon = this.querySelector('i');
            if (document.body.classList.contains('dark-mode')) {
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
                localStorage.setItem('darkMode', 'enabled');
            } else {
                icon.classList.remove('fa-sun');
                icon.classList.add('fa-moon');
                localStorage.setItem('darkMode', 'disabled');
            }
        });
        
        // Check for saved dark mode preference
        if (localStorage.getItem('darkMode') === 'enabled') {
            document.body.classList.add('dark-mode');
            document.querySelector('.dark-mode-toggle i').classList.remove('fa-moon');
            document.querySelector('.dark-mode-toggle i').classList.add('fa-sun');
        }
    </script>
</body>
</html> 