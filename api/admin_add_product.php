<?php
session_start();
header('Content-Type: application/json');
require_once __DIR__ . '/../includes/functions.php';

if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

$products = getJsonData('products.json');

$imageName = 'placeholder.jpg';
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $uploadResult = uploadImage($_FILES['image'], 'products');
    if ($uploadResult['success']) {
        $imageName = $uploadResult['filename'];
    }
}

$newProduct = [
    'id' => generateId($products),
    'name_en' => sanitizeInput($_POST['name_en'] ?? ''),
    'name_ar' => sanitizeInput($_POST['name_ar'] ?? ''),
    'description_en' => sanitizeInput($_POST['description_en'] ?? ''),
    'description_ar' => sanitizeInput($_POST['description_ar'] ?? ''),
    'category' => sanitizeInput($_POST['category'] ?? ''),
    'strength' => sanitizeInput($_POST['strength'] ?? ''),
    'pack_size' => sanitizeInput($_POST['pack_size'] ?? ''),
    'manufacturer' => sanitizeInput($_POST['manufacturer'] ?? ''),
    'image' => $imageName
];

$products[] = $newProduct;
saveJsonData('products.json', $products);

echo json_encode(['success' => true, 'message' => 'Product added successfully', 'product' => $newProduct]);
?>
