<?php
/**
 * File ini mengatur CSS yang akan di-include di semua halaman
 */

// Base CSS yang selalu dimuat
$baseCSS = [
    'styles/css.css',
    'styles/animations.css'
];

// CSS untuk sidebar
$sidebarCSS = 'styles/sidebar-styles.css';

// CSS untuk filter
$filterCSS = 'styles/filter-styles.css';

// CSS untuk login dan forgot password
$loginCSS = 'styles/login-styles.css';

// CSS untuk saved novel
$savedNovelCSS = 'styles/saved-novel-styles.css';

// Tentukan CSS tambahan berdasarkan halaman
if (isset($currentPage)) {
    switch ($currentPage) {
        case 'list-novel':
        case 'project':
        case 'mirror':
        case 'popular':
        case 'new':
            $additionalCSS[] = $filterCSS;
            break;
        case 'login':
        case 'forgot-password':
        case 'register':
            $additionalCSS[] = $loginCSS;
            break;
        case 'saved_novel':
            $additionalCSS[] = $savedNovelCSS;
            break;
    }
}

// Jika ada sidebar, muat CSS sidebar
if (isset($showSidebar) && $showSidebar) {
    $additionalCSS[] = $sidebarCSS;
}

// Fungsi untuk mencetak tag link CSS
function printCSSLinks($cssFiles) {
    if (is_array($cssFiles)) {
        foreach ($cssFiles as $css) {
            echo '<link rel="stylesheet" href="' . $css . '">' . PHP_EOL;
        }
    } else {
        echo '<link rel="stylesheet" href="' . $cssFiles . '">' . PHP_EOL;
    }
}

// Cetak base CSS
printCSSLinks($baseCSS);

// Cetak CSS tambahan jika ada
if (isset($additionalCSS) && !empty($additionalCSS)) {
    printCSSLinks($additionalCSS);
}

// Cetak custom CSS jika ada (seperti untuk halaman read.php)
if (isset($customCSS)) {
    echo $customCSS . PHP_EOL;
}
?> 