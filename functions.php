<?php
function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {

	// Get the theme data
	$the_theme = wp_get_theme();

    wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.min.css', array(), $the_theme->get( 'Version' ) );
    wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), $the_theme->get( 'Version' ), true );
}



function first_paragraph($content){
    return preg_replace('/<p([^>]+)?>/', '<p$1 class="intro-content">', $content, 1);
}
add_filter('the_content', 'first_paragraph');

/******************************************************************************************************
 * Filter the except length to 200 characters.
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
******************************************************************************************************/
function wpdocs_custom_excerpt_length( $length ) {
    return 100;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );



/*********
* Adding extra widgets on top of the understrap defaults
************/
if ( ! function_exists( 'draft_widgets_init' ) ) {
    /**
     * Initializes themes widgets.
     */
    function draft_widgets_init() {
        register_sidebar( array(
            'name'          => __( 'Navbar right', 'understrap' ),
            'id'            => 'navbar-right',
            'description'   => 'Widget area in the top right navbar corner',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ) );

    }
} // endif function_exists( 'understrap_widgets_init' ).
add_action( 'widgets_init', 'draft_widgets_init' );

