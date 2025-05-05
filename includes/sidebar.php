<?php
/**
 * Komponen sidebar yang digunakan di berbagai halaman BagusNovel
 * File ini berisi sidebar yang bisa digunakan di berbagai halaman
 */

// Pastikan data sudah dimuat
if (!isset($categories) || !isset($popularRankings)) {
    require_once('data.php');
}

// Mendapatkan data novel tersimpan (dalam implementasi nyata, ini akan diambil dari database)
$savedNovels = [
    ["id" => 1, "title" => "Saat Bereinkarnasi ke Dunia Lain dan Menjadi Penyihir Terkuat"],
    ["id" => 3, "title" => "Gadis Berkekuatan Super di Kota Akademi"],
    ["id" => 5, "title" => "Kehidupan Tinggal Bersama yang Aneh dengan Hantu"]
];

// Mendapatkan data riwayat bacaan (dalam implementasi nyata, ini akan diambil dari database)
$readingHistory = [
    ["novel_id" => 1, "novel_title" => "Saat Bereinkarnasi ke Dunia Lain dan Menjadi Penyihir Terkuat", 
     "chapter" => 5, "chapter_title" => "Misi Pertama", "date" => "2023-10-16"],
    ["novel_id" => 2, "novel_title" => "Kisahku Menjadi Petualang di Dunia Pedang dan Sihir", 
     "chapter" => 3, "chapter_title" => "Latihan Pertama", "date" => "2023-10-14"],
    ["novel_id" => 5, "novel_title" => "Kehidupan Tinggal Bersama yang Aneh dengan Hantu", 
     "chapter" => 1, "chapter_title" => "Rumah Baru", "date" => "2023-10-12"]
];

// Pastikan variabel CSS untuk header.php tersedia
// Ini harus dilakukan di file yang meng-include sidebar.php, sebelum require header.php
// $additionalCSS = isset($additionalCSS) ? $additionalCSS : '';
// $additionalCSS .= '<link rel="stylesheet" href="styles/sidebar-styles.css">';
?>

<!-- Sidebar -->
<div class="sidebar">
    <?php if (isset($showSavedNovels) && $showSavedNovels): ?>
    <!-- Novel Tersimpan -->
    <div class="sidebar-section">
        <div class="sidebar-header">Novel Tersimpan</div>
        <div class="sidebar-content">
            <div class="saved-novels">
                <?php if (empty($savedNovels)): ?>
                <div class="empty-saved">
                    <p>Belum ada novel yang disimpan</p>
                </div>
                <?php else: ?>
                    <?php foreach($savedNovels as $novel): ?>
                    <div class="saved-novel-item">
                        <a href="detail-novel.php?id=<?php echo $novel['id']; ?>" class="saved-novel-title"><?php echo $novel['title']; ?></a>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                
                <div class="view-all-saved">
                    <a href="saved-novels.php" class="view-all-link">Lihat Semua</a>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <?php if (isset($showReadingHistory) && $showReadingHistory): ?>
    <!-- Riwayat Bacaan -->
    <div class="sidebar-section">
        <div class="sidebar-header">Riwayat Bacaan</div>
        <div class="sidebar-content">
            <div class="reading-history">
                <?php if (empty($readingHistory)): ?>
                <div class="empty-history">
                    <p>Belum ada riwayat bacaan</p>
                </div>
                <?php else: ?>
                    <?php foreach($readingHistory as $history): ?>
                    <div class="history-item">
                        <a href="detail-novel.php?id=<?php echo $history['novel_id']; ?>" class="history-novel-title"><?php echo $history['novel_title']; ?></a>
                        <a href="read.php?id=<?php echo $history['novel_id']; ?>&chapter=<?php echo $history['chapter']; ?>" class="history-chapter">
                            Chapter <?php echo $history['chapter']; ?>: <?php echo $history['chapter_title']; ?>
                        </a>
                        <span class="history-date"><?php echo $history['date']; ?></span>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                
                <div class="view-all-history">
                    <a href="reading-history.php" class="view-all-link">Lihat Semua</a>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <?php if (isset($showCategories) && $showCategories): ?>
    <!-- Kategori -->
    <div class="sidebar-section">
        <div class="sidebar-header">Kategori</div>
        <div class="sidebar-content">
            <ul class="category-sidebar-list">
                <?php foreach ($categories as $cat): ?>
                <li class="category-sidebar-item">
                    <a href="list-novel.php?category=<?php echo $cat['id']; ?>" class="category-sidebar-link <?php if (isset($category) && $category === $cat['id']) echo 'active'; ?>">
                        <span class="category-name"><?php echo $cat['name']; ?></span>
                        <span class="category-count"><?php echo $cat['count']; ?></span>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Peringkat Popularitas -->
    <div class="sidebar-section">
        <div class="sidebar-header">Peringkat Popularitas</div>
        <div class="sidebar-content">
            <?php foreach($popularRankings as $index => $novel): ?>
            <div class="ranking-item">
                <span class="ranking-number <?php echo $index < 3 ? 'ranking-number-'.($index+1) : ''; ?>"><?php echo $index + 1; ?></span>
                <a href="detail-novel.php?id=<?php echo $novel['id']; ?>" class="ranking-title"><?php echo $novel['title']; ?></a>
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