<?php
require_once 'includes/functions.php';
$pageTitle = t('nav.home');
require_once 'includes/header.php';
require_once 'includes/navbar.php';

$services = getJsonData('services.json');
$products = getJsonData('products.json');
$featuredProducts = array_slice($products, 0, 3);
?>

<main class="home-page">
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content fade-in">
                <h1 class="hero-title"><?php echo $trans['home']['banner_title']; ?></h1>
                <p class="hero-subtitle"><?php echo $trans['home']['banner_subtitle']; ?></p>
                <a href=products.php" class="btn btn-primary ripple"><?php echo $trans['home']['banner_cta']; ?></a>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services-section">
        <div class="container">
            <h2 class="section-title"><?php echo $trans['home']['featured_services']; ?></h2>
            <div class="services-grid">
                <?php foreach ($services as $service): ?>
                <div class="service-card tilt-card fade-in-scroll">
                    <div class="service-icon"><?php echo $service['icon'] === 'consult.svg' ? '🩺' : ($service['icon'] === 'delivery.svg' ? '🚚' : ($service['icon'] === 'quality.svg' ? '✅' : '📦')); ?></div>
                    <h3><?php echo $lang === 'ar' ? $service['title_ar'] : $service['title_en']; ?></h3>
                    <p><?php echo $lang === 'ar' ? $service['desc_ar'] : $service['desc_en']; ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="products-section">
        <div class="container">
            <h2 class="section-title"><?php echo $trans['home']['featured_products']; ?></h2>
            <div class="products-grid">
                <?php foreach ($featuredProducts as $product): ?>
                <div class="product-card fade-in-scroll">
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
                        <div class="product-meta">
                            <span class="badge"><?php echo $product['category']; ?></span>
                            <span><?php echo $product['strength']; ?></span>
                        </div>
                        <a href="product.php?id=<?php echo $product['id']; ?>" class="btn btn-outline btn-block ripple">
                            <?php echo $trans['products']['view_details']; ?>
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="text-center" style="margin-top: 2rem;">
                <a href="products.php" class="btn btn-primary ripple"><?php echo $trans['home']['view_all']; ?></a>
            </div>
        </div>
    </section>

    <!-- Contact CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content fade-in-scroll">
                <h2><?php echo $trans['home']['contact_cta_title']; ?></h2>
                <p><?php echo $trans['home']['contact_cta_desc']; ?></p>
                <a href=contact.php" class="btn btn-secondary ripple"><?php echo $trans['home']['contact_cta_button']; ?></a>
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
                <input type="number" name="quantity" min="1" required>
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
