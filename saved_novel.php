<?php
/**
 * Halaman Daftar Novel Tersimpan BagusNovel
 */

// Informasi halaman
$pageTitle = "BagusNovel | Novel Tersimpan";
$currentPage = "saved_novel";
$showSidebar = true; // Aktifkan sidebar

// Include file konfigurasi
require_once('includes/config.php');

// Data dummy novel tersimpan (pada implementasi nyata, ambil dari database)
$savedNovels = [
    [
        'id' => 1,
        'title' => 'Reinkarnasi Sebagai Pedang Legendaris',
        'author' => 'Kirito Yagami',
        'cover' => 'images/covers/cover1.jpg',
        'status' => 'reading',
        'progress' => 75,
        'last_read' => '3 jam yang lalu',
        'chapters' => 180,
        'completed_chapters' => 135
    ],
    [
        'id' => 2,
        'title' => 'Akademi Sihir: Perjalanan Penyihir Terbuang',
        'author' => 'Miyuki Shirogane',
        'cover' => 'images/covers/cover2.jpg',
        'status' => 'completed',
        'progress' => 100,
        'last_read' => '2 hari yang lalu',
        'chapters' => 120,
        'completed_chapters' => 120
    ],
    [
        'id' => 3,
        'title' => 'Kembalinya Sang Raja Iblis Setelah 1000 Tahun',
        'author' => 'Maou Sadao',
        'cover' => 'images/covers/cover3.jpg',
        'status' => 'plan',
        'progress' => 0,
        'last_read' => 'Belum dibaca',
        'chapters' => 245,
        'completed_chapters' => 0
    ],
    [
        'id' => 4,
        'title' => 'Dunia Game: Level Up Tanpa Batas',
        'author' => 'Kirito Ayasaki',
        'cover' => 'images/covers/cover4.jpg',
        'status' => 'reading',
        'progress' => 30,
        'last_read' => '1 minggu yang lalu',
        'chapters' => 200,
        'completed_chapters' => 60
    ],
    [
        'id' => 5,
        'title' => 'Rahasia Kuil Kuno: Perburuan Harta Karun',
        'author' => 'Nathan Drake',
        'cover' => 'images/covers/cover5.jpg',
        'status' => 'reading',
        'progress' => 50,
        'last_read' => '2 hari yang lalu',
        'chapters' => 85,
        'completed_chapters' => 42
    ],
    [
        'id' => 6,
        'title' => 'Kisah Pangeran dan 7 Kontrak',
        'author' => 'Lina Shields',
        'cover' => 'images/covers/cover6.jpg',
        'status' => 'plan',
        'progress' => 0,
        'last_read' => 'Belum dibaca',
        'chapters' => 112,
        'completed_chapters' => 0
    ],
    [
        'id' => 7,
        'title' => 'Perjalanan ke Dunia Sebelah',
        'author' => 'Kazuma Sato',
        'cover' => 'images/covers/cover1.jpg',
        'status' => 'completed',
        'progress' => 100,
        'last_read' => '3 minggu yang lalu',
        'chapters' => 150,
        'completed_chapters' => 150
    ],
    [
        'id' => 8,
        'title' => 'Perang Antar Galaksi: Imperium Terakhir',
        'author' => 'Lelouch Vi Britannia',
        'cover' => 'images/covers/cover2.jpg',
        'status' => 'reading',
        'progress' => 10,
        'last_read' => 'Kemarin',
        'chapters' => 300,
        'completed_chapters' => 30
    ]
];

// Filter berdasarkan status (jika ada)
$statusFilter = $_GET['status'] ?? 'all';
if ($statusFilter !== 'all') {
    $savedNovels = array_filter($savedNovels, function($novel) use ($statusFilter) {
        return $novel['status'] === $statusFilter;
    });
}

// Sort berdasarkan parameter
$sortBy = $_GET['sort'] ?? 'last_read';
switch ($sortBy) {
    case 'title':
        usort($savedNovels, function($a, $b) {
            return strcmp($a['title'], $b['title']);
        });
        break;
    case 'progress':
        usort($savedNovels, function($a, $b) {
            return $b['progress'] - $a['progress'];
        });
        break;
    case 'last_read':
    default:
        // Sudah diurutkan di dummy data
        break;
}

// View mode (grid atau list)
$viewMode = $_GET['view'] ?? 'grid';

// Include header
require_once('includes/header.php');
?>

<!-- Main Content -->
<div class="main-content">
    <div class="saved-container">
        <div class="saved-header">
            <h1 class="saved-title">Novel Tersimpan</h1>
            <div class="saved-stats">
                <span>Total: <?php echo count($savedNovels); ?> novel</span>
                <?php
                    $readingCount = count(array_filter($savedNovels, function($n) { return $n['status'] === 'reading'; }));
                    $completedCount = count(array_filter($savedNovels, function($n) { return $n['status'] === 'completed'; }));
                    $planCount = count(array_filter($savedNovels, function($n) { return $n['status'] === 'plan'; }));
                ?>
                <span>| <?php echo $readingCount; ?> sedang dibaca | <?php echo $completedCount; ?> selesai | <?php echo $planCount; ?> rencana</span>
            </div>
        </div>
        
        <div class="saved-controls">
            <div class="saved-filter">
                <label for="statusFilter" style="font-size: 12px; margin-right: 5px;">Status:</label>
                <select class="saved-filter-select" id="statusFilter" onchange="filterNovels()">
                    <option value="all" <?php if ($statusFilter === 'all') echo 'selected'; ?>>Semua (<?php echo count($savedNovels); ?>)</option>
                    <option value="reading" <?php if ($statusFilter === 'reading') echo 'selected'; ?>>Sedang Dibaca (<?php echo $readingCount; ?>)</option>
                    <option value="completed" <?php if ($statusFilter === 'completed') echo 'selected'; ?>>Selesai (<?php echo $completedCount; ?>)</option>
                    <option value="plan" <?php if ($statusFilter === 'plan') echo 'selected'; ?>>Rencana (<?php echo $planCount; ?>)</option>
                </select>
                
                <label for="sortOrder" style="font-size: 12px; margin-right: 5px; margin-left: 8px;">Urut:</label>
                <select class="saved-filter-select" id="sortOrder" onchange="sortNovels()">
                    <option value="last_read" <?php if ($sortBy === 'last_read') echo 'selected'; ?>>Terakhir Dibaca</option>
                    <option value="title" <?php if ($sortBy === 'title') echo 'selected'; ?>>Judul</option>
                    <option value="progress" <?php if ($sortBy === 'progress') echo 'selected'; ?>>Progres</option>
                </select>
            </div>
            
            <div class="saved-view-toggle">
                <button class="view-btn <?php if ($viewMode === 'grid') echo 'active'; ?>" onclick="changeView('grid')">
                    <i class="fas fa-th"></i>
                </button>
                <button class="view-btn <?php if ($viewMode === 'list') echo 'active'; ?>" onclick="changeView('list')">
                    <i class="fas fa-list"></i>
                </button>
            </div>
        </div>
        
        <?php if (empty($savedNovels)): ?>
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fas fa-book"></i>
                </div>
                <h2 class="empty-state-title">Belum ada novel tersimpan</h2>
                <p class="empty-state-text">Mulai jelajahi novel dan tambahkan ke daftar bacaan Anda</p>
                <a href="list-novel.php" class="empty-state-btn">Jelajahi Novel</a>
            </div>
        <?php else: ?>
            <?php if ($viewMode === 'grid'): ?>
                <div class="saved-novels-grid">
                    <?php foreach ($savedNovels as $novel): ?>
                        <div class="saved-novel-card grid-card">
                            <div class="card-cover">
                                <span class="card-badge badge-<?php echo $novel['status']; ?>">
                                    <?php 
                                    switch ($novel['status']) {
                                        case 'reading': echo 'Sedang Dibaca'; break;
                                        case 'completed': echo 'Selesai'; break;
                                        case 'plan': echo 'Rencana'; break;
                                    }
                                    ?>
                                </span>
                                <img src="<?php echo $novel['cover']; ?>" alt="<?php echo $novel['title']; ?>">
                            </div>
                            <div class="card-body">
                                <h3 class="card-title"><?php echo $novel['title']; ?></h3>
                                <div class="card-author"><?php echo $novel['author']; ?></div>
                                
                                <div class="card-progress">
                                    <div class="progress-bar">
                                        <div class="progress-fill" style="width: <?php echo $novel['progress']; ?>%"></div>
                                    </div>
                                </div>
                                
                                <div class="card-meta">
                                    <span><?php echo $novel['completed_chapters']; ?>/<?php echo $novel['chapters']; ?> ch</span>
                                    <span><?php echo $novel['progress']; ?>%</span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="saved-novels-list">
                    <?php foreach ($savedNovels as $novel): ?>
                        <div class="saved-novel-card list-card">
                            <div class="card-cover">
                                <span class="card-badge badge-<?php echo $novel['status']; ?>">
                                    <?php 
                                    switch ($novel['status']) {
                                        case 'reading': echo 'Sedang Dibaca'; break;
                                        case 'completed': echo 'Selesai'; break;
                                        case 'plan': echo 'Rencana'; break;
                                    }
                                    ?>
                                </span>
                                <img src="<?php echo $novel['cover']; ?>" alt="<?php echo $novel['title']; ?>">
                            </div>
                            <div class="card-body">
                                <h3 class="card-title"><?php echo $novel['title']; ?></h3>
                                <div class="card-author"><?php echo $novel['author']; ?></div>
                                
                                <div class="card-progress">
                                    <div class="progress-bar">
                                        <div class="progress-fill" style="width: <?php echo $novel['progress']; ?>%"></div>
                                    </div>
                                </div>
                                
                                <div class="card-meta">
                                    <div>
                                        <span><b>Progres:</b> <?php echo $novel['completed_chapters']; ?>/<?php echo $novel['chapters']; ?> ch (<?php echo $novel['progress']; ?>%)</span>
                                    </div>
                                    <div><b>Update:</b> <?php echo $novel['last_read']; ?></div>
                                </div>
                                
                                <div class="card-actions">
                                    <button class="action-btn">
                                        <i class="fas fa-book-reader"></i> Lanjutkan
                                    </button>
                                    <button class="action-btn">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button class="action-btn">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>

<!-- Sidebar -->
<?php include_once('includes/sidebar.php'); ?>

<script>
    function filterNovels() {
        const status = document.getElementById('statusFilter').value;
        const sort = document.getElementById('sortOrder').value;
        const view = '<?php echo $viewMode; ?>';
        window.location.href = `saved_novel.php?status=${status}&sort=${sort}&view=${view}`;
    }
    
    function sortNovels() {
        const status = document.getElementById('statusFilter').value;
        const sort = document.getElementById('sortOrder').value;
        const view = '<?php echo $viewMode; ?>';
        window.location.href = `saved_novel.php?status=${status}&sort=${sort}&view=${view}`;
    }
    
    function changeView(viewMode) {
        const status = document.getElementById('statusFilter').value;
        const sort = document.getElementById('sortOrder').value;
        window.location.href = `saved_novel.php?status=${status}&sort=${sort}&view=${viewMode}`;
    }
</script>

<?php 
// Include footer
require_once('includes/footer.php'); 
?> 