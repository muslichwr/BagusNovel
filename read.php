<?php
/**
 * Halaman Baca Novel BagusNovel
 * Desain sederhana ala web Jepang
 */

// Informasi halaman
$pageTitle = "BagusNovel | Baca Novel";
$currentPage = "read";

// Include file konfigurasi
require_once('includes/config.php');

// Include file data
require_once('includes/data.php');

// Mengambil parameter dari URL
$novelId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$chapterNumber = isset($_GET['chapter']) ? intval($_GET['chapter']) : 1;

// Mendapatkan data novel
$novel = getNovelById($novelId);

// Jika novel tidak ditemukan, redirect ke halaman daftar novel
if (!$novel) {
    header('Location: list-novel.php');
    exit;
}

// Mendapatkan data chapter
$currentChapter = null;
foreach ($novel['chapters'] as $chapter) {
    if ($chapter['number'] == $chapterNumber) {
        $currentChapter = $chapter;
        break;
    }
}

// Jika chapter tidak ditemukan, redirect ke halaman detail novel
if (!$currentChapter) {
    header("Location: detail-novel.php?id=$novelId");
    exit;
}

// Mendapatkan chapter sebelumnya dan selanjutnya
$prevChapter = null;
$nextChapter = null;
foreach ($novel['chapters'] as $chapter) {
    if ($chapter['number'] == $chapterNumber - 1) {
        $prevChapter = $chapter;
    }
    if ($chapter['number'] == $chapterNumber + 1) {
        $nextChapter = $chapter;
    }
}

// Mengubah judul halaman sesuai judul novel dan chapter
$pageTitle = "BagusNovel | " . $novel['title'] . " - Bab " . $chapterNumber;

// Disable sidebar untuk tampilan membaca
$showSidebar = false;

// CSS khusus untuk halaman pembaca
$customCSS = '<link rel="stylesheet" href="styles/reader-styles.css">';

// Include header
require_once('includes/header.php');
?>

<div class="reader-container">
    <div class="reader-header">
        <div class="novel-title-small">
            <a href="detail-novel.php?id=<?php echo $novel['id']; ?>"><?php echo $novel['title']; ?></a>
        </div>
        <h1 class="chapter-title">Bab <?php echo $currentChapter['number']; ?>: <?php echo $currentChapter['title']; ?></h1>
        <div class="chapter-meta">
            <span><i class="far fa-calendar"></i> <?php echo $currentChapter['date']; ?></span>
            <span><i class="far fa-clock"></i> Waktu baca: <?php echo $currentChapter['duration']; ?> menit</span>
            <span><i class="far fa-user"></i> <?php echo $novel['author']; ?></span>
        </div>
    </div>
    
    <div class="reader-options">
        <div class="text-options">
            <button id="font-decrease"><i class="fas fa-minus"></i> A</button>
            <button id="font-increase"><i class="fas fa-plus"></i> A</button>
        </div>
    </div>
    
    <div class="reader-content" id="chapter-content">
        <?php
        // Contoh konten chapter
        if (isset($currentChapter['content'])) {
            echo $currentChapter['content'];
        } else {
            // Konten sampel jika tidak ada konten yang tersedia
            echo '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed gravida velit vitae enim faucibus, at finibus lectus malesuada. Nullam elementum, arcu vel faucibus fermentum, libero massa consequat mi, vel dictum nulla dui sit amet nibh. Donec scelerisque diam ut est commodo, sit amet aliquam ex auctor.</p>';
            echo '<p>Donec porttitor ante eu leo fermentum, in maximus sem consequat. Vivamus sagittis velit non mauris faucibus, in vehicula odio luctus. Vestibulum hendrerit sem sed volutpat tincidunt. Aliquam erat volutpat. Praesent sed hendrerit enim. Nullam tincidunt laoreet risus, at commodo risus faucibus et.</p>';
            echo '<p>Pellentesque molestie eleifend porttitor. Aenean eget felis velit. Nullam ut eleifend est. Donec fermentum condimentum neque, ac consectetur mi varius quis. Suspendisse potenti. Nulla facilisi. Fusce ut velit sit amet dolor finibus ullamcorper. Suspendisse est leo, feugiat at pulvinar eu, tincidunt a magna.</p>';
            echo '<p>Etiam fermentum risus risus, id commodo mauris fringilla a. Nullam faucibus, nibh a vehicula suscipit, massa neque auctor neque, vitae mattis diam magna non dui. Proin lobortis odio in risus rutrum, id finibus tellus egestas. Praesent finibus lacus id molestie mattis.</p>';
            echo '<p>Nulla facilisi. Fusce condimentum ultrices sapien, nec suscipit metus congue sagittis. Vestibulum sodales sem a eros porttitor, in bibendum elit sagittis. Vestibulum vestibulum ligula in tortor aliquam, sed scelerisque justo euismod. Cras mattis eu eros quis pulvinar.</p>';
        }
        ?>
    </div>
    
    <div class="navigation">
        <?php if ($prevChapter): ?>
        <a href="read.php?id=<?php echo $novel['id']; ?>&chapter=<?php echo $prevChapter['number']; ?>" class="nav-button">
            <i class="fas fa-chevron-left"></i> Bab Sebelumnya
        </a>
        <?php else: ?>
        <span class="nav-button disabled"><i class="fas fa-chevron-left"></i> Bab Sebelumnya</span>
        <?php endif; ?>
        
        <div class="nav-center">
            <select class="chapter-selector" onchange="if(this.value) window.location.href=this.value;">
                <option value="">Pilih Bab...</option>
                <?php foreach ($novel['chapters'] as $chapter): ?>
                <option value="read.php?id=<?php echo $novel['id']; ?>&chapter=<?php echo $chapter['number']; ?>" <?php if ($chapter['number'] == $chapterNumber) echo 'selected'; ?>>
                    Bab <?php echo $chapter['number']; ?>: <?php echo $chapter['title']; ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <?php if ($nextChapter): ?>
        <a href="read.php?id=<?php echo $novel['id']; ?>&chapter=<?php echo $nextChapter['number']; ?>" class="nav-button">
            Bab Selanjutnya <i class="fas fa-chevron-right"></i>
        </a>
        <?php else: ?>
        <span class="nav-button disabled">Bab Selanjutnya <i class="fas fa-chevron-right"></i></span>
        <?php endif; ?>
    </div>
</div>

<script>
// Fungsi untuk mengubah ukuran font
document.getElementById('font-increase').addEventListener('click', function() {
    const content = document.getElementById('chapter-content');
    const currentSize = window.getComputedStyle(content).fontSize;
    const newSize = parseFloat(currentSize) + 1;
    content.style.fontSize = newSize + 'px';
});

document.getElementById('font-decrease').addEventListener('click', function() {
    const content = document.getElementById('chapter-content');
    const currentSize = window.getComputedStyle(content).fontSize;
    const newSize = parseFloat(currentSize) - 1;
    if (newSize >= 12) { // Mencegah font terlalu kecil
        content.style.fontSize = newSize + 'px';
    }
});
</script>

<?php
// Include footer
require_once('includes/footer.php');
?>
