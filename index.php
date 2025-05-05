<?php
/**
 * Halaman Utama BagusNovel
 */

// Informasi halaman
$pageTitle = "BagusNovel | Baca Novel Online Terlengkap";
$currentPage = "home";

// Include file konfigurasi
require_once('includes/config.php');

// Include file data
require_once('includes/data.php');

// Atur opsi sidebar
$showSidebar = true;
$showSavedNovels = true;
$showReadingHistory = true;
$showCategories = true;

// Include header
require_once('includes/header.php');
?>

<!-- Main Content -->
<div class="main-content">
    <!-- Chapter Terbaru -->
    <section class="feature-section">
        <div class="feature-header">
            <h2 class="feature-title"><i class="fas fa-bookmark"></i> Chapter Terbaru</h2>
            <a href="list-novel.php?category=new" class="feature-more">Lihat Semua</a>
        </div>
        
        <div class="novel-list">
            <?php
            // Ambil daftar chapter terbaru dari semua novel tanpa memandang tipe
            $latestChapters = [];
            
            foreach($allNovels as $novel) {
                if(isset($novel['chapters']) && !empty($novel['chapters'])) {
                    // Urutkan chapter berdasarkan tanggal terbaru
                    $chapters = $novel['chapters'];
                    usort($chapters, function($a, $b) {
                        return strtotime($b['date']) - strtotime($a['date']);
                    });
                    
                    // Ambil chapter terbaru dari novel ini
                    $latestChapter = $chapters[0];
                    
                    $latestChapters[] = [
                        'novel_id' => $novel['id'],
                        'novel_title' => $novel['title'],
                        'novel_cover' => $novel['cover'],
                        'novel_author' => $novel['author'],
                        'novel_description' => $novel['description'],
                        'novel_views' => $novel['views'],
                        'novel_likes' => $novel['likes'],
                        'novel_comments' => $novel['comments'],
                        'novel_categories' => $novel['categories'] ?? [],
                        'isProject' => $novel['isProject'] ?? false,
                        'isMirror' => $novel['isMirror'] ?? false,
                        'chapter_number' => $latestChapter['number'],
                        'chapter_title' => $latestChapter['title'],
                        'chapter_date' => $latestChapter['date'],
                        'chapter_duration' => $latestChapter['duration'] ?? 10
                    ];
                }
            }
            
            // Urutkan berdasarkan tanggal chapter terbaru
            usort($latestChapters, function($a, $b) {
                return strtotime($b['chapter_date']) - strtotime($a['chapter_date']);
            });
            
            // Ambil 2 chapter terbaru
            $latestChapters = array_slice($latestChapters, 0, 2);
            
            foreach($latestChapters as $novel):
            ?>
            <div class="novel-item">
                <div class="novel-cover">
                    <img src="<?php echo $novel['novel_cover']; ?>" alt="<?php echo $novel['novel_title']; ?>">
                    <?php if($novel['isMirror']): ?>
                    <span class="novel-cover-tag tag-mirror">Mirror</span>
                    <?php endif; ?>
                    <?php if($novel['isProject']): ?>
                    <span class="novel-cover-tag tag-project">Project</span>
                    <?php endif; ?>
                </div>
                <div class="novel-detail">
                    <h3 class="novel-title">
                        <a href="detail-novel.php?id=<?php echo $novel['novel_id']; ?>"><?php echo $novel['novel_title']; ?></a>
                    </h3>
                    <p class="novel-author">Penulis: <?php echo $novel['novel_author']; ?></p>
                    <p class="novel-description"><?php echo $novel['novel_description']; ?></p>
                    <div class="novel-chapter-update">
                        <a href="read.php?id=<?php echo $novel['novel_id']; ?>&chapter=<?php echo $novel['chapter_number']; ?>">
                            <i class="fas fa-bookmark"></i> Chapter <?php echo $novel['chapter_number']; ?>: <?php echo $novel['chapter_title']; ?>
                        </a>
                        <span class="chapter-date"><i class="far fa-calendar"></i> <?php echo date('d M Y', strtotime($novel['chapter_date'])); ?></span>
                    </div>
                    <div class="novel-meta">
                        <span><i class="far fa-eye"></i> <?php echo number_format($novel['novel_views']); ?></span>
                        <span><i class="far fa-heart"></i> <?php echo number_format($novel['novel_likes']); ?></span>
                        <span><i class="far fa-comment"></i> <?php echo number_format($novel['novel_comments']); ?></span>
                        <?php if(!empty($novel['novel_categories'])): ?>
                        <span><i class="fas fa-tags"></i> <?php echo implode(', ', array_slice($novel['novel_categories'], 0, 2)); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>
</div>

<?php
// Include sidebar
require_once('includes/sidebar.php');

// Include footer
require_once('includes/footer.php'); 
?>
