<nav class="navbar">
    <div class="container">
        <div class="nav-brand">
            <a href="index.php">
                <img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/dev/assets/images/logo.svg" alt="Logo" class="logo">
                <!-- <span class="logo-icon">🐾</span>
                <span class="logo-text"><?php echo $trans['site_name']; ?></span> -->
            </a>
        </div>

        <button class="nav-toggle" id="navToggle">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <div class="nav-menu" id="navMenu">
            <ul class="nav-links">
                <li><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/dev/index.php" class="nav-link"><?php echo $trans['nav']['home']; ?></a></li>
                <li><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/dev/products.php" class="nav-link"><?php echo $trans['nav']['products']; ?></a></li>
                <li><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/dev/about.php" class="nav-link"><?php echo $trans['nav']['about']; ?></a></li>
                <li><a href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/dev/contact.php" class="nav-link"><?php echo $trans['nav']['contact']; ?></a></li>
            </ul>

            <div class="nav-actions">
                <div class="lang-switcher">
                    <button class="lang-btn <?php echo $lang === 'en' ? 'active' : ''; ?>" data-lang="en">EN</button>
                    <button class="lang-btn <?php echo $lang === 'ar' ? 'active' : ''; ?>" data-lang="ar">ع</button>
                </div>

                <div class="theme-switcher">
                    <button class="theme-btn" id="themeToggle" title="Toggle theme">
                        <span class="theme-icon">🌙</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</nav>