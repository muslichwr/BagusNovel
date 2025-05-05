<?php
/**
 * Konfigurasi umum untuk BagusNovel
 * File ini harus di-include di setiap halaman
 */

// Pengaturan zona waktu
date_default_timezone_set('Asia/Jakarta');

// Konfigurasi database (jika diperlukan di masa depan)
// $dbHost = 'localhost';
// $dbName = 'bagusnovel';
// $dbUser = 'root';
// $dbPass = '';

// Fungsi utility
function formatNumber($number) {
    return number_format($number);
}

// Fungsi pemeriksaan status login (untuk implementasi masa depan)
function isLoggedIn() {
    // Untuk saat ini kita kembalikan false
    return false;
}

// Konfigurasi path
$basePath = '/Novel';

// Variabel default
$currentPage = $currentPage ?? 'home';
$pageTitle = $pageTitle ?? 'BagusNovel | Baca Novel Online Terlengkap';
?> 