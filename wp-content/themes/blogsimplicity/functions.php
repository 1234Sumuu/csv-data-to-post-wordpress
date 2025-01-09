<?php
/**
 * BlogSimplicity functions and definitions
 */

if (!function_exists('blogsimplicity_setup')) :
    function blogsimplicity_setup()
    {
        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        // Let WordPress manage the document title.
        add_theme_support('title-tag');

        // Enable support for Post Thumbnails on posts and pages.
        add_theme_support('post-thumbnails');

        // Enable support for custom logo.
        add_theme_support('custom-logo', array(
            'height' => 100,
            'width' => 400,
            'flex-height' => true,
            'flex-width' => true,
        ));

        // Enable support for custom header.
        add_theme_support('custom-header', apply_filters('blogsimplicity_custom_header_args', array(
            'width'       => 1000,
            'height'      => 250,
            'flex-height' => true,
            'flex-width'  => true,
            'header-text' => false,
        )));

        // Enable support for custom background.
        add_theme_support('custom-background', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        ));

        // Enable support for wide alignments.
        add_theme_support('align-wide');

        // Enable support for editor styles.
        add_editor_style();

        // Enable support for block styles.
        add_theme_support('wp-block-styles');

        // Enable support for responsive embeds.
        add_theme_support('responsive-embeds');

        // Enable support for HTML5 markup.
        add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));

        // Register navigation menu.
        register_nav_menus(array(
            'primary' => __('Primary', 'blogsimplicity'),
        ));
    }
endif;
add_action('after_setup_theme', 'blogsimplicity_setup');

// Enqueue scripts and styles.
function blogsimplicity_scripts()
{
    wp_enqueue_style('blogsimplicity-style', get_stylesheet_uri());
    wp_enqueue_script('jquery');
    wp_enqueue_script( 'blogsimplicity-navigation', get_template_directory_uri() . '/js/navigation.js', array(), wp_get_theme()->get( 'Version' ) );
	wp_script_add_data( 'blogsimplicity-navigation', 'strategy', 'defer' );


    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'blogsimplicity_scripts');

// Register widget area.
function blogsimplicity_widgets_init()
{
    register_sidebar(array(
        'name' => __('Sidebar', 'blogsimplicity'),
        'id' => 'sidebar-1',
        'description' => __('Add widgets here to appear in your sidebar.', 'blogsimplicity'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}
add_action('widgets_init', 'blogsimplicity_widgets_init');

if ( ! function_exists( 'blogsimplicity_entry_footer' ) ) :
    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function blogsimplicity_entry_footer() {
        // Hide category and tag text for pages.
        if ( 'post' === get_post_type() ) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list( esc_html__( ', ', 'blogsimplicity' ) );
            if ( $categories_list ) {
                printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'blogsimplicity' ) . '</span>', $categories_list ); // WPCS: XSS OK.
            }
    
            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list( '', esc_html__( ', ', 'blogsimplicity' ) );
            if ( $tags_list ) {
                printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'blogsimplicity' ) . '</span>', $tags_list ); // WPCS: XSS OK.
            }
        }
    
        if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
            echo '<span class="comments-link">';
            comments_popup_link(
                sprintf(
                    wp_kses(
                        /* translators: %s: post title */
                        __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'blogsimplicity' ),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                )
            );
            echo '</span>';
        }
    
        edit_post_link(
            sprintf(
                wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                    __( 'Edit <span class="screen-reader-text">%s</span>', 'blogsimplicity' ),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                get_the_title()
            ),
            '<span class="edit-link">',
            '</span>'
        );
    }
    endif;
    

