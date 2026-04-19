<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header" id="site-header">
    <div class="container">
        <nav class="navbar">

            <!-- Logo -->
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-logo">
                <div class="logo-icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2L3 7V12C3 16.5 6.8 20.7 12 22C17.2 20.7 21 16.5 21 12V7L12 2Z" fill="white" opacity="0.95"/>
                        <path d="M9 12L11 14L15 10" stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                INSURE <span class="inc">inc.</span>
            </a>

            <!-- Desktop Nav -->
            <ul class="nav-menu" id="nav-menu">
                <li><a href="<?php echo esc_url( home_url( '#hero' ) ); ?>">Home</a></li>
                <li><a href="<?php echo esc_url( home_url( '#about' ) ); ?>">About Us</a></li>
                <li><a href="<?php echo esc_url( home_url( '#coverage' ) ); ?>">Coverage</a></li>
                <li><a href="<?php echo esc_url( home_url( '#contact' ) ); ?>" class="nav-cta">Contact Us</a></li>
            </ul>

            <!-- Hamburger -->
            <button class="hamburger" id="hamburger" aria-label="Toggle menu" aria-expanded="false">
                <span></span>
                <span></span>
                <span></span>
            </button>

        </nav>
    </div>
</header>
