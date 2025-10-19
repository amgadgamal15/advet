<?php
require_once 'includes/functions.php';
$pageTitle = t('nav.products');
require_once 'includes/header.php';
require_once 'includes/navbar.php';

$products = getJsonData('products.json');
$categories = array_unique(array_column($products, 'category'));
?>

<main class="products-page">
    <section class="page-header">
        <div class="container">
            <h1 class="page-title"><?php echo $trans['products']['title']; ?></h1>
        </div>
    </section>

    <section class="products-content">
        <div class="container">
            <div class="products-toolbar">
                <div class="search-box">
                    <input type="text" id="searchInput" placeholder="<?php echo $trans['products']['search_placeholder']; ?>">
                </div>
                <div class="filter-box">
                    <select id="categoryFilter">
                        <option value=""><?php echo $trans['products']['filter_all']; ?></option>
                        <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category; ?>"><?php echo $category; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="products-grid" id="productsGrid">
                <?php foreach ($products as $product): ?>
                <div class="product-card fade-in-scroll" data-category="<?php echo $product['category']; ?>" data-name="<?php echo strtolower($product['name_en'] . ' ' . $product['name_ar']); ?>">
                    <div class="product-image">
                        <?php if (!empty($product['image'])): ?>
                            <img src="assets/images/products/<?php echo htmlspecialchars($product['image']); ?>" 
                                 alt="<?php echo htmlspecialchars($lang === 'ar' ? $product['name_ar'] : $product['name_en']); ?>">
                        <?php else: ?>
                            <div class="placeholder-image">🧪</div>
                        <?php endif; ?>
                    </div>
                    <div class="product-info">
                        <h3>
                            <a href="product.php?id=<?php echo $product['id']; ?>" class="product-link">
                                <?php echo $lang === 'ar' ? $product['name_ar'] : $product['name_en']; ?>
                            </a>
                        </h3>
                        <p class="product-desc"><?php echo $lang === 'ar' ? $product['description_ar'] : $product['description_en']; ?></p>
                        <div class="product-details">
                            <div class="detail-item">
                                <span class="detail-label"><?php echo $trans['products']['category']; ?>:</span>
                                <span class="badge"><?php echo $product['category']; ?></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label"><?php echo $trans['products']['strength']; ?>:</span>
                                <span><?php echo $product['strength']; ?></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label"><?php echo $trans['products']['pack_size']; ?>:</span>
                                <span><?php echo $product['pack_size']; ?></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label"><?php echo $trans['products']['manufacturer']; ?>:</span>
                                <span><?php echo $product['manufacturer']; ?></span>
                            </div>
                        </div>
                        <a href=product.php?id=<?php echo $product['id']; ?>" class="btn btn-primary btn-block ripple">
                            <?php echo $trans['products']['view_details']; ?>
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <div id="noProducts" class="no-products" style="display: none;">
                <p><?php echo $trans['products']['no_products']; ?></p>
            </div>
        </div>
    </section>
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
