<?php
/**
 * Halaman Register BagusNovel
 */

// Informasi halaman
$pageTitle = "BagusNovel | Register";
$currentPage = "register";

// Include file konfigurasi
require_once('includes/config.php');

// Proses registrasi jika ada POST request
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';
    
    // Validasi input
    if (empty($username) || empty($email) || empty($password) || empty($password_confirm)) {
        $error = "Semua bidang harus diisi";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Format email tidak valid";
    } elseif ($password !== $password_confirm) {
        $error = "Konfirmasi password tidak cocok";
    } elseif (strlen($password) < 6) {
        $error = "Password harus minimal 6 karakter";
    } else {
        // Pada implementasi nyata, tambahkan user ke database
        // Untuk demo, kita anggap registrasi berhasil
        $success = "Registrasi berhasil! Silakan login dengan akun baru Anda.";
        // Commented out for demo: header('Location: login.php');
    }
}

// Include header
require_once('includes/header.php');
?>

<!-- Main Content -->
<div class="main-content" style="margin: 0 auto; float: none;">
    <div class="login-container">
        <h1 class="login-title">Daftar Akun Baru</h1>
        
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
        
        <form action="register.php" method="post" class="login-form">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Masukkan username" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Masukkan email" required style="width: 100%; padding: 8px 10px; border: 1px solid var(--color-input-border); border-radius: 3px; font-size: 13px; background-color: var(--color-input-bg); color: var(--color-input-text);">
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <div class="password-input-wrapper">
                    <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                    <button type="button" class="password-toggle" onclick="togglePasswordVisibility('password')">
                        <i class="far fa-eye"></i>
                    </button>
                </div>
            </div>
            
            <div class="form-group">
                <label for="password_confirm">Konfirmasi Password</label>
                <div class="password-input-wrapper">
                    <input type="password" id="password_confirm" name="password_confirm" placeholder="Konfirmasi password" required>
                    <button type="button" class="password-toggle" onclick="togglePasswordVisibility('password_confirm')">
                        <i class="far fa-eye"></i>
                    </button>
                </div>
            </div>
            
            <div class="form-group terms-checkbox">
                <input type="checkbox" id="terms" name="terms" required>
                <label for="terms">Saya menyetujui <a href="#" class="terms-link">Syarat & Ketentuan</a></label>
            </div>
            
            <div class="form-group">
                <button type="submit" class="login-button">Daftar</button>
            </div>
            
            <div class="back-to-login">
                Sudah punya akun? <a href="login.php">Login sekarang</a>
            </div>
        </form>
    </div>
</div>

<script>
    function togglePasswordVisibility(inputId) {
        const passwordInput = document.getElementById(inputId);
        const icon = document.querySelector(`button[onclick="togglePasswordVisibility('${inputId}')"] i`);
        
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
