<?php
require_once __DIR__ . '/../includes/guard.php';
require_once __DIR__ . '/../includes/functions.php';

$lang = getCurrentLanguage();
$trans = getTranslations($lang);

$products = getJsonData('products.json');
$quotations = getJsonData('quotations.json');
$messages = getJsonData('messages.json');

$unreadMessages = count(array_filter($messages, function($msg) {
    return !($msg['read'] ?? false);
}));
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $trans['admin']['dashboard']; ?> - <?php echo $trans['site_name']; ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href="../assets/css/dark.css">
</head>
<body>
    <?php include 'includes/admin-nav.php'; ?>
    
    <div class="admin-container">
        <div class="admin-header">
            <h1><?php echo $trans['admin']['dashboard']; ?></h1>
        </div>
        
        <div class="dashboard-stats">
            <div class="stat-card">
                <div class="stat-icon">📦</div>
                <div class="stat-info">
                    <h3><?php echo count($products); ?></h3>
                    <p><?php echo $trans['admin']['total_products']; ?></p>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">📋</div>
                <div class="stat-info">
                    <h3><?php echo count($quotations); ?></h3>
                    <p><?php echo $trans['admin']['total_quotations']; ?></p>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon">✉️</div>
                <div class="stat-info">
                    <h3><?php echo $unreadMessages; ?></h3>
                    <p><?php echo $trans['admin']['unread_messages']; ?></p>
                </div>
            </div>
        </div>
        
        <div class="dashboard-actions">
            <a href="products.php" class="action-card">
                <div class="action-icon">📦</div>
                <h3><?php echo $trans['admin']['products']; ?></h3>
                <p>Manage veterinary products</p>
            </a>
            
            <a href="quotations.php" class="action-card">
                <div class="action-icon">📋</div>
                <h3><?php echo $trans['admin']['quotations']; ?></h3>
                <p>View quotation requests</p>
            </a>
            
            <a href="messages.php" class="action-card">
                <div class="action-icon">✉️</div>
                <h3><?php echo $trans['admin']['messages']; ?></h3>
                <p>Read contact messages</p>
            </a>
            
            <a href="settings.php" class="action-card">
                <div class="action-icon">⚙️</div>
                <h3><?php echo $trans['admin']['settings']; ?></h3>
                <p>Update company info</p>
            </a>
        </div>
    </div>
    
    <script src="../assets/js/theme.js"></script>
</body>
</html>
