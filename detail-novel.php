<?php
/**
 * Halaman Detail Novel BagusNovel
 */

// Informasi halaman
$pageTitle = "BagusNovel | Detail Novel";
$currentPage = "detail-novel";

// Mendapatkan ID novel dari parameter URL
$novelId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Data novel dummy (pada implementasi nyata akan mengambil dari database)
$novels = [
    1 => [
        "id" => 1,
        "title" => "Saat Bereinkarnasi ke Dunia Lain dan Menjadi Penyihir Terkuat",
        "author" => "Tanaka Hiroshi",
        "cover" => "images/covers/cover1.jpg",
        "description" => "Cerita tentang karakter utama yang dipecat dari perusahaannya, kemudian mengalami kecelakaan dan bereinkarnasi ke dunia lain. Ia menemukan bakat sihirnya dan berpetualang bersama Guild Petualang.",
        "price" => 1600,
        "oldPrice" => 2200,
        "discount" => 27,
        "views" => 15670,
        "likes" => 3420,
        "comments" => 487,
        "categories" => ["Fantasi", "Isekai", "Petualangan"],
        "status" => "Selesai",
        "publishDate" => "2023-06-15",
        "pages" => 248,
        "synopsis" => "Nakajima Takeru, seorang karyawan perusahaan IT yang dipecat karena pengurangan karyawan, mengalami kecelakaan saat dalam perjalanan pulang. Ketika ia membuka matanya, ia sudah berada di dunia lain yang dipenuhi pedang dan sihir. 

Di dunia tersebut, ia menemukan bahwa dirinya memiliki kemampuan unik untuk menganalisis dan memodifikasi sihir, sesuatu yang bahkan penyihir terkuat di dunia itu tidak bisa lakukan. Dengan kemampuan barunya, ia bergabung dengan Guild Petualang dan mulai petualangan baru.

Namun, semakin dalam ia masuk ke dalam dunia baru ini, Takeru menyadari bahwa ada ancaman besar yang mengintai kerajaan. Rahasia kekuatan sihirnya dan asal-usul kedatangannya ke dunia tersebut mungkin lebih terkait dengan krisis yang mengancam dunia itu daripada yang ia bayangkan.",
        "chapters" => [
            ["number" => 1, "title" => "Kecelakaan dan Kehidupan Baru", "date" => "2023-06-15", "duration" => 10],
            ["number" => 2, "title" => "Menemukan Kekuatan Sihir", "date" => "2023-06-22", "duration" => 12],
            ["number" => 3, "title" => "Bergabung dengan Guild Petualang", "date" => "2023-06-29", "duration" => 15],
            ["number" => 4, "title" => "Misi Pertama dan Teman Baru", "date" => "2023-07-06", "duration" => 11],
            ["number" => 5, "title" => "Rahasia Kuno Kerajaan", "date" => "2023-07-13", "duration" => 13]
        ],
        "reviews" => [
            [
                "user" => "tanaka_reader",
                "date" => "2023-06-20",
                "rating" => 5,
                "content" => "Perkembangan karakter utama digambarkan dengan sangat baik dan membuat novel ini sangat menarik. Terutama deskripsi ikatan antara karakter utama dan teman-temannya yang luar biasa! Saya berharap ada sekuel."
            ],
            [
                "user" => "novel_lover42",
                "date" => "2023-07-01",
                "rating" => 4,
                "content" => "Alur ceritanya sangat menarik dan tidak bisa ditebak. Hanya saja, ada beberapa bagian yang terasa bertele-tele dan bisa dipotong. Secara keseluruhan, novel yang sangat layak dibaca!"
            ],
            [
                "user" => "isekai_fan",
                "date" => "2023-07-15",
                "rating" => 5,
                "content" => "Salah satu novel isekai terbaik yang pernah saya baca! Penggambaran dunianya sangat detail dan sistem sihirnya unik. Tak sabar menunggu volume berikutnya!"
            ]
        ]
    ],
    2 => [
        "id" => 2,
        "title" => "Kisahku Menjadi Petualang di Dunia Pedang dan Sihir",
        "author" => "Watanabe Kenji",
        "cover" => "images/covers/cover2.jpg",
        "description" => "Petualangan seorang remaja biasa yang tiba-tiba dipanggil ke dunia lain dan harus belajar bertahan hidup dengan kekuatan baru.",
        "price" => 1600,
        "oldPrice" => 2200,
        "discount" => 27,
        "views" => 12340,
        "likes" => 2890,
        "comments" => 345,
        "categories" => ["Fantasi", "Petualangan", "Aksi"],
        "status" => "Berlangsung",
        "publishDate" => "2023-07-22",
        "pages" => 210,
        "synopsis" => "Yamamoto Keita, siswa sekolah menengah biasa, suatu hari tiba-tiba dipanggil ke dunia lain oleh seorang putri kerajaan untuk menjadi pahlawan dan mengalahkan Raja Iblis. Namun, Keita bukanlah siswa atletis atau cerdas, ia hanya remaja biasa yang tidak memiliki bakat khusus.

Di dunia baru ini, ia harus belajar bertahan hidup dan mengembangkan keterampilan bertarungnya dari nol. Berbeda dengan pahlawan lainnya yang dipanggil bersamaan dengannya, Keita tidak diberkati dengan kekuatan luar biasa. Namun, dengan ketekunan dan bantuan teman-teman barunya, ia secara perlahan menjadi lebih kuat.

Petualangan Keita mengajarkannya bahwa menjadi pahlawan bukanlah tentang kekuatan atau sihir, melainkan tentang keberanian dan kebaikan hati.",
        "chapters" => [
            ["number" => 1, "title" => "Pemanggilan ke Dunia Lain", "date" => "2023-07-22", "duration" => 12],
            ["number" => 2, "title" => "Pahlawan Tanpa Kekuatan", "date" => "2023-07-29", "duration" => 13],
            ["number" => 3, "title" => "Pelatihan dan Teman Pertama", "date" => "2023-08-05", "duration" => 10]
        ],
        "reviews" => [
            [
                "user" => "fantasy_reader",
                "date" => "2023-08-01",
                "rating" => 4,
                "content" => "Konsep ceritanya menarik, karakter utama yang tidak memiliki kekuatan khusus di dunia fantasi memberikan sudut pandang yang segar."
            ],
            [
                "user" => "bookworm123",
                "date" => "2023-08-10",
                "rating" => 5,
                "content" => "Saya sangat menikmati perkembangan karakter Keita. Novel ini menunjukkan bahwa kerja keras bisa mengalahkan bakat alami."
            ]
        ]
    ],
    // Tambahkan novel lainnya sesuai kebutuhan
];

// Mengambil data novel berdasarkan ID
$novel = $novels[$novelId] ?? null;

// Jika novel tidak ditemukan, redirect ke halaman daftar novel
if (!$novel) {
    header('Location: list-novel.php');
    exit;
}

// Mengubah judul halaman sesuai judul novel
$pageTitle = "BagusNovel | " . $novel['title'];
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
                <li><a href="login.php">Login</a></li>
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
                <a href="login.php" class="action-button">Login</a>
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
        <div class="main-content">
            <!-- Novel Detail -->
            <div class="pickup-item">
                <h2 class="pickup-title"><?php echo $novel['title']; ?></h2>
                <div style="display: flex; padding: 10px;">
                    <div style="width: 150px; margin-right: 15px;">
                        <img src="<?php echo $novel['cover']; ?>" alt="<?php echo $novel['title']; ?>" style="width: 100%; border: 1px solid #ddd;">
                        <div style="text-align: center; margin-top: 8px;">
                            <span style="display: inline-block; background-color: #e76f51; color: #fff; padding: 3px 6px; font-size: 11px; border-radius: 2px;"><?php echo number_format($novel['price']); ?>¥</span>
                            <?php if ($novel['discount'] > 0): ?>
                            <span style="display: inline-block; background-color: #2a9d8f; color: #fff; padding: 3px 6px; font-size: 11px; border-radius: 2px; margin-left: 5px;"><?php echo $novel['discount']; ?>% OFF</span>
                            <?php endif; ?>
                        </div>
                        <a href="#" style="display: block; background-color: #ff6600; color: #fff; text-align: center; padding: 6px; font-size: 12px; margin-top: 8px; border-radius: 2px; text-decoration: none;">Beli dan Baca</a>
                    </div>
                    <div style="flex: 1;">
                        <div style="margin-bottom: 8px; font-size: 11px;">
                            <?php foreach($novel['categories'] as $category): ?>
                            <span style="display: inline-block; background-color: #4d7eb7; color: #fff; padding: 2px 4px; font-size: 10px; border-radius: 2px; margin-right: 5px;"><?php echo $category; ?></span>
                            <?php endforeach; ?>
                            <span style="display: inline-block; background-color: #e9c46a; color: #fff; padding: 2px 4px; font-size: 10px; border-radius: 2px;"><?php echo $novel['status']; ?></span>
                        </div>
                        <p style="font-size: 11px; margin-bottom: 5px;"><strong>Penulis:</strong> <?php echo $novel['author']; ?></p>
                        <p style="font-size: 11px; margin-bottom: 5px;"><strong>Tanggal Publikasi:</strong> <?php echo $novel['publishDate']; ?></p>
                        <p style="font-size: 11px; margin-bottom: 5px;"><strong>Jumlah Halaman:</strong> <?php echo $novel['pages']; ?> halaman</p>
                        <div style="display: flex; margin-bottom: 10px; font-size: 11px;">
                            <div style="margin-right: 15px;"><i class="far fa-eye"></i> <?php echo number_format($novel['views']); ?> kali dilihat</div>
                            <div style="margin-right: 15px;"><i class="far fa-heart"></i> <?php echo number_format($novel['likes']); ?> suka</div>
                            <div><i class="far fa-comment"></i> <?php echo number_format($novel['comments']); ?> komentar</div>
                        </div>
                        <p style="font-size: 11px; margin-bottom: 10px;"><strong>Sinopsis:</strong></p>
                        <p style="font-size: 11px; line-height: 1.4; margin-bottom: 10px;">
                            <?php echo nl2br($novel['synopsis']); ?>
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Daftar Bab -->
            <div class="pickup-item">
                <h2 class="pickup-title">Daftar Bab</h2>
                <div style="padding: 10px;">
                    <?php foreach ($novel['chapters'] as $chapter): ?>
                    <div style="border-bottom: 1px solid #eee; padding: 6px 0;">
                        <a href="#" style="font-size: 11px; font-weight: 700; text-decoration: none; color: var(--color-link);">Bab <?php echo $chapter['number']; ?>: <?php echo $chapter['title']; ?></a>
                        <p style="font-size: 10px; color: #666; margin-top: 2px;">Diterbitkan <?php echo $chapter['date']; ?> · Waktu baca sekitar <?php echo $chapter['duration']; ?> menit</p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <!-- Ulasan -->
            <div class="pickup-item">
                <h2 class="pickup-title">Ulasan</h2>
                <div style="padding: 10px;">
                    <?php foreach ($novel['reviews'] as $review): ?>
                    <div style="border-bottom: 1px solid #eee; padding: 8px 0; margin-bottom: 10px;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                            <p style="font-size: 11px; font-weight: 700;"><?php echo $review['user']; ?></p>
                            <p style="font-size: 10px; color: #666;"><?php echo $review['date']; ?></p>
                        </div>
                        <div style="margin-bottom: 5px;">
                            <?php for($i = 1; $i <= 5; $i++): ?>
                                <?php if($i <= $review['rating']): ?>
                                <i class="fas fa-star" style="color: #ffcc00; font-size: 10px;"></i>
                                <?php else: ?>
                                <i class="far fa-star" style="color: #ddd; font-size: 10px;"></i>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </div>
                        <p style="font-size: 11px; line-height: 1.4;">
                            <?php echo $review['content']; ?>
                        </p>
                    </div>
                    <?php endforeach; ?>
                    
                    <!-- Form Ulasan -->
                    <div style="margin-top: 15px; border-top: 1px solid #eee; padding-top: 15px;">
                        <h3 style="font-size: 13px; margin-bottom: 10px;">Tulis Ulasan Anda</h3>
                        <form action="#" method="post">
                            <div style="margin-bottom: 10px;">
                                <label style="display: block; font-size: 11px; margin-bottom: 5px;">Rating:</label>
                                <div>
                                    <i class="far fa-star rating-star" style="color: #ddd; font-size: 16px; cursor: pointer;" data-value="1"></i>
                                    <i class="far fa-star rating-star" style="color: #ddd; font-size: 16px; cursor: pointer;" data-value="2"></i>
                                    <i class="far fa-star rating-star" style="color: #ddd; font-size: 16px; cursor: pointer;" data-value="3"></i>
                                    <i class="far fa-star rating-star" style="color: #ddd; font-size: 16px; cursor: pointer;" data-value="4"></i>
                                    <i class="far fa-star rating-star" style="color: #ddd; font-size: 16px; cursor: pointer;" data-value="5"></i>
                                    <input type="hidden" name="rating" id="rating-value" value="0">
                                </div>
                            </div>
                            <div style="margin-bottom: 10px;">
                                <label style="display: block; font-size: 11px; margin-bottom: 5px;">Ulasan Anda:</label>
                                <textarea name="review_content" style="width: 100%; padding: 8px; font-size: 12px; border: 1px solid var(--color-input-border); border-radius: 2px; height: 100px; resize: vertical;"></textarea>
                            </div>
                            <button type="submit" style="background-color: var(--color-button-bg); color: var(--color-button-text); border: none; padding: 8px 15px; font-size: 12px; cursor: pointer; border-radius: 2px;">Kirim Ulasan</button>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Rekomendasi Novel Serupa -->
            <div class="pickup-item">
                <h2 class="pickup-title">Rekomendasi Novel Serupa</h2>
                <div class="novel-list" style="padding: 10px;">
                    <?php 
                    // Hanya menampilkan novel lain (bukan novel yang sedang dilihat)
                    $recommendedNovels = array_filter($novels, function($item) use ($novelId) {
                        return $item['id'] != $novelId;
                    });
                    // Ambil maksimal 2 novel untuk rekomendasi
                    $recommendedNovels = array_slice($recommendedNovels, 0, 2);
                    
                    foreach($recommendedNovels as $recNovel): 
                    ?>
                    <div style="display: flex; margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #eee;">
                        <div style="width: 80px; margin-right: 10px;">
                            <img src="<?php echo $recNovel['cover']; ?>" alt="<?php echo $recNovel['title']; ?>" style="width: 100%; border: 1px solid #ddd;">
                        </div>
                        <div style="flex: 1;">
                            <h4 style="font-size: 12px; margin-bottom: 3px;">
                                <a href="detail-novel.php?id=<?php echo $recNovel['id']; ?>" style="color: var(--color-link); text-decoration: none;">
                                    <?php echo $recNovel['title']; ?>
                                </a>
                            </h4>
                            <p style="font-size: 10px; margin-bottom: 5px; color: #666;">Penulis: <?php echo $recNovel['author']; ?></p>
                            <p style="font-size: 10px; line-height: 1.3; margin-bottom: 5px; color: #333; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;"><?php echo $recNovel['description']; ?></p>
                            <div style="font-size: 10px;">
                                <span style="color: #e76f51; font-weight: 700;"><?php echo number_format($recNovel['price']); ?>¥</span>
                                <?php if (isset($recNovel['oldPrice']) && $recNovel['oldPrice']): ?>
                                <span style="text-decoration: line-through; color: #999; margin-left: 5px;"><?php echo number_format($recNovel['oldPrice']); ?>¥</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Widget Novel Populer -->
            <div class="pickup-item">
                <h2 class="pickup-title">Novel Populer</h2>
                <div class="sidebar-content" style="padding: 10px;">
                    <?php foreach(array_slice($novels, 0, 5) as $index => $popNovel): ?>
                    <div style="display: flex; padding: 5px 0; border-bottom: 1px solid #eee;">
                        <div style="font-size: 16px; font-weight: 700; color: <?php echo $index < 3 ? '#ff6600' : '#999'; ?>; width: 25px;"><?php echo $index + 1; ?></div>
                        <div style="flex: 1;">
                            <a href="detail-novel.php?id=<?php echo $popNovel['id']; ?>" style="font-size: 11px; font-weight: 700; text-decoration: none; color: var(--color-link);"><?php echo $popNovel['title']; ?></a>
                            <p style="font-size: 10px; color: #666; margin-top: 2px;"><?php echo number_format($popNovel['views']); ?> kali dilihat</p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <!-- Widget Kategori -->
            <div class="pickup-item">
                <h2 class="pickup-title">Kategori</h2>
                <div class="sidebar-content" style="padding: 10px;">
                    <div style="display: flex; flex-wrap: wrap; gap: 5px;">
                        <?php 
                        $allCategories = ["Fantasi", "Fiksi Ilmiah", "Romantis", "Horor", "Misteri", "Aksi", "Petualangan", "Isekai", "Komedi", "Drama"];
                        foreach($allCategories as $cat): 
                        ?>
                        <a href="list-novel.php?category=<?php echo strtolower($cat); ?>" style="display: inline-block; background-color: #f5f5f5; color: #333; padding: 3px 8px; border-radius: 12px; font-size: 10px; text-decoration: none;"><?php echo $cat; ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            
            <!-- Widget Penulis Populer -->
            <div class="pickup-item">
                <h2 class="pickup-title">Penulis Populer</h2>
                <div class="sidebar-content" style="padding: 10px;">
                    <div style="display: flex; flex-direction: column; gap: 5px;">
                        <?php 
                        $authors = ["Tanaka Hiroshi", "Watanabe Kenji", "Suzuki Aya", "Sato Taro", "Yamada Hanako"];
                        foreach($authors as $author): 
                        ?>
                        <a href="list-novel.php?search=<?php echo urlencode($author); ?>" style="display: block; padding: 5px 0; border-bottom: 1px solid #eee; font-size: 11px; text-decoration: none; color: var(--color-link);"><?php echo $author; ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
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
        
        // Rating Script
        document.querySelectorAll('.rating-star').forEach(function(star) {
            star.addEventListener('mouseover', function() {
                const value = parseInt(this.getAttribute('data-value'));
                document.querySelectorAll('.rating-star').forEach(function(s, index) {
                    if (index < value) {
                        s.classList.remove('far');
                        s.classList.add('fas');
                        s.style.color = '#ffcc00';
                    } else {
                        s.classList.remove('fas');
                        s.classList.add('far');
                        s.style.color = '#ddd';
                    }
                });
            });
            
            star.addEventListener('click', function() {
                const value = parseInt(this.getAttribute('data-value'));
                document.getElementById('rating-value').value = value;
            });
        });
        
        // Reset stars when mouse leaves rating area
        document.querySelector('.rating-star').parentElement.addEventListener('mouseleave', function() {
            const selectedRating = parseInt(document.getElementById('rating-value').value);
            document.querySelectorAll('.rating-star').forEach(function(s, index) {
                if (index < selectedRating) {
                    s.classList.remove('far');
                    s.classList.add('fas');
                    s.style.color = '#ffcc00';
                } else {
                    s.classList.remove('fas');
                    s.classList.add('far');
                    s.style.color = '#ddd';
                }
            });
        });
    </script>
</body>
</html>
