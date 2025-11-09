<?php
session_start();
require_once __DIR__ . '/../includes/functions.php';

if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
    header('Location: dashboard.php');
    exit;
}

$lang = getCurrentLanguage();
$trans = getTranslations($lang);
$loginError = $_SESSION['login_error'] ?? '';
unset($_SESSION['login_error']);
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $trans['admin']['login']; ?> - <?php echo $trans['site_name']; ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href="../assets/css/dark.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <div class="login-header">
                <h1>🐾 <?php echo $trans['site_name']; ?></h1>
                <p><?php echo $trans['admin']['login']; ?></p>
            </div>
            
            <?php if ($loginError): ?>
            <div class="alert alert-error"><?php echo $loginError; ?></div>
            <?php endif; ?>
            
            <form action="auth.php" method="POST" class="login-form">
                <div class="form-group">
                    <label><?php echo $trans['admin']['username']; ?></label>
                    <input type="text" name="username" required autofocus>
                </div>
                <div class="form-group">
                    <label><?php echo $trans['admin']['password']; ?></label>
                    <input type="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block"><?php echo $trans['admin']['login_button']; ?></button>
            </form>
            
            <div class="login-footer">
                <small>Default: admin / password</small>
            </div>
        </div>
    </div>
    
    <script src="../assets/js/theme.js"></script>
</body>
</html>
