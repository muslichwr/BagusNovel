<?php
/**
 * Halaman Register BagusNovel
 */

// Informasi halaman
$pageTitle = "BagusNovel | Daftar Akun Baru";
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
        $error = "Semua kolom harus diisi";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Format email tidak valid";
    } elseif (strlen($password) < 6) {
        $error = "Password harus minimal 6 karakter";
    } elseif ($password !== $password_confirm) {
        $error = "Konfirmasi password tidak cocok";
    } else {
        // Pada implementasi nyata, simpan ke database
        // Untuk demo, anggap registrasi berhasil
        $success = "Pendaftaran berhasil! Silakan cek email Anda untuk verifikasi.";
    }
}

// Include header
require_once('includes/header.php');
?>

<!-- Main Content -->
<div class="main-content">
    <div class="register-container">
        <h1 class="register-title">Daftar Akun Baru</h1>
        
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
        
        <form action="register.php" method="post" class="register-form">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Pilih username" required>
                <p class="form-hint">Username akan ditampilkan di profil Anda</p>
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Masukkan email" required>
                <p class="form-hint">Kami akan mengirimkan link verifikasi ke alamat email ini</p>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <div class="password-input-wrapper">
                    <input type="password" id="password" name="password" placeholder="Buat password" required>
                    <button type="button" class="password-toggle" onclick="togglePasswordVisibility('password')">
                        <i class="far fa-eye"></i>
                    </button>
                </div>
                <p class="form-hint">Minimal 6 karakter dengan kombinasi huruf dan angka</p>
            </div>
            
            <div class="form-group">
                <label for="password_confirm">Konfirmasi Password</label>
                <div class="password-input-wrapper">
                    <input type="password" id="password_confirm" name="password_confirm" placeholder="Ulangi password" required>
                    <button type="button" class="password-toggle" onclick="togglePasswordVisibility('password_confirm')">
                        <i class="far fa-eye"></i>
                    </button>
                </div>
            </div>
            
            <div class="form-group terms-checkbox">
                <input type="checkbox" id="terms" name="terms" required>
                <label for="terms">Saya menyetujui <a href="#">Syarat dan Ketentuan</a> serta <a href="#">Kebijakan Privasi</a> BagusNovel</label>
            </div>
            
            <div class="form-group">
                <button type="submit" class="register-button">Daftar Sekarang</button>
            </div>
            
            <div class="login-divider">
                <span>atau daftar dengan</span>
            </div>
            
            <div class="social-login">
                <button type="button" class="social-button google">
                    <i class="fab fa-google"></i> Google
                </button>
                <button type="button" class="social-button facebook">
                    <i class="fab fa-facebook-f"></i> Facebook
                </button>
            </div>
            
            <div class="login-link">
                Sudah punya akun? <a href="login.php">Login di sini</a>
            </div>
        </form>
    </div>
</div>

<!-- Sidebar -->
<div class="sidebar">
    <!-- Features Box -->
    <div class="sidebar-section">
        <div class="sidebar-header">Fitur BagusNovel</div>
        <div class="sidebar-content">
            <div class="feature-item">
                <i class="fas fa-book"></i>
                <div>
                    <h3>Perpustakaan Lengkap</h3>
                    <p>Ribuan novel dari berbagai genre untuk Anda nikmati</p>
                </div>
            </div>
            <div class="feature-item">
                <i class="fas fa-mobile-alt"></i>
                <div>
                    <h3>Baca di Mana Saja</h3>
                    <p>Platform responsif untuk semua perangkat</p>
                </div>
            </div>
            <div class="feature-item">
                <i class="fas fa-bookmark"></i>
                <div>
                    <h3>Bookmark & Lanjutkan</h3>
                    <p>Simpan progres membaca dan lanjutkan kapan saja</p>
                </div>
            </div>
            <div class="feature-item">
                <i class="fas fa-bell"></i>
                <div>
                    <h3>Notifikasi Update</h3>
                    <p>Dapatkan pemberitahuan saat novel favorit diperbarui</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Testimonial Box -->
    <div class="sidebar-section">
        <div class="sidebar-header">Testimoni Pembaca</div>
        <div class="sidebar-content">
            <div class="testimonial">
                <div class="testimonial-content">
                    <p>"BagusNovel adalah platform terbaik untuk membaca novel online. Koleksinya lengkap dan mudah digunakan!"</p>
                </div>
                <div class="testimonial-author">
                    <img src="images/user1.jpg" alt="User">
                    <div>
                        <p class="author-name">Budi Santoso</p>
                        <p class="author-title">Pembaca Aktif</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePasswordVisibility(inputId) {
        const passwordInput = document.getElementById(inputId);
        const icon = document.querySelector('#' + inputId + ' + .password-toggle i');
        
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