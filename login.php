<?php
/**
 * Halaman Login BagusNovel
 */

// Informasi halaman
$pageTitle = "BagusNovel | Login";
$currentPage = "login";

// Include file konfigurasi
require_once('includes/config.php');

// Proses login jika ada POST request
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // Validasi input
    if (empty($username) || empty($password)) {
        $error = "Username dan password harus diisi";
    } else {
        // Pada implementasi nyata, verifikasi dari database
        // Untuk demo, kita anggap login berhasil jika:
        // - username: demo
        // - password: demo123
        if ($username === 'demo' && $password === 'demo123') {
            $success = "Login berhasil! Anda akan dialihkan ke halaman utama.";
            // Redirect ke halaman utama setelah berhasil login
            // Commented out for demo: header('Location: index.php');
        } else {
            $error = "Username atau password tidak valid";
        }
    }
}

// Include header
require_once('includes/header.php');
?>

<!-- Main Content -->
<div class="main-content">
    <div class="login-container">
        <h1 class="login-title">Login ke Akun Anda</h1>
        
        <?php if (!empty($error)): ?>
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
        </div>
        <?php endif; ?>
        
        <?php if (!empty($success)): ?>
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> <?php echo $success; ?>
        </div>
        <?php endif; ?>
        
        <form action="login.php" method="post" class="login-form">
            <div class="form-group">
                <label for="username">Username atau Email</label>
                <input type="text" id="username" name="username" placeholder="Masukkan username atau email" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <div class="password-input-wrapper">
                    <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                    <button type="button" class="password-toggle" onclick="togglePasswordVisibility()">
                        <i class="far fa-eye"></i>
                    </button>
                </div>
            </div>
            
            <div class="form-group remember-forgot">
                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Ingat saya</label>
                </div>
                <a href="#" class="forgot-password">Lupa password?</a>
            </div>
            
            <div class="form-group">
                <button type="submit" class="login-button">Login</button>
            </div>
            
            <div class="login-divider">
                <span>atau masuk dengan</span>
            </div>
            
            <div class="social-login">
                <button type="button" class="social-button google">
                    <i class="fab fa-google"></i> Google
                </button>
                <button type="button" class="social-button facebook">
                    <i class="fab fa-facebook-f"></i> Facebook
                </button>
            </div>
            
            <div class="register-link">
                Belum punya akun? <a href="register.php">Daftar sekarang</a>
            </div>
        </form>
    </div>
</div>

<!-- Sidebar -->
<div class="sidebar">
    <!-- Login Benefits -->
    <div class="sidebar-section">
        <div class="sidebar-header">Keuntungan Member</div>
        <div class="sidebar-content">
            <ul class="benefit-list">
                <li><i class="fas fa-check"></i> Akses ke semua novel premium</li>
                <li><i class="fas fa-check"></i> Bookmark novel favorit</li>
                <li><i class="fas fa-check"></i> Sinkronisasi progres membaca</li>
                <li><i class="fas fa-check"></i> Notifikasi update novel terbaru</li>
                <li><i class="fas fa-check"></i> Bebas iklan</li>
            </ul>
        </div>
    </div>
    
    <!-- FAQ Box -->
    <div class="sidebar-section">
        <div class="sidebar-header">Pertanyaan Umum</div>
        <div class="sidebar-content">
            <div class="faq-item">
                <div class="faq-question">Bagaimana cara mendaftar?</div>
                <div class="faq-answer">Klik link "Daftar sekarang" atau kunjungi halaman Register untuk membuat akun baru.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question">Saya lupa password, apa yang harus dilakukan?</div>
                <div class="faq-answer">Klik link "Lupa password?" di halaman login dan ikuti instruksi selanjutnya.</div>
            </div>
            <div class="faq-item">
                <div class="faq-question">Apakah saya harus membayar untuk membaca?</div>
                <div class="faq-answer">Kami memiliki novel gratis dan premium. Novel premium memerlukan pembayaran.</div>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const icon = document.querySelector('.password-toggle i');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>

<?php 
// Include footer
require_once('includes/footer.php'); 
?> 