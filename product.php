<?php
require_once 'includes/functions.php';

// Get product ID from URL
$productId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Load products
$products = getJsonData('products.json');

// Find the product
$product = null;
foreach ($products as $p) {
    if ($p['id'] === $productId) {
        $product = $p;
        break;
    }
}

// Redirect if product not found
if (!$product) {
    header('Location: /products.php');
    exit;
}

// Get related products (same category, excluding current)
$relatedProducts = array_filter($products, function($p) use ($product, $productId) {
    return $p['category'] === $product['category'] && $p['id'] !== $productId;
});

// Limit to 3 related products
$relatedProducts = array_slice($relatedProducts, 0, 3);

$pageTitle = $lang === 'ar' ? $product['name_ar'] : $product['name_en'];
require_once 'includes/header.php';
require_once 'includes/navbar.php';
?>

<main class="product-detail-page">
    <section class="product-detail">
        <div class="container">
            <div class="product-detail-grid">
                <!-- Product Image -->
                <div class="product-detail-image fade-in-scroll">
                    <div class="detail-image-container">
                        <?php if (!empty($product['image'])): ?>
                            <img src="assets/images/products/<?php echo htmlspecialchars($product['image']); ?>" 
                                 alt="<?php echo htmlspecialchars($lang === 'ar' ? $product['name_ar'] : $product['name_en']); ?>"
                                 class="large-product-image">
                        <?php else: ?>
                            <div class="placeholder-image large">🧪</div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Product Information -->
                <div class="product-detail-info fade-in-scroll">
                    <div class="breadcrumb">
                        <a href="products.php"><?php echo $trans['nav']['products']; ?></a>
                        <span> / </span>
                        <span><?php echo $lang === 'ar' ? $product['name_ar'] : $product['name_en']; ?></span>
                    </div>

                    <h1 class="product-detail-title">
                        <?php echo $lang === 'ar' ? $product['name_ar'] : $product['name_en']; ?>
                    </h1>

                    <div class="product-category">
                        <span class="badge"><?php echo $product['category']; ?></span>
                    </div>

                    <p class="product-detail-description">
                        <?php echo $lang === 'ar' ? $product['description_ar'] : $product['description_en']; ?>
                    </p>

                    <div class="product-specifications">
                        <h3><?php echo $trans['products']['specifications']; ?></h3>
                        <div class="spec-grid">
                            <div class="spec-item">
                                <span class="spec-label"><?php echo $trans['products']['category']; ?></span>
                                <span class="spec-value"><?php echo $product['category']; ?></span>
                            </div>
                            <div class="spec-item">
                                <span class="spec-label"><?php echo $trans['products']['strength']; ?></span>
                                <span class="spec-value"><?php echo $product['strength']; ?></span>
                            </div>
                            <div class="spec-item">
                                <span class="spec-label"><?php echo $trans['products']['pack_size']; ?></span>
                                <span class="spec-value"><?php echo $product['pack_size']; ?></span>
                            </div>
                            <div class="spec-item">
                                <span class="spec-label"><?php echo $trans['products']['manufacturer']; ?></span>
                                <span class="spec-value"><?php echo $product['manufacturer']; ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="product-actions">
                        <button class="btn btn-primary btn-lg ripple quote-btn" 
                                data-product-id="<?php echo $product['id']; ?>" 
                                data-product-name="<?php echo $lang === 'ar' ? $product['name_ar'] : $product['name_en']; ?>">
                            <?php echo $trans['products']['request_quote']; ?>
                        </button>
                        <a href="products.php" class="btn btn-outline">
                            <?php echo $trans['products']['back_to_products']; ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php if (!empty($relatedProducts)): ?>
    <!-- Related Products Section -->
    <section class="related-products">
        <div class="container">
            <h2 class="section-title">
                <?php echo $trans['products']['more_like_this']; ?>
            </h2>
            <div class="products-grid">
                <?php foreach ($relatedProducts as $relatedProduct): ?>
                <div class="product-card fade-in-scroll">
                    <div class="product-image">
                        <?php if (!empty($relatedProduct['image'])): ?>
                            <img src="assets/images/products/<?php echo htmlspecialchars($relatedProduct['image']); ?>" 
                                 alt="<?php echo htmlspecialchars($lang === 'ar' ? $relatedProduct['name_ar'] : $relatedProduct['name_en']); ?>">
                        <?php else: ?>
                            <div class="placeholder-image">🧪</div>
                        <?php endif; ?>
                    </div>
                    <div class="product-info">
                        <h3>
                            <a href="product.php?id=<?php echo $relatedProduct['id']; ?>" class="product-link">
                                <?php echo $lang === 'ar' ? $relatedProduct['name_ar'] : $relatedProduct['name_en']; ?>
                            </a>
                        </h3>
                        <p class="product-desc">
                            <?php echo $lang === 'ar' ? $relatedProduct['description_ar'] : $relatedProduct['description_en']; ?>
                        </p>
                        <div class="product-meta">
                            <span class="badge"><?php echo $relatedProduct['category']; ?></span>
                            <span><?php echo $relatedProduct['strength']; ?></span>
                        </div>
                        <a href=product.php?id=<?php echo $relatedProduct['id']; ?>" class="btn btn-outline btn-block ripple">
                            <?php echo $trans['products']['view_details']; ?>
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>
</main>

<!-- Quotation Modal -->
<div id="quotationModal" class="modal">
    <div class="modal-content">
        <span class="modal-close">&times;</span>
        <h2><?php echo $trans['quotation']['title']; ?></h2>
        <form id="quotationForm">
            <input type="hidden" id="productId" name="product_id">
            <div class="form-group">
                <label><?php echo $trans['quotation']['product']; ?></label>
                <input type="text" id="productName" readonly>
            </div>
            <div class="form-group">
                <label><?php echo $trans['contact']['name']; ?></label>
                <input type="text" name="name" required>
            </div>
            <div class="form-group">
                <label><?php echo $trans['contact']['email']; ?></label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label><?php echo $trans['contact']['phone']; ?></label>
                <input type="tel" name="phone" required>
            </div>
            <div class="form-group">
                <label><?php echo $trans['quotation']['quantity']; ?></label>
                <input type="number" name="quantity" min="1" value="1" required>
            </div>
            <div class="form-group">
                <label><?php echo $trans['quotation']['notes']; ?></label>
                <textarea name="notes" rows="3"></textarea>
            </div>
            <div class="form-actions">
                <button type="button" class="btn btn-outline modal-close"><?php echo $trans['quotation']['close']; ?></button>
                <button type="submit" class="btn btn-primary ripple"><?php echo $trans['quotation']['submit']; ?></button>
            </div>
        </form>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
