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

// Tentukan CSS tambahan berdasarkan halaman
if (isset($currentPage)) {
    switch ($currentPage) {
        case 'list-novel':
            $additionalCSS[] = $filterCSS;
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
?> 