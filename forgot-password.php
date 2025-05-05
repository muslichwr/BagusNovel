<?php
/**
 * Halaman Lupa Password BagusNovel
 */

// Informasi halaman
$pageTitle = "BagusNovel | Lupa Password";
$currentPage = "forgot-password";

// Include file konfigurasi
require_once('includes/config.php');

// Proses permintaan reset password jika ada POST request
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    
    // Validasi input
    if (empty($username)) {
        $error = "Username harus diisi";
    } else {
        // Pada implementasi nyata, periksa apakah username ada di database
        // lalu kirim email reset password
        // Untuk demo, kita anggap proses berhasil
        $success = "Instruksi reset password telah dikirim ke email yang terkait dengan akun ini. Silakan periksa email Anda.";
    }
}

// Include header
require_once('includes/header.php');
?>

<!-- Main Content -->
<div class="main-content" style="margin: 0 auto; float: none;">
    <div class="login-container">
        <h1 class="login-title">Lupa Password</h1>
        
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
        
        <div class="reset-instructions">
            <p>Masukkan username akun Anda di bawah ini. Kami akan mengirimkan instruksi untuk mengatur ulang password Anda.</p>
        </div>
        
        <form action="forgot-password.php" method="post" class="login-form">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Masukkan username" required>
            </div>
            
            <div class="form-group">
                <button type="submit" class="login-button">Reset Password</button>
            </div>
            
            <div class="back-to-login">
                <a href="login.php"><i class="fas fa-arrow-left"></i> Kembali ke halaman login</a>
            </div>
        </form>
    </div>
</div>

<?php 
// Include footer
require_once('includes/footer.php'); 
?> 