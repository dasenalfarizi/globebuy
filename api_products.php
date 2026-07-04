<?php
require 'config.php';
header('Content-Type: application/json');

// Tangkap parameter filter
$category = isset($_GET['category']) ? $_GET['category'] : '';
$minPrice = isset($_GET['min_price']) ? (int)$_GET['min_price'] : 0;
$maxPrice = isset($_GET['max_price']) ? (int)$_GET['max_price'] : 0;
$size = isset($_GET['size']) ? $_GET['size'] : '';
$color = isset($_GET['color']) ? $_GET['color'] : '';

// Susun query dasar
$sql = "SELECT * FROM products WHERE 1=1";
$params = [];

if (!empty($category)) {
    $sql .= " AND category = :category";
    $params[':category'] = $category;
}

if ($minPrice > 0) {
    $sql .= " AND price >= :min_price";
    $params[':min_price'] = $minPrice;
}

if ($maxPrice > 0) {
    $sql .= " AND price <= :max_price";
    $params[':max_price'] = $maxPrice;
}

// Mencari dalam kolom JSON MySQL
if (!empty($size)) {
    $sql .= " AND JSON_CONTAINS(sizes, :size)";
    $params[':size'] = '"' . $size . '"'; 
}

if (!empty($color)) {
    // Mencari nama warna di dalam array of objects JSON
    $sql .= " AND JSON_SEARCH(colors, 'one', :color, NULL, '$[*].name') IS NOT NULL";
    $params[':color'] = $color;
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$products = $stmt->fetchAll();

// Decode JSON strings back to PHP arrays untuk dikirim sebagai JSON bersih ke frontend
foreach ($products as &$p) {
    $p['sizes'] = json_decode($p['sizes']);
    $p['colors'] = json_decode($p['colors']);
    // Normalisasi struktur agar sesuai dengan format frontend JS Anda
    $p['basePrice'] = $p['price'];
    $p['variants'] = [];
    if($p['sizes']) {
        foreach($p['sizes'] as $s) {
            $p['variants'][$s] = $p['price']; // Harga flat per size untuk simplifikasi
        }
    }
}

echo json_encode($products);
?>