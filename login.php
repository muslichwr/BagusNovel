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
    $remember = isset($_POST['remember']) ? true : false;
    
    // Validasi input
    if (empty($username) || empty($password)) {
        $error = "Username dan password harus diisi";
    } else {
        // Pada implementasi nyata, verifikasi dari database
        // Untuk demo, kita anggap login berhasil jika:
        // - username: demo
        // - password: demo123
        if ($username === 'demo' && $password === 'demo123') {
            // Set cookie jika "ingat saya" dicentang
            if ($remember) {
                setcookie("user_login", $username, time() + (86400 * 30), "/"); // Cookie berlaku 30 hari
            }
            
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
<div class="main-content" style="margin: 0 auto; float: none;">
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
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Masukkan username" required>
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
                <a href="forgot-password.php" class="forgot-password">Lupa password?</a>
            </div>
            
            <div class="form-group">
                <button type="submit" class="login-button">Login</button>
            </div>
            
            <div class="back-to-login">
                Belum punya akun? <a href="register.php">Daftar sekarang</a>
            </div>
        </form>
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
