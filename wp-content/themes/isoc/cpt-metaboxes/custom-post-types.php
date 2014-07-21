<?php
// Register Custom Post Type
function isoc_cpt() {

	$labels = array(
		'name'                => 'Medlemmar',
		'singular_name'       => 'Medlem',
		'menu_name'           => 'Medlemmar',
		'parent_item_colon'   => 'Föregående medlem:',
		'all_items'           => 'Alla medlemmar',
		'view_item'           => 'Visa medlem',
		'add_new_item'        => 'Lägg till ny medlem',
		'add_new'             => 'Lägg till ny',
		'edit_item'           => 'Redigera medlem',
		'update_item'         => 'Uppdatera medlem',
		'search_items'        => 'Sök medlemmar',
		'not_found'           => 'Ej hittad',
		'not_found_in_trash'  => 'Inget hittat i papperskorgen',
	);
	$args = array(
		'label'               => 'medlemmar',
		'description'         => 'Medlemmar i ISOC-SE',
		'labels'              => $labels,
		'supports'            => array( 'title' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => false,
		'show_in_admin_bar'   => false,
		'menu_position'       => 25,
		'menu_icon'           => 'dashicons-groups',
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => false,
		'capability_type'     => 'page',
	);
	register_post_type( 'medlemmar', $args );







	$labels = array(
		'name'                => 'Styrelse',
		'singular_name'       => 'Medlem',
		'menu_name'           => 'Styrelse',
		'parent_item_colon'   => 'Föregående medlem:',
		'all_items'           => 'Alla medlemmar',
		'view_item'           => 'Visa medlem',
		'add_new_item'        => 'Lägg till ny medlem',
		'add_new'             => 'Lägg till ny',
		'edit_item'           => 'Redigera medlem',
		'update_item'         => 'Uppdatera medlem',
		'search_items'        => 'Sök medlem',
		'not_found'           => 'Ej hittad',
		'not_found_in_trash'  => 'Inget hittat i papperskorgen',
	);
	$args = array(
		'label'               => 'styrelse',
		'description'         => 'Styrelse i ISOC-SE',
		'labels'              => $labels,
		'supports'            => array( 'title' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => false,
		'show_in_admin_bar'   => false,
		'menu_position'       => 25,
		'menu_icon'           => 'dashicons-businessman',
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'styrelse', $args );


	// Visa ett meddelande i toppen på styrelse-sidan i admin
	add_action('admin_notices', 'styrelse_sort_instructions');

	function styrelse_sort_instructions() {
		// Visa bara info på översiktssidan och om man är i posttypen styrelse
		if( strstr($_SERVER['REQUEST_URI'], 'wp-admin/edit.php') && get_post_type() == 'styrelse'){
			echo '<div class="postbox" style="margin:40px 20px 0 0; padding: 0 20px;">';
				echo '<p>Du kan sortera i vilken ordning medlemmarna ska visas på webbsidan.</p>';
				echo '<p>Sortera genom att dra och släppa nedan.</p>';
			echo '</div>';
		}
	}

}

// Hook into the 'init' action
add_action( 'init', 'isoc_cpt', 0 );