<?php
require_once __DIR__ . '/../includes/guard.php';
require_once __DIR__ . '/../includes/functions.php';

$lang = getCurrentLanguage();
$trans = getTranslations($lang);
$products = getJsonData('products.json');
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $trans['admin']['products']; ?> - <?php echo $trans['site_name']; ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href="../assets/css/dark.css">
</head>
<body>
    <?php include 'includes/admin-nav.php'; ?>
    
    <div class="admin-container">
        <div class="admin-header">
            <h1><?php echo $trans['admin']['products']; ?></h1>
            <button class="btn btn-primary" onclick="showAddProduct()"><?php echo $trans['admin']['add_product']; ?></button>
        </div>
        
        <div class="products-table">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name (EN)</th>
                        <th>Name (AR)</th>
                        <th>Category</th>
                        <th>Strength</th>
                        <th>Pack Size</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?php echo $product['id']; ?></td>
                        <td><?php echo $product['name_en']; ?></td>
                        <td><?php echo $product['name_ar']; ?></td>
                        <td><?php echo $product['category']; ?></td>
                        <td><?php echo $product['strength']; ?></td>
                        <td><?php echo $product['pack_size']; ?></td>
                        <td>
                            <button class="btn-icon" onclick='editProduct(<?php echo json_encode($product); ?>)'>✏️</button>
                            <button class="btn-icon" onclick="deleteProduct(<?php echo $product['id']; ?>)">🗑️</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Add/Edit Product Modal -->
    <div id="productModal" class="modal">
        <div class="modal-content">
            <span class="modal-close" onclick="closeProductModal()">&times;</span>
            <h2 id="modalTitle"><?php echo $trans['admin']['add_product']; ?></h2>
            <form id="productForm">
                <input type="hidden" id="productId" name="id">
                <div class="form-row">
                    <div class="form-group">
                        <label>Name (English)</label>
                        <input type="text" name="name_en" required>
                    </div>
                    <div class="form-group">
                        <label>Name (Arabic)</label>
                        <input type="text" name="name_ar" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Description (English)</label>
                        <textarea name="description_en" rows="2" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Description (Arabic)</label>
                        <textarea name="description_ar" rows="2" required></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Category</label>
                        <input type="text" name="category" required>
                    </div>
                    <div class="form-group">
                        <label>Strength</label>
                        <input type="text" name="strength" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label>Pack Size</label>
                        <input type="text" name="pack_size" required>
                    </div>
                    <div class="form-group">
                        <label>Manufacturer</label>
                        <input type="text" name="manufacturer" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Product Image</label>
                    <input type="file" id="productImage" name="image" accept="image/*">
                    <small>Upload product image (JPG, PNG, WEBP - Max 5MB)</small>
                    <div id="currentImagePreview" style="margin-top: 10px;"></div>
                </div>
                <div class="form-actions">
                    <button type="button" class="btn btn-outline" onclick="closeProductModal()"><?php echo $trans['admin']['cancel']; ?></button>
                    <button type="submit" class="btn btn-primary"><?php echo $trans['admin']['save']; ?></button>
                </div>
            </form>
        </div>
    </div>
    
    <script src="../assets/js/theme.js"></script>
    <script src="../assets/js/admin-products.js"></script>
</body>
</html>
