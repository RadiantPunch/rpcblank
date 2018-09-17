<?php if ( ! defined( 'ABSPATH' ) ) { exit; }

/*
---------------------------------------------------------------------------
THEME SETUP
---------------------------------------------------------------------------
*/

function rpcblank_theme_setup() {
    $header_args = array(
        'default-image'          => '',
        'width'                  => 0,
        'height'                 => 0,
        'flex-width'             => true,
        'flex-height'            => true,
        'uploads'                => false,
        'random-default'         => false,
        'header-text'            => true,
        'default-text-color'     => '',
        'wp-head-callback'       => '',
        'admin-head-callback'    => '',
        'admin-preview-callback' => '',
        'video'                  => false,
        'video-active-callback'  => '',
    );
    add_theme_support( 'custom-header', $header_args );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'post-formats', array( 'status', 'quote', 'gallery', 'image', 'video', 'audio', 'link', 'aside', 'chat' ) );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
    add_theme_support( 'title-tag' );
    add_theme_support( 'admin-bar', array( 'callback' => '__return_false' ) );

    if ( ! isset( $content_width ) ) $content_width = 1200;
    
    load_theme_textdomain( 'rpcblank', get_template_directory() . '/language' );
}

function rpcblank_remove_admin_bar_inline_print_css() {
    remove_action('wp_head', 'wp_admin_bar_header');
}

add_action( 'after_setup_theme', 'rpcblank_theme_setup' );
add_action( 'admin_bar_init', 'rpcblank_remove_admin_bar_inline_print_css' );


/*
---------------------------------------------------------------------------
STYLESHEETS
---------------------------------------------------------------------------
*/

// --- Add theme styles ---

function rpcblank_add_css() {
    wp_enqueue_style( 'rpcblank', get_template_directory_uri() . '/style.css', '' );
    wp_enqueue_style( 'tablet', get_template_directory_uri() . '/assets/css/tablet.css', 'rpcblank' );
    wp_enqueue_style( 'desktop', get_template_directory_uri() . '/assets/css/desktop.css', 'rpcblank' );
    wp_enqueue_style( 'print', get_template_directory_uri() . '/assets/css/print.css', 'rpcblank', false, 'print' );
}

function rpcblank_add_editor_css() {
    add_editor_style( 'editor', get_template_directory_uri() . '/assets/css/editor.css' );
}

add_action( 'wp_enqueue_scripts', 'rpcblank_add_css' );
add_action( 'init', 'rpcblank_add_editor_css' );

// --- Format HTML links to stylesheets ---

function rpcblank_format_css_html_in_head( $html, $handle, $href, $media ) {
    return '<link rel="stylesheet" id="' . $handle . '" href="' . $href . '" media="' . $media . '" />' . "\n";
}

add_filter( 'style_loader_tag', 'rpcblank_format_css_html_in_head', 10, 4 );

// --- Remove unnecessary WP default styles ---

function rpcblank_remove_wp_default_styles() {
    wp_dequeue_style('wp-mediaelement');
    wp_deregister_style('wp-mediaelement');
}

add_action( 'wp_print_styles', 'rpcblank_remove_wp_default_styles' );


/*
---------------------------------------------------------------------------
SCRIPTS
---------------------------------------------------------------------------
*/

// --- Add theme scripts ---

function rpcblank_add_scripts() {
    wp_register_script( 'share', get_template_directory_uri() . '/assets/js/share.js', false, '', false );
    wp_register_script( 'navigation', get_template_directory_uri() . '/assets/js/navigation.js', false, '', false );   
    wp_enqueue_script( 'navigation' );
    if ( is_single() ) {
        wp_enqueue_script( 'share' );
        if ( comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' ); 
        }
    }
}

add_action( 'wp_enqueue_scripts', 'rpcblank_add_scripts' );

// --- Format HTML links to scripts, defer & async ---

function rpcblank_format_script_html( $tag, $handle, $src ) {
    $defer_scripts = array( 
        'backbone',
        'comment-reply',
        'jquery-migrate',
        'mediaelement-core',
        'mediaelement-migrate',
        'mediaelement-vimeo',
        'navigation',
        'share',
        'underscore',
        'wp-embed',
        'wp-mediaelement',
        'wp-playlist',
        'wp-util'
    );
    if ( in_array( $handle, $defer_scripts ) ) {
        $defer = ' defer="defer"';
    }
    return '<script src="' . $src . '"' . $defer . '></script>' . "\n";
}

add_filter( 'script_loader_tag', 'rpcblank_format_script_html', 10, 3 );

// --- Add Google Tag Manger script ---

function rpcblank_gtagmanager_container_code() {
    return 'CONTAINER-CODE';
}

function rpcblank_add_gtagmanager_script() {
    $container = rpcblank_gtagmanager_container_code();
    ?><!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){ w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','<?php $container ?>');</script>
    <!-- End Google Tag Manager --><?php
}

add_action( 'wp_head', 'rpcblank_add_gtagmanager_script', 2 );


/*
---------------------------------------------------------------------------
NAVIGATION
---------------------------------------------------------------------------
*/

// --- Register theme navigation menus --- //

function rpcblank_register_nav_menus() {
    register_nav_menus( array(
        'main-menu' => 'Main Menu',
    ) );
}

add_action( 'init', 'rpcblank_register_nav_menus' );

// --- Create menus to be called in templates

function rpcblank_main_menu() {
    wp_nav_menu( array(
        'menu'  =>  'main-menu',
        'menu_class' => 'main-menu menu-links',
        'menu_id' => 'main-menu',
        'container' => '',
        'fallback_cb' => false,
        'before' => '',
        'after' => '',
        'link_before' => '',
        'link_after' => '',
        'echo' => true,
        'depth' => 0,
        'theme_location' => 'main-menu',
    ) );
}

// --- Filter menu ids and classes, keeping only those that are needed

function rpcblank_remove_menu_item_ids( $ids ) {
    return is_array( $ids ) ? array() : '';
}

function rpcblank_filter_menu_classes( $classes, $item ) {
    $classes = array_filter( 
        $classes, 
        function( $class ) { 
            return in_array( $class, array( 
                'current-menu-item', 
                'menu-item-has-children'
            ) );
        }
    );
    array_merge(
        $classes,
        (array)get_post_meta( $item->ID, '_menu_item_classes', true )
    );
    return array_map( 'trim', $classes );
}

add_filter( 'nav_menu_item_id', 'rpcblank_remove_menu_item_ids', 100, 1 );
add_filter( 'nav_menu_css_class', 'rpcblank_filter_menu_classes', 10, 2 );


/*
---------------------------------------------------------------------------
CONTENT FILTERS
---------------------------------------------------------------------------
*/
function rpcblank_remove_attribs( $content ) {
    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->LoadHTML( mb_convert_encoding( $content, 'HTML-ENTITIES', 'UTF-8' ), LIBXML_HTML_NODEFDTD | LIBXML_HTML_NOIMPLIED );
    libxml_use_internal_errors(false);
    $xpath = new DOMXPath( $dom );    
    
    $elements = $xpath->query( "//*[@width or @height or @style]|//iframe[@frameborder]" );
    foreach ( $elements as $el ) {
        if ( $el->hasAttribute( 'width' ) ) {
            $el->removeAttribute( 'width' );
        };
        if ( $el->hasAttribute( 'height' ) ) {
            $el->removeAttribute( 'height' );
        };
        if ( $el->hasAttribute( 'style' ) ) {
            $el->removeAttribute( 'style' );
        };
        if ( $el->hasAttribute( 'frameborder' ) ) {
            $el->removeAttribute( 'frameborder' );
        };
    }
    $dom->encoding = 'UTF-8';
    return $dom->saveHTML();
 }

add_filter( 'the_content', 'rpcblank_remove_attribs', 15 );
add_filter( 'post_thumbnail_html', 'rpcblank_remove_attribs', 14 );


/*
---------------------------------------------------------------------------
WIDGETS
---------------------------------------------------------------------------
*/

function rpcblank_widgets_init() {
    register_sidebar( array (
        'name' => __( 'Blog Sidebar Widgets', 'rpcblank' ),
        'id' => 'blog-sidebar-widgets',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ) );

    // Remove recent comments styles
    global $wp_widget_factory;
    remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}

add_action( 'widgets_init', 'rpcblank_widgets_init' );

function rpcblank_widget_filter( $widget_area ) {
    if ( is_active_sidebar( $widget_area ) ) {
        ob_start();
        dynamic_sidebar( $widget_area );
        $widget_output = ob_get_clean();
        echo rpcblank_remove_attribs( $widget_output );
    }
}

// --- Tag cloud widget ---

function rpcblank_tag_cloud_limit($args){
    if(isset($args['taxonomy']) && $args['taxonomy'] == 'post_tag'){
        $args['number'] = 5;
    }
    return $args;
}

add_filter( 'widget_tag_cloud_args', 'rpcblank_tag_cloud_limit' );


/*
---------------------------------------------------------------------------
SITE BRANDING
---------------------------------------------------------------------------
*/

// --- Display the logo without link ---

function rpcblank_get_logo() {
    $custom_logo_id = get_theme_mod( 'custom_logo' );
    $image = wp_get_attachment_image( $custom_logo_id , 'full', '', ["class" => "site-logo"] );
    return $image;
}

// --- Site branding HTML ---

function rpcblank_site_branding() {
    $tag = 'span';
    $class = 'site-title';
    $title = esc_html( get_bloginfo( 'name' ) );
    
    $description = esc_html( bloginfo( 'description' ) );
    $site_description = '';
    $site_title = '';
    $site_logo = '';

    if ( is_front_page() ) {
        $tag = 'h1';
    }

    if ( has_custom_logo() ) {
        $site_logo = rpcblank_get_logo();
    }

    if ( get_bloginfo( 'description' ) ) {
        $site_description = '<span class="site-description">' . $description . '</span>';
    }

    if ( get_bloginfo( 'name' ) ) {
        $site_title = '<' . $tag . ' class="' . $class . '">' . $title . '</' . $tag . '>';
    }

    $site_branding = $site_logo . $site_title . $site_description;
    echo $site_branding;
}


/*
---------------------------------------------------------------------------
PAGES & POSTS
---------------------------------------------------------------------------
*/


// --- Filter body classes ---

function rpcblank_filter_body_classes( $classes, $extra_classes ) {
    $whitelist = array(
        'home',
        'page',
        'blog',
        'archive',
        'category',
        'tag',
        'author',
        'single',
        'single-format-aside',
        'single-format-audio',
        'single-format-chat',
        'single-format-gallery',
        'single-format-link',
        'single-format-image',
        'single-format-quote',
        'single-format-status',
        'single-format-video',
        'logged-in',
        'error404',
    );

    $classes = array_intersect( $classes, $whitelist );

    return array_merge( $classes, (array) $extra_classes );
}

add_filter( 'body_class', 'rpcblank_filter_body_classes', 10, 3 );

// --- Filter post classes ---

function rpcblank_filter_post_classes( $classes, $extra_classes ) {
    $whitelist = array( 
        'post',
        'hentry',
        'format-aside',
        'format-audio',
        'format-chat',
        'format-gallery',
        'format-link',
        'format-image',
        'format-quote',
        'format-status',
        'format-video'
    );

    $classes = array_intersect( $classes, $whitelist );

    return array_merge( $classes, (array) $extra_classes );
}

add_filter( 'post_class', 'rpcblank_filter_post_classes', 10, 3 );

// --- If the title is empty for the current post, display an arrow

function rpcblank_title( $title ) {
    if ( $title == '' ) {
        return '&rarr;';
    } else {
        return $title;
    }
}

add_filter( 'the_title', 'rpcblank_title' );

// --- Create HTML Excerpts ---

remove_filter( 'get_the_excerpt', 'wp_trim_excerpt' );

function rpcblank_html_excerpt( $rpcblank_excerpt ) {
    $allowed = '<a>,<abbr>,<address>,<audio>,<bdi>,<bdo>,<blockquote>,<br>,<caption>,<cite>,<code>,<col>,<colgroup>,<dd>,<del>,<details>,<dfn>,<div>,<dl>,<dt>,<em>,<embed>,<figcaption>,<figure>,<footer>,<h3>,<h4>,<h5>,<h6>,<hr>,<iframe>,<img>,<ins>,<kbd>,<li>,<mark>,<meter>,<object>,<ol>,<p>,<pre>,<progress>,<q>,<rp>,<rt>,<ruby>,<samp>,<script>,<span>,<strong>,<summary>,<table>,<tbody>,<td>,<tfoot>,<th>,<thead>,<time>,<tr>,<track>,<ul>,<var>,<video>,<wbr>';
    $raw_excerpt = $rpcblank_excerpt;
    $include_read_more = true;
    
    if ( '' == $rpcblank_excerpt ) {
        
        $rpcblank_excerpt = apply_filters( 'the_content', get_the_content( '' ) );
        $rpcblank_excerpt = str_replace( ']]>', ']]&gt;', $rpcblank_excerpt );
        $rpcblank_excerpt = strip_tags( $rpcblank_excerpt, $allowed );

        // Set the excerpt word limit and only break after a sentence is complete
        $word_count = 60;
        $excerpt_length = apply_filters( 'excerpt_length', $word_count ); 
        $tokens = array();
        $excerpt_output = '';
        $count = 0;

        // Divide the string into tokens; HTML tags, or words, followed by any whitespace
        preg_match_all( '/(<[^>]+>|[^<>\s]+)\s*/u', $rpcblank_excerpt, $tokens );
        foreach ( $tokens[0] as $token ) { 
            if ( $count >= $excerpt_length && preg_match( '/[\;\?\.\!]\s*/uS', $token ) ) { 
                // Limit reached, continue until , ; ? . or ! occur at the end
                $excerpt_output .= trim( $token );
                break;
            }
            if ( !preg_match( '/(<[^>]+>)/uS', $token  ) ) {
                // Add words to complete sentence
                $count++;
            }
            // Append what's left of the token
            $excerpt_output .= $token;
        }

        $rpcblank_excerpt = trim( force_balance_tags( $excerpt_output ) );
        if ( $count <= $word_count ) {
            $include_read_more = false;
        }
    }
    if ( $include_read_more ) {
        $read_more = ' <a class="read-more" href="'. esc_url( get_permalink() ) . '">' . sprintf(__( 'Read full text &rarr;', 'rpcblank' ), get_the_title() ) . '</a>';
        $rpcblank_excerpt .= $read_more;
    }

    return apply_filters( 'rpcblank_html_excerpt', $rpcblank_excerpt, $raw_excerpt );
}

add_filter( 'get_the_excerpt', 'rpcblank_html_excerpt' );


/*
---------------------------------------------------------------------------
COMMENTS
---------------------------------------------------------------------------
*/

function rpcblank_comments_number( $count ) {
    if ( ! is_admin() ) {
        global $id;
        $comments_by_type = &separate_comments( get_comments( 'status=approve&post_id=' . $id ) );
        return count( $comments_by_type['comment'] );
    } else {
        return $count;
    }
}

function rpcblank_pings( $comment ){
    $GLOBALS['comment'] = $comment; ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li><?php 
}

add_filter( 'get_comments_number', 'rpcblank_comments_number' );


/*
---------------------------------------------------------------------------
SEARCH
---------------------------------------------------------------------------
*/

// --- Highlight keyphrases in search results ---
function rpcblank_search_keyphrase_highlight( $data ) {
    $function = call_user_func( 'get_the_' . $data );
    $keys = implode( '|', explode( ' ', get_search_query() ) );
    $function = preg_replace('/(' . $keys .')/iu', '<mark>\0</mark>', $function);

    echo $function;
}


/*
---------------------------------------------------------------------------
CLEANUP DEFAULTS
---------------------------------------------------------------------------
*/

// --- Remove emoji support ---

function rpcblank_remove_tinymce_emoji_support( $plugins ) {
    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
        return array();
    }
}

function rpcblank_remove_wp_emoji_support() {
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

    add_filter( 'tiny_mce_plugins', 'rpcblank_remove_tinymce_emoji_support' );
    add_filter( 'emoji_svg_url', '__return_false' );

}

add_action( 'init', 'rpcblank_remove_wp_emoji_support' );


/*
---------------------------------------------------------------------------
PLUGIN CUSTOMIZATIONS
---------------------------------------------------------------------------
*/

// --- ACF Content Analysis for Yoast SEO ---

function rpcblank_analyze_acf_fields_as_headings( $headlines ) {
    // $headlines['field_000000000'] = 2;
    return $headlines;
}

add_filter( 'yoast-acf-analysis/headlines', 'rpcblank_analyze_acf_fields_as_headings' );

// --- Advanced Custom Fields ---

function rpcblank_sanitize_acf_text_field( $text ) {
    $allowed = array(
        'abbr' => array(
            'class' => array(),
            'id' => array(),
            'title' => array(),
        ),
        'br' => array(),
        'cite' => array(
            'class' => array(),
            'id' => array(),
        ),
        'del' => array(
            'class' => array(),
            'id' => array(),
        ),
        'dfn' => array(
            'class' => array(),
            'id' => array(),
        ),
        'em' => array(
            'class' => array(),
            'id' => array(),
        ),
        'ins' => array(
            'class' => array(),
            'id' => array(),
        ),
        'mark' => array(
            'class' => array(),
            'id' => array(),
        ),
        'q' => array(
            'class' => array(),
            'id' => array(),
        ),
        'span' => array(
            'class' => array(),
            'id' => array(),
        ),
        'strong' => array(
            'class' => array(),
            'id' => array(),
        ),
    );
    return wp_kses( $text, $allowed );
}

function rpcblank_acf_button( $prefix, $link_type, $button_class ) {
    if ( get_field( $prefix . 'button_enable' ) === 'disable' ) return;
    if ( get_field( $prefix . 'button_link_type' ) ) {
        $link_type = get_field( $prefix . 'button_link_type');
    }

    $button_text = rpcblank_sanitize_acf_text_field( get_field( $prefix . 'button_text' ) );
    $button_link = '';
    $tel_ext = '';

    switch ( $link_type ) {
        case 'page-post':
            $button_link = esc_url( get_field( $prefix . 'button_link_page_post' ) );
            break;
        case 'email':
            $button_link = sanitize_email( get_field( $prefix . 'button_link_email' ) );
            break;
        case 'tel':
            $button_link = sanitize_text_field( get_field( $prefix . 'button_link_tel' ) );
            $tel_ext = sanitize_text_field( get_field( $prefix . 'button_link_tel_ext' ) );
            $button_link .= ',' . $tel_ext;
            break;
        case 'url':
            $button_link = esc_url( get_field( $prefix . 'button_link_url' ) );
            break;
    }

    $button = '<a class="' . sanitize_html_class( $button_class ) . '" href="' . $button_link . '">' . $button_text . '</a>';
    return $button;
}

// --- Gravity Forms ---

// Disable IP address logging
add_filter( 'gform_ip_address', '__return_empty_string' );

// Immediately delete submissions from DB (replace number with form id)
function rpcblank_gform_remove_form_entry( $entry ) {
    GFAPI::delete_entry( $entry['id'] );
}

add_action( 'gform_after_submission_1', 'rpcblank_gform_remove_form_entry' );