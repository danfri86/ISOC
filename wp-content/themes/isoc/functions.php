<?php

require_once('theme-options/index.php');
require_once('cpt-metaboxes/index.php');
require_once('incl/widgets.php');






// Ställ in saker med epost som skickas av Wordpress
add_filter( 'wp_mail_content_type','isoc_mail_content_type' );
add_filter( 'wp_mail_from', 'isoc_mail_from' );
add_filter( 'wp_mail_from_name', 'isoc_mail_from_name' );

function isoc_mail_content_type() {
    return "text/html";
}

function isoc_mail_from( $original_email_address ) {
  //Make sure the email is from the same domain 
  //as your website to avoid being marked as spam.
  $adminMail = get_option( 'admin_email' );
  return $adminMail;
}

function isoc_mail_from_name( $original_email_from ) {
  return 'ISOC-SE';
}






// get the the role object
$role_object = get_role( 'editor' );

// add $cap capability to this role object
$role_object->add_cap( 'edit_theme_options' );








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


  wp_enqueue_style( 'isoc_animate', get_bloginfo('template_directory') .'/libs/animate.css/animate.min.css', false, false );
  wp_enqueue_style( 'isoc_fontIcons', get_bloginfo('template_directory') .'/libs/font-awesome/css/font-awesome.min.css', false, false );
  wp_enqueue_style( 'isoc_normalize', get_bloginfo('template_directory') .'/libs/normalize-css/normalize.css', false, false );
  wp_enqueue_style( 'isoc_style', get_bloginfo('template_directory') .'/css/box.min.css', false, false );

	wp_enqueue_script( 'modernizr', get_bloginfo('template_directory') .'/libs/modernizr/modernizr.js', array('jquery'), false );

  wp_enqueue_script( 'isoc_script', get_bloginfo('template_directory') .'/js/functions.min.js', array('jquery'), false );
}

// Hook into the 'wp_enqueue_scripts' action
add_action( 'wp_enqueue_scripts', 'isoc_styles_scripts' );







// "Logga in"-sidan CSS
function isoc_login_css() { ?>
    <link rel="stylesheet" href="<?php echo get_bloginfo( 'stylesheet_directory' ) . '/css/login.css'; ?>" type="text/css" media="all" />
<?php } ?>
<?php
add_action( 'login_enqueue_scripts', 'isoc_login_css' );





// Ändra länkar på "Logga in"-sidan
function isoc_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'isoc_login_logo_url' );

function isoc_login_logo_url_title() {
    return get_bloginfo('title');
}
add_filter( 'login_headertitle', 'isoc_login_logo_url_title' );








// Registrera sidebars
function isoc_sidebars() {
	register_sidebar( array(
		'name'          => 'Sidebar',
		'id'            => 'sidebar-1',
		'description'   => 'Visas på alla sidor',
		'before_widget' => '<div id="%1$s" class="box-10 sidenote tablet-12 widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'isoc_sidebars' );








// Lägg till en sökikon sist i menyn
//add_filter( 'wp_nav_menu_items', 'isoc_nav_items', 10, 2 );

function isoc_nav_items($items, $args) {
  // Lägg till i header menyn
  if ($args->theme_location == 'main_nav') { 
    $items .= '
    <li class="search-toggle">
      <i class="fa fa-search"></i>
    </li>
    ';
  }

  return $items;
}





// Ändra antal ord på excerpt
function isoc_excerpt_length( $length ) {
      return 15;
}
add_filter( 'excerpt_length', 'isoc_excerpt_length', 999 );

// Ändra avslutet på excerpt
function isoc_excerpt_more($more) {
  return '...';
}

add_filter('excerpt_more', 'isoc_excerpt_more');







// Ta bort meta-boxar från "Skapa ny" sidorna". Dessa används inte i temat
function isoc_remove_meta_boxes() {
  remove_meta_box( 'commentstatusdiv' , 'post' , 'normal' );
  remove_meta_box( 'commentsdiv' , 'post' , 'normal' );
  remove_meta_box( 'authordiv' , 'post' , 'normal' );
  remove_meta_box( 'tagsdiv-post_tag', 'post', 'side');
  remove_meta_box( 'revisionsdiv', 'post', 'normal');
  remove_meta_box( 'trackbacksdiv', 'post', 'normal');
  remove_meta_box( 'slugdiv', 'post', 'normal');
  remove_meta_box( 'postcustom', 'post', 'normal');

  remove_meta_box( 'commentstatusdiv' , 'page' , 'normal' );
  remove_meta_box( 'authordiv' , 'page' , 'normal' );
  remove_meta_box( 'slugdiv', 'page', 'normal');
  remove_meta_box( 'postcustom', 'page', 'normal');
}

add_action( 'admin_menu' , 'isoc_remove_meta_boxes' );







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
// function pagination($next = '«', $prev = '»') {
//     global $nyhetsArkiv, $wp_rewrite;
//     $nyhetsArkiv->query_vars['paged'] > 1 ? $current = $nyhetsArkiv->query_vars['paged'] : $current = 1;
//     $pagination = array(
//         'base' => @add_query_arg('paged','%#%'),
//         'format' => '',
//         'total' => $nyhetsArkiv->max_num_pages,
//         'current' => $current,
//         'prev_text' => __($prev),
//         'next_text' => __($next),
//         'type' => 'plain'
// );
//     if( $wp_rewrite->using_permalinks() )
//         $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );

//     if( !empty($nyhetsArkiv->query_vars['s']) )
//         $pagination['add_args'] = array( 's' => get_query_var( 's' ) );

//     echo paginate_links( $pagination );
// };

function pagination() {
  global $wp_query, $wp_rewrite;
  $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
  $pagination = array(
      'base' => @add_query_arg('paged','%#%'),
      'format' => '',
      'total' => $wp_query->max_num_pages,
      'current' => $current,
      'prev_text' => '»',
      'next_text' => '«',
      'type' => 'plain'
  );

  if( $wp_rewrite->using_permalinks() )
      $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );

  if( !empty($wp_query->query_vars['s']) )
      $pagination['add_args'] = array( 's' => get_query_var( 's' ) );

  echo paginate_links( $pagination );
};

function paginationNyheter() {
  global $nyheter, $wp_rewrite;
  $nyheter->query_vars['paged'] > 1 ? $current = $nyheter->query_vars['paged'] : $current = 1;
  $pagination = array(
      'base' => @add_query_arg('paged','%#%'),
      'format' => '',
      'total' => $nyheter->max_num_pages,
      'current' => $current,
      'prev_text' => '«',
      'next_text' => '»',
      'type' => 'plain'
  );

  if( $wp_rewrite->using_permalinks() )
      $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );

  if( !empty($nyheter->query_vars['s']) )
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









//Shortcode för att visa "Bli medlem"-formuläret
function isoc_bli_medlem_form( $atts, $content = null ) {
  ob_start();
    // Vad ska shortcoden innehålla. Innehåll här
    include(TEMPLATEPATH . '/incl/bli-medlem-form.php');

    // Sätt innehållet till en variabel
    $formular = ob_get_contents();
  ob_end_clean();

  // Returnera innehållet
  return $formular;
}
add_shortcode( 'bli_medlem_formular', 'isoc_bli_medlem_form' );








//Shortcode för att lista styrelsen
function isoc_styrelse( $atts, $content = null ) {
  ob_start();
    // Vad ska shortcoden innehålla. Innehåll här
    include(TEMPLATEPATH . '/incl/styrelse.php');

    // Sätt innehållet till en variabel
    $content = ob_get_contents();
  ob_end_clean();

  // Returnera innehållet
  return $content;
}
add_shortcode( 'styrelse', 'isoc_styrelse' );








// Lägg till fler fält på användarprofilen
// Används som fält när medlemmar registrerar sig
function isoc_user_meta($profile_fields) {

  // Lägg till nya fält
  $profile_fields['medlemstyp'] = 'Medlemstyp';
  $profile_fields['adress'] = 'Adress';
  $profile_fields['postnummer'] = 'Postnummer';
  $profile_fields['ort'] = 'Ort';

  $profile_fields['foretag-namn'] = 'Företag namn';   
  $profile_fields['foretag-adress'] = 'Företag adress';
  $profile_fields['foretag-postnummer'] = 'Företag postnummer';
  $profile_fields['foretag-ort'] = 'Företag ort';

  // Ta bort onödiga fält
  unset($profile_fields['url']);
  unset($profile_fields['aim']);
  unset($profile_fields['yim']);
  unset($profile_fields['jabber']);

  return $profile_fields;
}
add_filter('user_contactmethods', 'isoc_user_meta');

?>