<?php
/**
 * Insure Inc - functions.php
 * Theme setup, ACF field registration, script/style enqueueing
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/* =============================================
   THEME SETUP
============================================= */
function insure_theme_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'gallery', 'caption' ) );
    add_theme_support( 'custom-logo' );
    add_theme_support( 'menus' );

    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'insure-inc' ),
    ) );
}
add_action( 'after_setup_theme', 'insure_theme_setup' );

/* =============================================
   ENQUEUE STYLES & SCRIPTS
============================================= */
function insure_enqueue_assets() {
    // Google Fonts
    wp_enqueue_style(
        'insure-fonts',
        'https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=Lora:ital,wght@0,400;0,600;0,700;1,400;1,600&display=swap',
        array(),
        null
    );

    // Main stylesheet
    wp_enqueue_style(
        'insure-main',
        get_template_directory_uri() . '/assets/css/main.css',
        array(),
        wp_get_theme()->get( 'Version' )
    );

    // Main JS
    wp_enqueue_script(
        'insure-main',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        wp_get_theme()->get( 'Version' ),
        true
    );
}
add_action( 'wp_enqueue_scripts', 'insure_enqueue_assets' );

/* =============================================
   ACF FIELD GROUPS (PHP Registration)
   Fallback if JSON sync not used
============================================= */
function insure_register_acf_fields() {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) return;

    /* ---- HERO SECTION ---- */
    acf_add_local_field_group( array(
        'key'    => 'group_hero',
        'title'  => 'Hero Section',
        'fields' => array(
            array(
                'key'   => 'field_hero_badge',
                'label' => 'Badge Text',
                'name'  => 'hero_badge',
                'type'  => 'text',
                'default_value' => 'Trusted by 50,000+ Customers',
            ),
            array(
                'key'   => 'field_hero_title',
                'label' => 'Hero Title',
                'name'  => 'hero_title',
                'type'  => 'text',
                'default_value' => 'Automobile Insurance support that lets you <em>Ride</em> with confidence.',
                'instructions' => 'Use &lt;em&gt; tags for italic/highlighted text.',
            ),
            array(
                'key'   => 'field_hero_subtitle',
                'label' => 'Hero Subtitle',
                'name'  => 'hero_subtitle',
                'type'  => 'textarea',
                'rows'  => 2,
                'default_value' => 'Expert consultation for your Automobile Insurance needs. Get covered in minutes.',
            ),
            array(
                'key'   => 'field_hero_phone',
                'label' => 'Phone Number',
                'name'  => 'hero_phone',
                'type'  => 'text',
                'default_value' => '080-4208-6798',
            ),
            array(
                'key'   => 'field_hero_form_title',
                'label' => 'Form Header Title',
                'name'  => 'hero_form_title',
                'type'  => 'text',
                'default_value' => 'Get Instant Policy',
            ),
        ),
        'location' => array( array( array(
            'param'    => 'page_template',
            'operator' => '==',
            'value'    => 'page-home.php',
        ) ) ),
    ) );

    /* ---- ABOUT SECTION ---- */
    acf_add_local_field_group( array(
        'key'    => 'group_about',
        'title'  => 'About Section',
        'fields' => array(
            array(
                'key'   => 'field_about_tag',
                'label' => 'Section Tag',
                'name'  => 'about_tag',
                'type'  => 'text',
                'default_value' => 'Why Choose Us',
            ),
            array(
                'key'   => 'field_about_title',
                'label' => 'Section Title',
                'name'  => 'about_title',
                'type'  => 'text',
                'default_value' => "Let's get you started on your Automobile Insurance journey!",
            ),
            array(
                'key'   => 'field_about_content',
                'label' => 'Section Content',
                'name'  => 'about_content',
                'type'  => 'wysiwyg',
                'toolbar' => 'basic',
            ),
            array(
                'key'   => 'field_about_image',
                'label' => 'Car Image',
                'name'  => 'about_image',
                'type'  => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
            ),
            array(
                'key'        => 'field_about_features',
                'label'      => 'Feature Badges',
                'name'       => 'about_features',
                'type'       => 'repeater',
                'min'        => 1,
                'max'        => 6,
                'button_label' => 'Add Feature',
                'sub_fields' => array(
                    array(
                        'key'   => 'field_feature_icon',
                        'label' => 'Icon (emoji or HTML)',
                        'name'  => 'icon',
                        'type'  => 'text',
                        'default_value' => '✔',
                    ),
                    array(
                        'key'   => 'field_feature_text',
                        'label' => 'Feature Text',
                        'name'  => 'text',
                        'type'  => 'text',
                        'default_value' => 'Online, Instant & Super Quick',
                    ),
                ),
            ),
        ),
        'location' => array( array( array(
            'param'    => 'page_template',
            'operator' => '==',
            'value'    => 'page-home.php',
        ) ) ),
    ) );

    /* ---- COVERAGE SECTION ---- */
    acf_add_local_field_group( array(
        'key'    => 'group_coverage',
        'title'  => 'Coverage Section',
        'fields' => array(
            array(
                'key'   => 'field_coverage_title',
                'label' => 'Section Title',
                'name'  => 'coverage_title',
                'type'  => 'text',
                'default_value' => 'What are covered under the Automobile Insurance?',
            ),
            array(
                'key'        => 'field_coverage_cards',
                'label'      => 'Coverage Cards',
                'name'       => 'coverage_cards',
                'type'       => 'repeater',
                'min'        => 1,
                'button_label' => 'Add Coverage Card',
                'sub_fields' => array(
                    array(
                        'key'   => 'field_card_icon',
                        'label' => 'Icon (emoji)',
                        'name'  => 'icon',
                        'type'  => 'text',
                        'default_value' => '🛡️',
                    ),
                    array(
                        'key'   => 'field_card_title',
                        'label' => 'Card Title',
                        'name'  => 'title',
                        'type'  => 'text',
                    ),
                    array(
                        'key'   => 'field_card_desc',
                        'label' => 'Card Description',
                        'name'  => 'description',
                        'type'  => 'textarea',
                        'rows'  => 3,
                    ),
                ),
            ),
        ),
        'location' => array( array( array(
            'param'    => 'page_template',
            'operator' => '==',
            'value'    => 'page-home.php',
        ) ) ),
    ) );

    /* ---- FAQ SECTION ---- */
    acf_add_local_field_group( array(
        'key'    => 'group_faq',
        'title'  => 'FAQ Section',
        'fields' => array(
            array(
                'key'   => 'field_faq_title',
                'label' => 'Section Title',
                'name'  => 'faq_title',
                'type'  => 'text',
                'default_value' => 'Frequently Asked Questions',
            ),
            array(
                'key'        => 'field_faqs',
                'label'      => 'FAQ Items',
                'name'       => 'faqs',
                'type'       => 'repeater',
                'min'        => 1,
                'button_label' => 'Add FAQ',
                'sub_fields' => array(
                    array(
                        'key'   => 'field_faq_q',
                        'label' => 'Question',
                        'name'  => 'question',
                        'type'  => 'text',
                    ),
                    array(
                        'key'   => 'field_faq_a',
                        'label' => 'Answer',
                        'name'  => 'answer',
                        'type'  => 'textarea',
                        'rows'  => 4,
                    ),
                ),
            ),
        ),
        'location' => array( array( array(
            'param'    => 'page_template',
            'operator' => '==',
            'value'    => 'page-home.php',
        ) ) ),
    ) );

    /* ---- CONTACT SECTION ---- */
    acf_add_local_field_group( array(
        'key'    => 'group_contact',
        'title'  => 'Contact Section',
        'fields' => array(
            array(
                'key'   => 'field_contact_title',
                'label' => 'Section Title',
                'name'  => 'contact_title',
                'type'  => 'text',
                'default_value' => 'Contact Us',
            ),
            array(
                'key'   => 'field_contact_subtitle',
                'label' => 'Subtitle',
                'name'  => 'contact_subtitle',
                'type'  => 'text',
                'default_value' => 'We\'re here to help. Reach out to us anytime.',
            ),
            array(
                'key'   => 'field_contact_map_url',
                'label' => 'Google Maps Embed URL',
                'name'  => 'contact_map_url',
                'type'  => 'url',
                'instructions' => 'Paste the embed URL from Google Maps (Share > Embed a map > copy src URL).',
            ),
        ),
        'location' => array( array( array(
            'param'    => 'page_template',
            'operator' => '==',
            'value'    => 'page-home.php',
        ) ) ),
    ) );
}
add_action( 'acf/init', 'insure_register_acf_fields' );

/* =============================================
   CONTACT FORM HANDLER (AJAX)
============================================= */
function insure_handle_contact_form() {
    check_ajax_referer( 'insure_contact_nonce', 'nonce' );

    $name    = sanitize_text_field( $_POST['name'] ?? '' );
    $email   = sanitize_email( $_POST['email'] ?? '' );
    $phone   = sanitize_text_field( $_POST['phone'] ?? '' );
    $message = sanitize_textarea_field( $_POST['message'] ?? '' );

    if ( empty( $email ) || ! is_email( $email ) ) {
        wp_send_json_error( array( 'message' => 'Please enter a valid email address.' ) );
    }

    $admin_email = get_option( 'admin_email' );
    $subject     = 'New Contact Form Submission - Insure Inc';
    $body        = "Name: $name\nEmail: $email\nPhone: $phone\n\nMessage:\n$message";
    $headers     = array( 'Content-Type: text/plain; charset=UTF-8', "Reply-To: $email" );

    wp_mail( $admin_email, $subject, $body, $headers );
    wp_send_json_success( array( 'message' => 'Thank you! We will get back to you shortly.' ) );
}
add_action( 'wp_ajax_insure_contact', 'insure_handle_contact_form' );
add_action( 'wp_ajax_nopriv_insure_contact', 'insure_handle_contact_form' );

/* =============================================
   POLICY FORM HANDLER (AJAX)
============================================= */
function insure_handle_policy_form() {
    check_ajax_referer( 'insure_policy_nonce', 'nonce' );

    $name   = sanitize_text_field( $_POST['name'] ?? '' );
    $email  = sanitize_email( $_POST['email'] ?? '' );
    $phone  = sanitize_text_field( $_POST['phone'] ?? '' );
    $reg_no = sanitize_text_field( $_POST['reg_no'] ?? '' );
    $is_new = isset( $_POST['is_new'] ) ? 'Yes' : 'No';

    if ( empty( $name ) || empty( $email ) ) {
        wp_send_json_error( array( 'message' => 'Please fill in all required fields.' ) );
    }

    $admin_email = get_option( 'admin_email' );
    $subject     = 'New Policy Request - Insure Inc';
    $body        = "Name: $name\nEmail: $email\nPhone: $phone\nRegistration No: $reg_no\nNew Automobile: $is_new";
    $headers     = array( 'Content-Type: text/plain; charset=UTF-8' );

    wp_mail( $admin_email, $subject, $body, $headers );
    wp_send_json_success( array( 'message' => 'Request submitted! Our team will contact you soon.' ) );
}
add_action( 'wp_ajax_insure_policy', 'insure_handle_policy_form' );
add_action( 'wp_ajax_nopriv_insure_policy', 'insure_handle_policy_form' );

/* =============================================
   LOCALIZE AJAX URL FOR JS
============================================= */
function insure_localize_script() {
    wp_localize_script( 'insure-main', 'insureAjax', array(
        'url'            => admin_url( 'admin-ajax.php' ),
        'policy_nonce'   => wp_create_nonce( 'insure_policy_nonce' ),
        'contact_nonce'  => wp_create_nonce( 'insure_contact_nonce' ),
    ) );
}
add_action( 'wp_enqueue_scripts', 'insure_localize_script', 20 );

/* =============================================
   ACF JSON SAVE/LOAD PATH
============================================= */
function insure_acf_json_save( $path ) {
    return get_template_directory() . '/acf-json';
}
add_filter( 'acf/settings/save_json', 'insure_acf_json_save' );

function insure_acf_json_load( $paths ) {
    $paths[] = get_template_directory() . '/acf-json';
    return $paths;
}
add_filter( 'acf/settings/load_json', 'insure_acf_json_load' );


function theme_scripts() {
  wp_enqueue_script('custom-js', get_template_directory_uri().'/script.js', array(), null, true);
}
add_action('wp_enqueue_scripts','theme_scripts');
add_action('add_meta_boxes', function() {
    add_meta_box('home_fields', 'Home Page Fields', function($post) {

        $hero_title = get_post_meta($post->ID, 'hero_title', true);
        $hero_subtitle = get_post_meta($post->ID, 'hero_subtitle', true);

        $about_title = get_post_meta($post->ID, 'about_title', true);
        $about_content = get_post_meta($post->ID, 'about_content', true);
        $about_features = get_post_meta($post->ID, 'about_features', true);

        $coverage = get_post_meta($post->ID, 'coverage', true);
        $faqs = get_post_meta($post->ID, 'faqs', true);
        $map_location = get_post_meta($post->ID, 'map_location', true);
        $about_image = get_post_meta($post->ID, 'about_image', true);
?>

        <h3>Hero Section</h3>
        <input type="text" name="hero_title" value="<?php echo esc_attr($hero_title); ?>" style="width:100%;">
        <input type="text" name="hero_subtitle" value="<?php echo esc_attr($hero_subtitle); ?>" style="width:100%;">
        <input type="text" name="hero_phone" placeholder="Phone Number e.g. 080-4208-6798" value="<?php echo esc_attr( get_post_meta( $post_id, 'hero_phone', true ) ); ?>" style="width:100%;">

        <h3>About Section</h3>
        <input type="text" name="about_title" value="<?php echo esc_attr($about_title); ?>" style="width:100%;">
        <textarea name="about_content" style="width:100%; height:100px;"><?php echo esc_textarea($about_content); ?></textarea>

        <h4>About Features (one per line)</h4>
        <textarea name="about_features" style="width:100%; height:100px;"><?php echo esc_textarea($about_features); ?></textarea>

        <h4>About Image URL</h4>
        <input type="text" name="about_image" value="<?php echo esc_attr($about_image); ?>" style="width:100%;">

        <h3>Coverage (Title|Description)</h3>
        <textarea name="coverage" style="width:100%; height:120px;"><?php echo esc_textarea($coverage); ?></textarea>

        <h3>FAQs (Question|Answer)</h3>
        <textarea name="faqs" style="width:100%; height:120px;"><?php echo esc_textarea($faqs); ?></textarea>

        <h3>Map Location</h3>
        <input type="text" name="map_location" value="<?php echo esc_attr($map_location); ?>" style="width:100%;">

        <?php
    }, 'page', 'normal', 'high');
});


add_action('save_post', function($post_id) {


    $fields = ['hero_title','hero_subtitle','hero_phone','about_title','about_content', 'about_image', 'about_features','coverage','faqs','map_location'];

    foreach($fields as $field){
        if(isset($_POST[$field])){
            update_post_meta($post_id, $field, sanitize_textarea_field($_POST[$field]));
        }
    }
});