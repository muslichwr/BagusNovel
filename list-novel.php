<?php
/**
 * Halaman Daftar Novel BagusNovel
 */

// Informasi halaman
$pageTitle = "BagusNovel | Daftar Novel";
$currentPage = "list-novel";

// Filter dan parameter
$search = $_GET['search'] ?? '';
$category = $_GET['category'] ?? '';
$free = isset($_GET['free']) ? (bool)$_GET['free'] : false;
$featured = isset($_GET['featured']) ? (bool)$_GET['featured'] : false;
$sortBy = $_GET['sort'] ?? 'newest';
$page = max(1, intval($_GET['page'] ?? 1));
$perPage = 10;

// Set judul halaman berdasarkan filter
if (!empty($search)) {
    $pageTitle = "BagusNovel | Hasil Pencarian: " . htmlspecialchars($search);
} elseif ($category === 'popular') {
    $pageTitle = "BagusNovel | Novel Populer";
    $currentPage = "popular";
} elseif ($category === 'new') {
    $pageTitle = "BagusNovel | Novel Terbaru";
    $currentPage = "new";
} elseif ($free) {
    $pageTitle = "BagusNovel | Novel Gratis";
    $currentPage = "free";
} elseif ($featured) {
    $pageTitle = "BagusNovel | Novel Unggulan";
}

// Data kategori
$categories = [
    ["id" => "fantasy", "name" => "Fantasi", "count" => 235],
    ["id" => "scifi", "name" => "Fiksi Ilmiah", "count" => 121],
    ["id" => "romance", "name" => "Romantis", "count" => 186],
    ["id" => "horror", "name" => "Horor", "count" => 98],
    ["id" => "mystery", "name" => "Misteri", "count" => 134],
    ["id" => "action", "name" => "Aksi", "count" => 156],
    ["id" => "comedy", "name" => "Komedi", "count" => 112],
    ["id" => "drama", "name" => "Drama", "count" => 167]
];

// Data novel
$novels = [
    [
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
        "category" => "fantasy",
        "isFeatured" => true,
        "isFree" => false,
        "date" => "2023-06-15"
    ],
    [
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
        "category" => "fantasy",
        "isFeatured" => true,
        "isFree" => false,
        "date" => "2023-07-22"
    ],
    [
        "id" => 3,
        "title" => "Gadis Berkekuatan Super di Kota Akademi",
        "author" => "Suzuki Aya",
        "cover" => "images/covers/cover3.jpg",
        "description" => "Kisah seorang gadis dengan kekuatan tersembunyi yang bersekolah di akademi khusus dan menghadapi berbagai petualangan.",
        "price" => 1400,
        "oldPrice" => 1800,
        "discount" => 22,
        "views" => 9870,
        "likes" => 2450,
        "comments" => 289,
        "category" => "action",
        "isFeatured" => true,
        "isFree" => false,
        "date" => "2023-08-10"
    ],
    [
        "id" => 4,
        "title" => "Kisah Saat Bereinkarnasi Menjadi Penduduk Desa",
        "author" => "Sato Taro",
        "cover" => "images/covers/cover4.jpg",
        "description" => "Karakter utama yang dulunya seorang karyawan kantoran biasa meninggal karena kecelakaan dan bereinkarnasi sebagai penduduk desa di dunia lain. Ini adalah kisah tentang bagaimana ia mengembangkan desa dengan teknologi pertanian.",
        "price" => 1200,
        "oldPrice" => null,
        "discount" => 0,
        "views" => 7240,
        "likes" => 1421,
        "comments" => 156,
        "category" => "drama",
        "isFeatured" => false,
        "isFree" => true,
        "date" => "2023-09-05"
    ],
    [
        "id" => 5,
        "title" => "Kehidupan Tinggal Bersama yang Aneh dengan Hantu",
        "author" => "Yamada Hanako",
        "cover" => "images/covers/cover5.jpg",
        "description" => "Di rumah baru yang ia pindahi, ternyata tinggal seorang hantu gadis cantik namun agak ceroboh. Cerita misteri remaja yang mengungkap rahasia kematian sang gadis.",
        "price" => 1500,
        "oldPrice" => null,
        "discount" => 0,
        "views" => 8129,
        "likes" => 1892,
        "comments" => 237,
        "category" => "horror",
        "isFeatured" => false,
        "isFree" => false,
        "date" => "2023-09-18"
    ],
    [
        "id" => 6,
        "title" => "Penyihir yang Menjalani Kehidupan Santai di Dunia Lain",
        "author" => "Kobayashi Mei",
        "cover" => "images/covers/cover6.jpg",
        "description" => "Cerita slice of life tentang penyihir kuat yang memilih untuk menjalani kehidupan santai meski memiliki kekuatan luar biasa.",
        "price" => 1300,
        "oldPrice" => 1800,
        "discount" => 28,
        "views" => 9540,
        "likes" => 2567,
        "comments" => 312,
        "category" => "comedy",
        "isFeatured" => false,
        "isFree" => false,
        "date" => "2023-10-01"
    ],
];

// Filter data berdasarkan parameter
if (!empty($search)) {
    $novels = array_filter($novels, function($novel) use ($search) {
        return stripos($novel['title'], $search) !== false || 
               stripos($novel['author'], $search) !== false || 
               stripos($novel['description'], $search) !== false;
    });
}

if (!empty($category) && $category !== 'popular' && $category !== 'new') {
    $novels = array_filter($novels, function($novel) use ($category) {
        return $novel['category'] === $category;
    });
} elseif ($category === 'popular') {
    // Sort by views
    usort($novels, function($a, $b) {
        return $b['views'] - $a['views'];
    });
} elseif ($category === 'new') {
    // Sort by date
    usort($novels, function($a, $b) {
        return strtotime($b['date']) - strtotime($a['date']);
    });
}

if ($free) {
    $novels = array_filter($novels, function($novel) {
        return $novel['isFree'] === true;
    });
}

if ($featured) {
    $novels = array_filter($novels, function($novel) {
        return $novel['isFeatured'] === true;
    });
}

// Sort data
if ($sortBy === 'newest') {
    usort($novels, function($a, $b) {
        return strtotime($b['date']) - strtotime($a['date']);
    });
} elseif ($sortBy === 'popularity') {
    usort($novels, function($a, $b) {
        return $b['views'] - $a['views'];
    });
} elseif ($sortBy === 'price_asc') {
    usort($novels, function($a, $b) {
        return $a['price'] - $b['price'];
    });
} elseif ($sortBy === 'price_desc') {
    usort($novels, function($a, $b) {
        return $b['price'] - $a['price'];
    });
}

// Pagination
$totalNovels = count($novels);
$totalPages = ceil($totalNovels / $perPage);
$currentPageNovels = array_slice($novels, ($page - 1) * $perPage, $perPage);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title><?php echo $pageTitle; ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="BagusNovel - Platform Baca Novel Online Terlengkap dengan berbagai genre dan penulis terkenal">
    <link rel="stylesheet" href="styles/css.css">
    <link rel="stylesheet" href="styles/animations.css">
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
                    <input type="text" name="search" placeholder="Cari judul novel, penulis..." class="search-input" value="<?php echo htmlspecialchars($search); ?>">
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
            <a href="list-novel.php" class="nav-tab <?php echo $currentPage === 'list-novel' ? 'active' : ''; ?>">Daftar Novel</a>
            <a href="list-novel.php?category=popular" class="nav-tab <?php echo $currentPage === 'popular' ? 'active' : ''; ?>">Novel Populer</a>
            <a href="list-novel.php?category=new" class="nav-tab <?php echo $currentPage === 'new' ? 'active' : ''; ?>">Rilis Terbaru</a>
            <a href="list-novel.php?free=1" class="nav-tab <?php echo $currentPage === 'free' ? 'active' : ''; ?>">Baca Gratis</a>
        </div>
    </nav>
    
    <!-- Main Container -->
    <div class="main-container">
        <!-- Main Content -->
        <div class="main-content">
            <!-- Filter dan Sorting -->
            <div style="background-color: var(--color-section-bg); padding: 15px; margin-bottom: 15px; border-radius: 3px; border: 1px solid var(--color-section-border);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                    <h1 style="font-size: 16px; margin: 0; color: var(--color-text);">
                        <?php if (!empty($search)): ?>
                            Hasil Pencarian: "<?php echo htmlspecialchars($search); ?>" (<?php echo $totalNovels; ?> novel)
                        <?php elseif ($category === 'popular'): ?>
                            Novel Populer
                        <?php elseif ($category === 'new'): ?>
                            Novel Terbaru
                        <?php elseif ($free): ?>
                            Novel Gratis
                        <?php elseif ($featured): ?>
                            Novel Unggulan
                        <?php else: ?>
                            Semua Novel
                        <?php endif; ?>
                    </h1>
                    
                    <div>
                        <form action="list-novel.php" method="get" style="display: flex; align-items: center;">
                            <?php if (!empty($search)): ?>
                                <input type="hidden" name="search" value="<?php echo htmlspecialchars($search); ?>">
                            <?php endif; ?>
                            
                            <?php if (!empty($category)): ?>
                                <input type="hidden" name="category" value="<?php echo htmlspecialchars($category); ?>">
                            <?php endif; ?>
                            
                            <?php if ($free): ?>
                                <input type="hidden" name="free" value="1">
                            <?php endif; ?>
                            
                            <?php if ($featured): ?>
                                <input type="hidden" name="featured" value="1">
                            <?php endif; ?>
                            
                            <label for="sort" style="font-size: 12px; margin-right: 8px; color: var(--color-secondary-text);">Urutkan:</label>
                            <select name="sort" id="sort" style="padding: 4px 8px; font-size: 12px; border: 1px solid var(--color-input-border); border-radius: 2px; background-color: var(--color-input-bg); color: var(--color-input-text);" onchange="this.form.submit()">
                                <option value="newest" <?php echo $sortBy === 'newest' ? 'selected' : ''; ?>>Terbaru</option>
                                <option value="popularity" <?php echo $sortBy === 'popularity' ? 'selected' : ''; ?>>Popularitas</option>
                                <option value="price_asc" <?php echo $sortBy === 'price_asc' ? 'selected' : ''; ?>>Harga Terendah</option>
                                <option value="price_desc" <?php echo $sortBy === 'price_desc' ? 'selected' : ''; ?>>Harga Tertinggi</option>
                            </select>
                        </form>
                    </div>
                </div>
                
                <div style="display: flex; flex-wrap: wrap; gap: 5px;">
                    <a href="list-novel.php" style="font-size: 12px; padding: 4px 8px; background-color: <?php echo empty($category) && !$free && !$featured ? 'var(--color-active-bg)' : 'var(--color-tab-bg)'; ?>; color: <?php echo empty($category) && !$free && !$featured ? 'white' : 'var(--color-text)'; ?>; border-radius: 2px; text-decoration: none;">Semua</a>
                    
                    <?php foreach($categories as $cat): ?>
                    <a href="list-novel.php?category=<?php echo $cat['id']; ?>" style="font-size: 12px; padding: 4px 8px; background-color: <?php echo $category === $cat['id'] ? 'var(--color-active-bg)' : 'var(--color-tab-bg)'; ?>; color: <?php echo $category === $cat['id'] ? 'white' : 'var(--color-text)'; ?>; border-radius: 2px; text-decoration: none;"><?php echo $cat['name']; ?> (<?php echo $cat['count']; ?>)</a>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <!-- Novel List -->
            <div class="novel-list">
                <?php if (empty($currentPageNovels)): ?>
                <div style="text-align: center; padding: 30px; background-color: var(--color-section-bg); border: 1px solid var(--color-section-border); border-radius: 3px;">
                    <i class="fas fa-book-open" style="font-size: 48px; color: var(--color-secondary-text); margin-bottom: 15px;"></i>
                    <p style="color: var(--color-text); font-size: 14px;">Tidak ada novel yang ditemukan sesuai kriteria pencarian Anda.</p>
                    <a href="list-novel.php" style="display: inline-block; margin-top: 15px; padding: 8px 15px; background-color: var(--color-button-bg); color: var(--color-button-text); border-radius: 2px; font-size: 12px; text-decoration: none;">Lihat Semua Novel</a>
                </div>
                <?php else: ?>
                
                <?php foreach($currentPageNovels as $novel): ?>
                <div class="novel-item">
                    <div class="novel-cover">
                        <img src="<?php echo $novel['cover']; ?>" alt="<?php echo $novel['title']; ?>">
                    </div>
                    <div class="novel-detail">
                        <h3 class="novel-title">
                            <?php echo $novel['title']; ?>
                            <?php if($novel['isFree']): ?>
                            <span class="stamp-tag" style="background-color: #4caf50;">GRATIS</span>
                            <?php endif; ?>
                            <?php if(strtotime($novel['date']) > strtotime('-30 days')): ?>
                            <span class="stamp-tag stamp-new">BARU</span>
                            <?php endif; ?>
                            <?php if($novel['views'] > 9000): ?>
                            <span class="stamp-tag stamp-hot">HOT</span>
                            <?php endif; ?>
                        </h3>
                        <p class="novel-author">Penulis: <?php echo $novel['author']; ?></p>
                        <p class="novel-description"><?php echo $novel['description']; ?></p>
                        <div class="novel-meta">
                            <span><i class="far fa-eye"></i> <?php echo number_format($novel['views']); ?></span>
                            <span><i class="far fa-heart"></i> <?php echo number_format($novel['likes']); ?></span>
                            <span><i class="far fa-comment"></i> <?php echo number_format($novel['comments']); ?></span>
                            <div class="novel-price">
                                <?php if($novel['discount'] > 0): ?>
                                <span style="text-decoration: line-through; font-size: 10px; color: var(--color-secondary-text); margin-right: 5px;"><?php echo number_format($novel['oldPrice']); ?>¥</span>
                                <?php endif; ?>
                                <?php echo $novel['isFree'] ? 'Gratis' : number_format($novel['price']) . '¥'; ?>
                            </div>
                        </div>
                        <a href="detail-novel.php?id=<?php echo $novel['id']; ?>" style="display: inline-block; margin-top: 10px; padding: 5px 10px; background-color: var(--color-button-bg); color: var(--color-button-text); border-radius: 2px; font-size: 11px; text-decoration: none;">
                            <?php echo $novel['isFree'] ? 'Baca Gratis' : 'Lihat Detail'; ?>
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
                <?php endif; ?>
            </div>
            
            <!-- Pagination -->
            <?php if ($totalPages > 1): ?>
            <div style="margin: 20px 0; text-align: center;">
                <div style="display: inline-flex; background-color: var(--color-section-bg); border: 1px solid var(--color-section-border); border-radius: 3px; overflow: hidden;">
                    <?php if ($page > 1): ?>
                    <a href="list-novel.php?<?php echo http_build_query(array_merge($_GET, ['page' => $page - 1])); ?>" style="padding: 6px 12px; font-size: 12px; text-decoration: none; color: var(--color-text); border-right: 1px solid var(--color-section-border);">
                        <i class="fas fa-chevron-left"></i> Prev
                    </a>
                    <?php endif; ?>
                    
                    <?php 
                    $startPage = max(1, $page - 2);
                    $endPage = min($totalPages, $startPage + 4);
                    if ($endPage - $startPage < 4) {
                        $startPage = max(1, $endPage - 4);
                    }
                    ?>
                    
                    <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                    <a href="list-novel.php?<?php echo http_build_query(array_merge($_GET, ['page' => $i])); ?>" style="padding: 6px 12px; font-size: 12px; text-decoration: none; color: <?php echo $i === $page ? 'white' : 'var(--color-text)'; ?>; background-color: <?php echo $i === $page ? 'var(--color-active-bg)' : 'transparent'; ?>; border-right: 1px solid var(--color-section-border);">
                        <?php echo $i; ?>
                    </a>
                    <?php endfor; ?>
                    
                    <?php if ($page < $totalPages): ?>
                    <a href="list-novel.php?<?php echo http_build_query(array_merge($_GET, ['page' => $page + 1])); ?>" style="padding: 6px 12px; font-size: 12px; text-decoration: none; color: var(--color-text);">
                        Next <i class="fas fa-chevron-right"></i>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
        
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Login Box -->
            <div class="sidebar-section">
                <div class="sidebar-header">Area Member</div>
                <div class="sidebar-content">
                    <form action="login.php" method="post" style="padding: 8px;">
                        <div style="margin-bottom: 10px;">
                            <input type="text" name="username" placeholder="Username/Email" style="width: 100%; padding: 6px; font-size: 11px;">
                        </div>
                        <div style="margin-bottom: 10px;">
                            <input type="password" name="password" placeholder="Password" style="width: 100%; padding: 6px; font-size: 11px;">
                        </div>
                        <div style="display: flex; margin-bottom: 10px;">
                            <button type="submit" style="flex: 1; background: #ff6600; color: white; border: none; padding: 6px; font-size: 11px; cursor: pointer;">Login</button>
                            <a href="register.php" style="flex: 1; background: #333; color: white; border: none; padding: 6px; font-size: 11px; text-align: center; margin-left: 5px; text-decoration: none;">Register</a>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Category Box -->
            <div class="sidebar-section">
                <div class="sidebar-header">Kategori Novel</div>
                <div class="sidebar-content">
                    <?php foreach($categories as $cat): ?>
                    <div style="padding: 8px 0; border-bottom: 1px solid var(--color-box-border);">
                        <a href="list-novel.php?category=<?php echo $cat['id']; ?>" style="font-size: 12px; display: flex; justify-content: space-between; color: var(--color-text); text-decoration: none;">
                            <span><?php echo $cat['name']; ?></span>
                            <span style="color: var(--color-secondary-text);"><?php echo $cat['count']; ?></span>
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <!-- Ad Banner -->
            <div class="sidebar-section">
                <div class="sidebar-content" style="padding: 0;">
                    <img src="images/sidebar-ad.jpg" alt="Promo" style="width: 100%;">
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
    </script>
</body>
</html> 