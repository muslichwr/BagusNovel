<?php
/**
 * Halaman Daftar Novel BagusNovel
 */

// Informasi halaman
$pageTitle = "BagusNovel | Daftar Novel";
$currentPage = "list-novel";

// Include file konfigurasi
require_once('includes/config.php');

// Include file data
require_once('includes/data.php');

// Filter dan parameter
$search = $_GET['search'] ?? '';
$category = $_GET['category'] ?? '';

// Handle novel_type parameter
$novel_type = $_GET['novel_type'] ?? 'all';
// Set mirror dan project berdasarkan novel_type jika ada
if (isset($_GET['novel_type'])) {
    if ($_GET['novel_type'] === 'mirror') {
        $mirror = true;
        $project = false;
    } else if ($_GET['novel_type'] === 'project') {
        $mirror = false;
        $project = true;
    } else if ($_GET['novel_type'] === 'all') {
        $mirror = false;
        $project = false;
    }
} else {
    $mirror = isset($_GET['mirror']) ? (bool)$_GET['mirror'] : false;
    $project = isset($_GET['project']) ? (bool)$_GET['project'] : false;
}

$status = $_GET['status'] ?? 'all';
$sortBy = $_GET['sort'] ?? 'newest';
$page = max(1, intval($_GET['page'] ?? 1));
$perPage = 15;
$viewMode = $_GET['view'] ?? 'list';

// Set judul halaman berdasarkan filter
if (!empty($search)) {
    $pageTitle = "BagusNovel | Hasil Pencarian: " . htmlspecialchars($search);
} elseif ($category === 'popular') {
    $pageTitle = "BagusNovel | Novel Populer";
    $currentPage = "popular";
} elseif ($category === 'new') {
    $pageTitle = "BagusNovel | Novel Terbaru";
    $currentPage = "new";
} elseif ($mirror) {
    $pageTitle = "BagusNovel | Novel Mirror";
    $currentPage = "mirror";
} elseif ($project) {
    $pageTitle = "BagusNovel | Novel Project";
    $currentPage = "project";
}

// Filter novels berdasarkan parameter
$filteredNovels = $allNovels;

if (!empty($search)) {
    $filteredNovels = searchNovels($search);
}

if (!empty($category) && $category !== 'popular' && $category !== 'new') {
    $filteredNovels = getNovelsByCategory($category);
} elseif ($category === 'popular') {
    // Sort by views
    usort($filteredNovels, function($a, $b) {
        return $b['views'] - $a['views'];
    });
} elseif ($category === 'new') {
    // Sort by date
    usort($filteredNovels, function($a, $b) {
        return strtotime($b['date']) - strtotime($a['date']);
    });
}

if ($mirror) {
    $filteredNovels = array_filter($filteredNovels, function($novel) {
        return isset($novel['isMirror']) && $novel['isMirror'] === true;
    });
}

if ($project) {
    $filteredNovels = array_filter($filteredNovels, function($novel) {
        return isset($novel['isProject']) && $novel['isProject'] === true;
    });
}

// Filter berdasarkan status
if ($status === 'completed') {
    $filteredNovels = array_filter($filteredNovels, function($novel) {
        return isset($novel['status']) && strtolower($novel['status']) === 'selesai';
    });
} elseif ($status === 'ongoing') {
    $filteredNovels = array_filter($filteredNovels, function($novel) {
        return isset($novel['status']) && strtolower($novel['status']) === 'berlangsung';
    });
}

// Sort data
if ($sortBy === 'newest') {
    usort($filteredNovels, function($a, $b) {
        return strtotime($b['date']) - strtotime($a['date']);
    });
} elseif ($sortBy === 'popularity') {
    usort($filteredNovels, function($a, $b) {
        return $b['views'] - $a['views'];
    });
}

// Hitung total halaman
$totalNovels = count($filteredNovels);
$totalPages = ceil($totalNovels / $perPage);
$page = min($page, max(1, $totalPages));

// Ambil novel untuk halaman saat ini
$startIndex = ($page - 1) * $perPage;
$pagedNovels = array_slice($filteredNovels, $startIndex, $perPage);

// Atur opsi sidebar
$showSavedNovels = true;
$showReadingHistory = true;
$showCategories = true;

// Aktifkan sidebar
$showSidebar = true;

// Include header
require_once('includes/header.php');
?>

<!-- Main Content -->
<div class="main-content">
    <!-- Filter dan Pencarian -->
    <div class="filter-container">
        <div class="filter-heading">
            <h1 class="filter-title">
                <?php
                if (!empty($search)) {
                    echo 'Hasil Pencarian: ' . htmlspecialchars($search);
                } elseif ($category === 'popular') {
                    echo 'Novel Populer';
                } elseif ($category === 'new') {
                    echo 'Novel Terbaru';
                } elseif ($mirror) {
                    echo 'Novel Mirror';
                } elseif ($project) {
                    echo 'Novel Project';
                } elseif (!empty($category)) {
                    foreach ($categories as $cat) {
                        if ($cat['id'] === $category) {
                            echo 'Novel Kategori: ' . $cat['name'];
                            break;
                        }
                    }
                } else {
                    echo 'Semua Novel';
                }
                ?>
            </h1>
            <span class="filter-count"><?php echo $totalNovels; ?> novel ditemukan</span>
        </div>
        
        <div class="filter-options">
            <div class="filter-sort">
                <label for="sort">Urutkan:</label>
                <select id="sort" class="sort-select" onchange="changeSort(this.value)">
                    <option value="newest" <?php if ($sortBy === 'newest') echo 'selected'; ?>>Terbaru</option>
                    <option value="popularity" <?php if ($sortBy === 'popularity') echo 'selected'; ?>>Popularitas</option>
                </select>
            </div>
            
            <!-- Tombol Toggle Tampilan -->
            <div class="view-toggles">
                <button type="button" onclick="changeView('list')" class="view-toggle-btn <?php if ($viewMode === 'list') echo 'active'; ?>" title="Tampilan Daftar">
                    <i class="fas fa-list"></i>
                </button>
                <button type="button" onclick="changeView('grid')" class="view-toggle-btn <?php if ($viewMode === 'grid') echo 'active'; ?>" title="Tampilan Grid">
                    <i class="fas fa-th-large"></i>
                </button>
            </div>
        </div>
        
        <!-- Filter yang dipindahkan dari sidebar -->
        <div class="advanced-filter-options">
            <form action="list-novel.php" method="get" class="filter-form">
                <?php if (!empty($search)): ?>
                <input type="hidden" name="search" value="<?php echo htmlspecialchars($search); ?>">
                <?php endif; ?>
                
                <?php if (!empty($category) && $category !== 'popular' && $category !== 'new'): ?>
                <input type="hidden" name="category" value="<?php echo htmlspecialchars($category); ?>">
                <?php endif; ?>
                
                <div class="filter-group">
                    <label class="filter-label">Jenis Novel:</label>
                    <div class="filter-options-group">
                        <label class="filter-option">
                            <input type="radio" name="novel_type" value="all" <?php if ($novel_type === 'all') echo 'checked'; ?>>
                            Semua
                        </label>
                        <label class="filter-option">
                            <input type="radio" name="novel_type" value="project" <?php if ($novel_type === 'project') echo 'checked'; ?>>
                            Project
                        </label>
                        <label class="filter-option">
                            <input type="radio" name="novel_type" value="mirror" <?php if ($novel_type === 'mirror') echo 'checked'; ?>>
                            Mirror
                        </label>
                    </div>
                </div>
                
                <div class="filter-group">
                    <label class="filter-label">Status:</label>
                    <div class="filter-options-group">
                        <label class="filter-option">
                            <input type="radio" name="status" value="all" <?php if ($status === 'all') echo 'checked'; ?>>
                            Semua
                        </label>
                        <label class="filter-option">
                            <input type="radio" name="status" value="completed" <?php if ($status === 'completed') echo 'checked'; ?>>
                            Selesai
                        </label>
                        <label class="filter-option">
                            <input type="radio" name="status" value="ongoing" <?php if ($status === 'ongoing') echo 'checked'; ?>>
                            Berlangsung
                        </label>
                    </div>
                </div>
                
                <div class="filter-submit">
                    <button type="submit" class="filter-button">Terapkan Filter</button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Tampilan Novel -->
    <?php if (empty($pagedNovels)): ?>
    <div class="empty-result">
        <p>Tidak ada novel yang ditemukan untuk kriteria pencarian Anda.</p>
        <p>Coba ubah filter atau kueri pencarian Anda.</p>
    </div>
    <?php elseif ($viewMode === 'list'): ?>
    <div class="novel-list">
        <?php foreach($pagedNovels as $novel): ?>
        <div class="novel-item">
            <div class="novel-cover">
                <img src="<?php echo $novel['cover']; ?>" alt="<?php echo $novel['title']; ?>">
                <?php if(isset($novel['isMirror']) && $novel['isMirror']): ?>
                <span class="novel-cover-tag tag-mirror">Mirror</span>
                <?php endif; ?>
                <?php if(isset($novel['isProject']) && $novel['isProject']): ?>
                <span class="novel-cover-tag tag-project">Project</span>
                <?php endif; ?>
            </div>
            <div class="novel-detail">
                <h3 class="novel-title">
                    <a href="detail-novel.php?id=<?php echo $novel['id']; ?>"><?php echo $novel['title']; ?></a>
                    <?php if(isset($novel['isNew']) && $novel['isNew']): ?>
                    <span class="stamp-tag stamp-new">BARU</span>
                    <?php endif; ?>
                    <?php if(isset($novel['isHot']) && $novel['isHot']): ?>
                    <span class="stamp-tag stamp-hot">HOT</span>
                    <?php endif; ?>
                </h3>
                <p class="novel-author">Penulis: <?php echo $novel['author']; ?></p>
                <p class="novel-description"><?php echo $novel['description']; ?></p>
                <div class="novel-meta">
                    <span><i class="far fa-eye"></i> <?php echo number_format($novel['views']); ?></span>
                    <span><i class="far fa-heart"></i> <?php echo number_format($novel['likes']); ?></span>
                    <span><i class="far fa-comment"></i> <?php echo number_format($novel['comments']); ?></span>
                    <?php if(isset($novel['categories']) && !empty($novel['categories'])): ?>
                    <span><i class="fas fa-tags"></i> <?php echo implode(', ', array_slice($novel['categories'], 0, 2)); ?></span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php else: ?>
    <div class="novel-grid">
        <?php foreach($pagedNovels as $novel): ?>
        <div class="grid-item">
            <div class="grid-item-inner">
                <div class="grid-cover">
                    <img src="<?php echo $novel['cover']; ?>" alt="<?php echo $novel['title']; ?>">
                    <?php if(isset($novel['isMirror']) && $novel['isMirror']): ?>
                    <span class="novel-cover-tag tag-mirror">Mirror</span>
                    <?php endif; ?>
                    <?php if(isset($novel['isProject']) && $novel['isProject']): ?>
                    <span class="novel-cover-tag tag-project">Project</span>
                    <?php endif; ?>
                </div>
                <div class="grid-detail">
                    <h3 class="grid-title">
                        <a href="detail-novel.php?id=<?php echo $novel['id']; ?>"><?php echo $novel['title']; ?></a>
                        <?php if(isset($novel['isNew']) && $novel['isNew']): ?>
                        <span class="stamp-tag stamp-new">BARU</span>
                        <?php endif; ?>
                        <?php if(isset($novel['isHot']) && $novel['isHot']): ?>
                        <span class="stamp-tag stamp-hot">HOT</span>
                        <?php endif; ?>
                    </h3>
                    <p class="grid-author"><?php echo $novel['author']; ?></p>
                    <div class="grid-meta">
                        <span><i class="far fa-eye"></i> <?php echo number_format($novel['views']); ?></span>
                        <span><i class="fas fa-tags"></i> <?php echo count($novel['categories']); ?></span>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
    
    <!-- Pagination -->
    <?php if ($totalPages > 1): ?>
    <div class="pagination">
        <?php if ($page > 1): ?>
        <a href="?<?php echo http_build_query(array_merge($_GET, ['page' => $page - 1])); ?>" class="page-prev">&laquo; Sebelumnya</a>
        <?php endif; ?>
        
        <?php
        $startPage = max(1, $page - 2);
        $endPage = min($totalPages, $page + 2);
        
        if ($startPage > 1) {
            echo '<a href="?' . http_build_query(array_merge($_GET, ['page' => 1])) . '" class="page-number">1</a>';
            if ($startPage > 2) {
                echo '<span class="page-ellipsis">...</span>';
            }
        }
        
        for ($i = $startPage; $i <= $endPage; $i++) {
            if ($i == $page) {
                echo '<span class="page-number active">' . $i . '</span>';
            } else {
                echo '<a href="?' . http_build_query(array_merge($_GET, ['page' => $i])) . '" class="page-number">' . $i . '</a>';
            }
        }
        
        if ($endPage < $totalPages) {
            if ($endPage < $totalPages - 1) {
                echo '<span class="page-ellipsis">...</span>';
            }
            echo '<a href="?' . http_build_query(array_merge($_GET, ['page' => $totalPages])) . '" class="page-number">' . $totalPages . '</a>';
        }
        ?>
        
        <?php if ($page < $totalPages): ?>
        <a href="?<?php echo http_build_query(array_merge($_GET, ['page' => $page + 1])); ?>" class="page-next">Selanjutnya &raquo;</a>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</div>

<?php
// Include sidebar
require_once('includes/sidebar.php');
?>

<script>
    function changeSort(value) {
        // Get current URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        
        // Update sort parameter
        urlParams.set('sort', value);
        
        // Redirect to new URL
        window.location.href = window.location.pathname + '?' + urlParams.toString();
    }

    function changeView(mode) {
        // Get current URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        
        // Update view parameter
        urlParams.set('view', mode);
        
        // Redirect to new URL
        window.location.href = window.location.pathname + '?' + urlParams.toString();
    }
</script>

<?php 
// Include footer
require_once('includes/footer.php'); 
?> 