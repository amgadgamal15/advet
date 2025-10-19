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

$id = intval($_POST['id'] ?? 0);
$products = getJsonData('products.json');

$found = false;
foreach ($products as &$product) {
    if ($product['id'] === $id) {
        $product['name_en'] = sanitizeInput($_POST['name_en'] ?? $product['name_en']);
        $product['name_ar'] = sanitizeInput($_POST['name_ar'] ?? $product['name_ar']);
        $product['description_en'] = sanitizeInput($_POST['description_en'] ?? $product['description_en']);
        $product['description_ar'] = sanitizeInput($_POST['description_ar'] ?? $product['description_ar']);
        $product['category'] = sanitizeInput($_POST['category'] ?? $product['category']);
        $product['strength'] = sanitizeInput($_POST['strength'] ?? $product['strength']);
        $product['pack_size'] = sanitizeInput($_POST['pack_size'] ?? $product['pack_size']);
        $product['manufacturer'] = sanitizeInput($_POST['manufacturer'] ?? $product['manufacturer']);
        
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadResult = uploadImage($_FILES['image'], 'products');
            if ($uploadResult['success']) {
                $product['image'] = $uploadResult['filename'];
            }
        }
        
        $found = true;
        break;
    }
}

if (!$found) {
    echo json_encode(['success' => false, 'message' => 'Product not found']);
    exit;
}

saveJsonData('products.json', $products);
echo json_encode(['success' => true, 'message' => 'Product updated successfully']);
?>
