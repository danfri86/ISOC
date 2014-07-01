<?php

//require_once('custom-post-types/index.php');








// Rensa upp i wp_head
function isoc_head_cleanup() {
	// Ta bort länkar i header
	remove_action( 'wp_head', 'feed_links_extra', 3 );                    // Category Feeds
	remove_action( 'wp_head', 'feed_links', 2 );                          // Post and Comment Feeds
	remove_action( 'wp_head', 'rsd_link' );                               // EditURI link
	remove_action( 'wp_head', 'wlwmanifest_link' );                       // Windows Live Writer
	remove_action( 'wp_head', 'index_rel_link' );                         // index link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );            // previous link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );             // start link
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); // Links for Adjacent Posts
	remove_action( 'wp_head', 'wp_generator' );                           // WP version
}
// Starta isoc_head_cleanup
add_action('init', 'isoc_head_cleanup');

// Ta bort WP version från RSS
function wp_bootstrap_rss_version() { return ''; }
add_filter('the_generator', 'wp_bootstrap_rss_version');






// Lägg till WP Funktioner & Theme Support
function isoc_setup() {
	add_theme_support('post-thumbnails');      // wp thumbnails. Storlekar läggs till nedan
	set_post_thumbnail_size(125, 125, true);   // default thumb size

	//add_theme_support('automatic-feed-links'); // rss thingy

	// WP menyer
	add_theme_support( 'menus' );
	register_nav_menus( array( 
			'main_nav' => 'Huvudmenyn',
			'footer_links' => 'Footer länkar'
	) );

	// HTML5 support för valda delar
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );
}

// Kör detta after_setup_theme
add_action('after_setup_theme','isoc_setup');







// Registera stilar och script
function isoc_styles_scripts() {
	wp_enqueue_script('jquery');

	wp_enqueue_style( 'isoc_style', get_bloginfo('template_directory') .'/css/style.css', false, false );

	wp_enqueue_script( 'isoc_script', get_bloginfo('template_directory') .'/javascript/index-min.js', array('jquery'), false );
}

// Hook into the 'wp_enqueue_scripts' action
add_action( 'wp_enqueue_scripts', 'isoc_styles_scripts' );








// Registrera sidebars
function isoc_sidebars() {
	register_sidebar( array(
		'name'          => 'Sidebar',
		'id'            => 'sidebar-1',
		'description'   => 'Visas på alla sidor',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'isoc_sidebars' );









// Ta bort <p> runt bilder (img) (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

add_filter('the_content', 'filter_ptags_on_images');








/* Skapa en pagination-funktion som visas såhär:
[1] 2 3 ... 5 »
« 1 [2] 3 4 5 »
« 1 [2] 3 4 5 »
« 1 ... 3 4 [5]

Anropas utanför loopen men innanför if( have_post() )
Används såhär:
<div class="pagination"><?php pagination('»', '«'); ?></div>

Granska sidkoden för att sätta style med css
*/
function pagination($next = '«', $prev = '»') {
    global $wp_query, $wp_rewrite;
    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
    $pagination = array(
        'base' => @add_query_arg('paged','%#%'),
        'format' => '',
        'total' => $wp_query->max_num_pages,
        'current' => $current,
        'prev_text' => __($prev),
        'next_text' => __($next),
        'type' => 'plain'
);
    if( $wp_rewrite->using_permalinks() )
        $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );

    if( !empty($wp_query->query_vars['s']) )
        $pagination['add_args'] = array( 's' => get_query_var( 's' ) );

    echo paginate_links( $pagination );
};









// Låter dig bestämma längden på the_excerpt
// Använd: echo excerpt(20);
function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }	
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
}
 
function content($limit) {
  $content = explode(' ', get_the_content(), $limit);
  if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'...';
  } else {
    $content = implode(" ",$content);
  }	
  $content = preg_replace('/\[.+\]/','', $content);
  $content = apply_filters('the_content', $content); 
  $content = str_replace(']]>', ']]&gt;', $content);
  return $content;
}

?>