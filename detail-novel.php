<?php
/**
 * Halaman Detail Novel BagusNovel
 */

// Informasi halaman
$pageTitle = "BagusNovel | Detail Novel";
$currentPage = "detail-novel";

// Include file konfigurasi
require_once('includes/config.php');

// Include file data
require_once('includes/data.php');

// Mendapatkan ID novel dari parameter URL
$novelId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Mengambil data novel berdasarkan ID
$novel = getNovelById($novelId);

// Jika novel tidak ditemukan, redirect ke halaman daftar novel
if (!$novel) {
    header('Location: list-novel.php');
    exit;
}

// Mengubah judul halaman sesuai judul novel
$pageTitle = "BagusNovel | " . $novel['title'];

// Atur opsi sidebar
$showSavedNovels = false;
$showReadingHistory = true;
$showCategories = false;

// Include header
require_once('includes/header.php');
?>

<!-- Main Content -->
<div class="main-content">
    <!-- Novel Detail -->
    <div class="pickup-item">
        <h2 class="pickup-title"><?php echo $novel['title']; ?></h2>
        <div style="display: flex; padding: 10px;">
            <div style="width: 150px; margin-right: 15px; position: relative;">
                <img src="<?php echo $novel['cover']; ?>" alt="<?php echo $novel['title']; ?>" style="width: 100%; border: 1px solid #ddd;">
                <?php if(isset($novel['isMirror']) && $novel['isMirror']): ?>
                <span style="position: absolute; top: 0; left: 0; font-size: 9px; padding: 2px 4px; color: #fff; background-color: #2a9d8f; border-radius: 0 0 4px 0;">Mirror</span>
                <?php endif; ?>
                <?php if(isset($novel['isProject']) && $novel['isProject']): ?>
                <span style="position: absolute; top: 0; left: 0; font-size: 9px; padding: 2px 4px; color: #fff; background-color: #4d7eb7; border-radius: 0 0 4px 0;">Project</span>
                <?php endif; ?>
                <div style="text-align: center; margin-top: 8px;">
                    <?php if(isset($novel['isMirror']) && $novel['isMirror']): ?>
                    <span style="display: inline-block; background-color: #2a9d8f; color: #fff; padding: 3px 6px; font-size: 11px; border-radius: 2px;">Mirror</span>
                    <?php endif; ?>
                    <?php if(isset($novel['isProject']) && $novel['isProject']): ?>
                    <span style="display: inline-block; background-color: #4d7eb7; color: #fff; padding: 3px 6px; font-size: 11px; border-radius: 2px;">Project</span>
                    <?php endif; ?>
                </div>
                <a href="read.php?id=<?php echo $novel['id']; ?>&chapter=1" style="display: block; background-color: #ff6600; color: #fff; text-align: center; padding: 6px; font-size: 12px; margin-top: 8px; border-radius: 2px; text-decoration: none;">Baca Sekarang</a>
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
                    <?php echo nl2br($novel['synopsis'] ?? ''); ?>
                </p>
            </div>
        </div>
    </div>
    
    <!-- Daftar Bab -->
    <?php if (isset($novel['chapters']) && count($novel['chapters']) > 0): ?>
    <div class="pickup-item">
        <h2 class="pickup-title">Daftar Bab</h2>
        <div style="padding: 10px;">
            <?php 
            // Mendapatkan 10 chapter terbaru
            $latestChapters = array_slice(array_reverse($novel['chapters']), 0, 10);
            ?>
            
            <!-- Chapter Terbaru -->
            <div class="latest-chapters">
                <h3 style="font-size: 14px; margin-bottom: 10px;">10 Chapter Terbaru</h3>
                <?php foreach ($latestChapters as $chapter): ?>
                <div style="border-bottom: 1px solid #eee; padding: 6px 0;">
                    <a href="read.php?id=<?php echo $novel['id']; ?>&chapter=<?php echo $chapter['number']; ?>" style="font-size: 11px; font-weight: 700; text-decoration: none; color: var(--color-link);">Bab <?php echo $chapter['number']; ?>: <?php echo $chapter['title']; ?></a>
                    <p style="font-size: 10px; color: #666; margin-top: 2px;">Diterbitkan <?php echo $chapter['date']; ?> · Waktu baca sekitar <?php echo $chapter['duration']; ?> menit</p>
                </div>
                <?php endforeach; ?>
            </div>
            
            <?php if (count($novel['chapters']) > 10): ?>
            <!-- Tombol Tampilkan Semua Chapter -->
            <div style="text-align: center; margin: 15px 0;">
                <button id="toggleOlderChapters" style="background-color: #f0f0f0; border: 1px solid #ddd; padding: 5px 15px; font-size: 12px; cursor: pointer; border-radius: 3px;">Lihat Semua Chapter</button>
            </div>
            
            <!-- Chapter Lama (Awalnya Tersembunyi) -->
            <div id="olderChapters" style="display: none;">
                <h3 style="font-size: 14px; margin: 15px 0 10px;">Chapter Sebelumnya</h3>
                <?php 
                // Ambil chapter lama (kecuali 10 terbaru)
                $olderChapters = array_slice($novel['chapters'], 0, count($novel['chapters']) - 10);
                ?>
                
                <?php foreach ($olderChapters as $chapter): ?>
                <div style="border-bottom: 1px solid #eee; padding: 6px 0;">
                    <a href="read.php?id=<?php echo $novel['id']; ?>&chapter=<?php echo $chapter['number']; ?>" style="font-size: 11px; font-weight: 700; text-decoration: none; color: var(--color-link);">Bab <?php echo $chapter['number']; ?>: <?php echo $chapter['title']; ?></a>
                    <p style="font-size: 10px; color: #666; margin-top: 2px;">Diterbitkan <?php echo $chapter['date']; ?> · Waktu baca sekitar <?php echo $chapter['duration']; ?> menit</p>
                </div>
                <?php endforeach; ?>
            </div>
            
            <script>
                document.getElementById('toggleOlderChapters').addEventListener('click', function() {
                    var olderChapters = document.getElementById('olderChapters');
                    var toggleButton = document.getElementById('toggleOlderChapters');
                    
                    if (olderChapters.style.display === 'none') {
                        olderChapters.style.display = 'block';
                        toggleButton.textContent = 'Sembunyikan Chapter Lama';
                    } else {
                        olderChapters.style.display = 'none';
                        toggleButton.textContent = 'Lihat Semua Chapter';
                    }
                });
            </script>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Ulasan -->
    <?php if (isset($novel['reviews']) && count($novel['reviews']) > 0): ?>
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
                        <i class="far fa-star" style="color: #ffcc00; font-size: 10px;"></i>
                        <?php endif; ?>
                    <?php endfor; ?>
                </div>
                <p style="font-size: 11px; line-height: 1.4;"><?php echo $review['content']; ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Novel Terkait -->
    <div class="pickup-item">
        <h2 class="pickup-title">Mungkin Anda Juga Suka</h2>
        <div style="padding: 10px; display: flex; flex-wrap: wrap;">
            <?php 
            // Ambil novel terkait berdasarkan kategori yang sama
            $relatedNovels = [];
            if (isset($novel['category'])) {
                $relatedNovels = getNovelsByCategory($novel['category'], 3);
                // Filter novel saat ini dari hasil
                $relatedNovels = array_filter($relatedNovels, function($item) use ($novel) {
                    return $item['id'] != $novel['id'];
                });
            }
            
            // Jika tidak ada novel terkait, tampilkan novel populer
            if (count($relatedNovels) < 2) {
                $relatedNovels = array_slice($featuredNovels, 0, 3);
                // Filter novel saat ini dari hasil
                $relatedNovels = array_filter($relatedNovels, function($item) use ($novel) {
                    return $item['id'] != $novel['id'];
                });
            }
            
            // Tampilkan maksimal 3 novel terkait
            $relatedNovels = array_slice($relatedNovels, 0, 3);
            ?>
            
            <?php foreach($relatedNovels as $relatedNovel): ?>
            <div style="width: 33.33%; padding: 5px;">
                <div style="border: 1px solid #eee; padding: 5px;">
                    <div style="margin-bottom: 5px; position: relative;">
                        <img src="<?php echo $relatedNovel['cover']; ?>" alt="<?php echo $relatedNovel['title']; ?>" style="width: 100%;">
                        <?php if(isset($relatedNovel['isMirror']) && $relatedNovel['isMirror']): ?>
                        <span class="novel-cover-tag tag-mirror">Mirror</span>
                        <?php endif; ?>
                        <?php if(isset($relatedNovel['isProject']) && $relatedNovel['isProject']): ?>
                        <span class="novel-cover-tag tag-project">Project</span>
                        <?php endif; ?>
                    </div>
                    <a href="detail-novel.php?id=<?php echo $relatedNovel['id']; ?>" style="font-size: 11px; font-weight: 700; text-decoration: none; color: var(--color-link); display: block; margin-bottom: 3px;"><?php echo $relatedNovel['title']; ?></a>
                    <p style="font-size: 10px; color: #666; margin-bottom: 3px;"><?php echo $relatedNovel['author']; ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- Sidebar Novel Info Box -->
<div class="sidebar">
    <!-- Novel Info Box -->
    <div class="sidebar-section">
        <div class="sidebar-header">Informasi Novel</div>
        <div class="sidebar-content">
            <div style="font-size: 11px; margin-bottom: 5px;">
                <span style="display: inline-block; width: 70px; color: #666;">Penulis</span>
                <span>: <?php echo $novel['author']; ?></span>
            </div>
            <div style="font-size: 11px; margin-bottom: 5px;">
                <span style="display: inline-block; width: 70px; color: #666;">Publikasi</span>
                <span>: <?php echo $novel['publishDate']; ?></span>
            </div>
            <div style="font-size: 11px; margin-bottom: 5px;">
                <span style="display: inline-block; width: 70px; color: #666;">Status</span>
                <span>: <?php echo $novel['status']; ?></span>
            </div>
            <div style="font-size: 11px; margin-bottom: 5px;">
                <span style="display: inline-block; width: 70px; color: #666;">Halaman</span>
                <span>: <?php echo $novel['pages']; ?></span>
            </div>
            <div style="font-size: 11px; margin-bottom: 5px;">
                <span style="display: inline-block; width: 70px; color: #666;">Genre</span>
                <span>: <?php echo implode(', ', $novel['categories']); ?></span>
            </div>
        </div>
    </div>
    
    <?php require_once('includes/sidebar.php'); ?>
</div>

<?php 
// Include footer
require_once('includes/footer.php'); 
?>
