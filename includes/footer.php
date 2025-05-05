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