<?php
/**
 * Template Name: Home Page
 *
 * Custom page template for the Insure Inc landing page.
 * All section content is pulled from post meta fields managed via ACF.
 *
 * @package InsureInc
 * @version 1.0.0
 * @author  Bhagyashree Sarwad
 */

get_header();


/* =============================================================================
   GET POST META
   Pull all ACF / custom meta values for this page upfront.
   Fields are registered in functions.php via register_post_meta() or ACF.
============================================================================= */

$post_id = get_the_ID();

// Hero
$hero_title    = get_post_meta( $post_id, 'hero_title',    true );
$hero_subtitle = get_post_meta( $post_id, 'hero_subtitle', true );

// About
$about_title    = get_post_meta( $post_id, 'about_title',    true );
$about_content  = get_post_meta( $post_id, 'about_content',  true );
$about_image    = trim( get_post_meta( $post_id, 'about_image', true ) );
$about_features = get_post_meta( $post_id, 'about_features', true );
$feature_items  = array_filter( explode( "\n", $about_features ) );

// Coverage & FAQ (pipe-delimited rows, one per line)
$coverage       = get_post_meta( $post_id, 'coverage', true );
$faqs           = get_post_meta( $post_id, 'faqs',     true );
$coverage_items = array_filter( explode( "\n", $coverage ) );
$faq_items      = array_filter( explode( "\n", $faqs ) );

// Contact
$map_location = get_post_meta( $post_id, 'map_location', true );
?>


<!-- ============================================================
     HERO SECTION
     Fields: hero_title, hero_subtitle
============================================================ -->
<section id="hero" class="hero-section">
    <div class="container hero-inner">

        <div class="hero-content">

            <span class="hero-badge">🚀 Trusted by 50,000+ Customers</span>

            <h1>
                <?php echo $hero_title ?: 'Automobile Insurance support that lets you'; ?>
            </h1>

            <p><?php echo $hero_subtitle ?: 'Expert consultation for your Automobile Insurance needs.'; ?></p>

       <div class="hero-actions">
    <?php $hero_phone = get_post_meta( $post_id, 'hero_phone', true ) ?: '080-4208-6798'; ?>
    <a href="tel:<?php echo esc_attr( $hero_phone ); ?>" class="btn btn-primary">📞 Get a Call</a>
    <a href="#coverage" class="btn btn-outline">Explore Plans</a>
</div>

            <div class="hero-features">
                <span>🛡️ Instant Policy</span>
                <span>🛡️ 13+ Add-ons</span>
                <span>🛡️ 24/7 Support</span>
            </div>

        </div><!-- .hero-content -->

        <div class="hero-form">
            <div class="form-header">Get Instant Policy</div>
            <form>
                <input type="text"   placeholder="Enter your name">
                <input type="email"  placeholder="Enter your email">
                <input type="text"   placeholder="Enter your phone">
                   <input type="text" name="reg_no" placeholder="Registration Number" id="reg_no">
        <label class="check" for="is_new">
            <input type="checkbox" name="is_new" id="is_new">
            It's a new Automobile!
        </label>
                <button type="submit">Submit</button>
            </form>
        </div><!-- .hero-form -->

    </div><!-- .hero-inner -->
</section><!-- #hero -->


<!-- ============================================================
     ABOUT SECTION
     Fields: about_image, about_features, about_title, about_content
============================================================ -->
<section id="about" class="about-section">
    <div class="container about-inner">

        <!-- Left: image + feature badges + CTA -->
        <div class="about-left">

            <?php
            // Use the ACF image URL if set, otherwise fall back to a local asset.
            $about_img_url = ! empty( $about_image )
                ? $about_image
                : get_template_directory_uri() . '/assets/images/car.png';
            ?>
            <div class="about-image-wrap">
                <img src="<?php echo esc_url( $about_img_url ); ?>" alt="Car">
            </div>

            <div class="about-features">
                <?php foreach ( $feature_items as $feature ) : ?>
                    <div class="feature-badge">
                        <span class="badge-icon">⭐</span>
                        <span><?php echo esc_html( $feature ); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>

            <a href="#" class="btn btn-primary about-btn">Get Started →</a>

        </div><!-- .about-left -->

        <!-- Right: heading + body copy -->
        <div class="about-right">
            <span class="about-tag">🚗 Why Choose Us</span>
            <h2><?php echo $about_title ?: "Let's get you started on your Automobile Insurance journey!"; ?></h2>
            <p><?php echo $about_content ?: 'Default about text'; ?></p>
        </div><!-- .about-right -->

    </div><!-- .about-inner -->
</section><!-- #about -->


<!-- ============================================================
     COVERAGE SECTION
     Field: coverage — one item per line, format: Title|Description
============================================================ -->
<section id="coverage" class="coverage-section">
    <div class="container">

        <h2>Coverage</h2>

        <div class="coverage-grid">
            <?php
            $icons = [ '🚗', '🔐', '🔧', '👤', '⚖️', '🌊' ];
            $i     = 0;

            foreach ( $coverage_items as $item ) :
                $parts = explode( '|', $item );
            ?>
                <div class="coverage-card" data-num="<?php echo $i + 1; ?>">
                    <div class="card-icon"><?php echo $icons[ $i % 6 ]; ?></div>
                    <h3><?php echo esc_html( $parts[0] ?? '' ); ?></h3>
                    <p><?php echo esc_html( $parts[1] ?? '' ); ?></p>
                </div>
            <?php
                $i++;
            endforeach;
            ?>
        </div><!-- .coverage-grid -->

    </div><!-- .container -->
</section><!-- #coverage -->


<!-- ============================================================
     FAQ SECTION
     Field: faqs — one item per line, format: Question|Answer
     First item is open by default (.active).
============================================================ -->
<section id="faq" class="faq-section">
    <div class="container">

        <div class="section-header">
            <h2>FAQs</h2>
        </div>

        <div class="faq-list">
            <?php foreach ( $faq_items as $index => $faq ) :
                $parts = explode( '|', $faq );
            ?>
                <div class="faq-item <?php echo $index === 0 ? 'active' : ''; ?>">
                    <div class="faq-question">
                        <h4><?php echo esc_html( $parts[0] ?? '' ); ?></h4>
                        <span class="faq-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        <p><?php echo esc_html( $parts[1] ?? '' ); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div><!-- .faq-list -->

    </div><!-- .container -->
</section><!-- #faq -->


<!-- ============================================================
     CONTACT SECTION
     Field: map_location — plain text address passed to Google Maps embed
============================================================ -->
<section id="contact" class="contact-section">

    <div class="contact-overlay"></div>

    <div class="container contact-inner">

        <!-- Google Maps embed -->
        <div class="contact-map">
            <iframe
                src="https://www.google.com/maps?q=<?php echo urlencode( $map_location ?: 'Bangalore' ); ?>&output=embed"
                loading="lazy">
            </iframe>
        </div><!-- .contact-map -->

        <!-- Contact form -->
        <div class="contact-form glass">
            <h3>Contact Us</h3>
            <p class="contact-sub">We'll get back to you within 24 hours</p>
            <form class="contact-form-fields">
                <div class="form-row">
                    <input type="email" placeholder="Email">
                    <input type="text"  placeholder="Phone">
                </div>
                <textarea placeholder="Your message"></textarea>
                <button type="submit">Send Message</button>
            </form>
        </div><!-- .contact-form -->

    </div><!-- .contact-inner -->

</section><!-- #contact -->


<?php get_footer(); ?>