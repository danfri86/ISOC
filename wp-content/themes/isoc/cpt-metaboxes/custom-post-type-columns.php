<?php
/*

Här tar vi bort och lägger till egna kolumner på översikten för alla posttyper

*/

/*********************
Medlemmar
*********************/
add_filter('manage_medlemmar_posts_columns', 'medlemmar_kolumn_head', 10);  
add_action('manage_medlemmar_posts_custom_column', 'medlemmar_kolumn_content', 10, 2);

function medlemmar_kolumn_head($defaults) {
	$defaults['medlemstyp'] = 'Medlemstyp';
	$defaults['bostadsort'] = 'Bostadsort';
	$defaults['datum'] = 'Medlem sedan';

	// Byt namn på title
	$defaults['title'] = _x('Namn', 'column name');

	unset($defaults['categories']);
	unset($defaults['author']);
	unset($defaults['tags']);
	unset($defaults['comments']);
	unset($defaults['date']);
	return $defaults;  
}  
  
function medlemmar_kolumn_content($column_name, $post_ID) { 
	$post_meta_data = get_post_custom($post_ID);
	
	if($column_name == 'medlemstyp') {  
		echo $post_meta_data['medlem_medlemstyp'][0];
    }
	
	if($column_name == 'bostadsort') {
		echo $post_meta_data['medlem_ort'][0];
	}

	if($column_name == 'datum') {
		echo get_the_date();
	}
}

// Dessa indenterade funktioner gör så att det går att sortera kolumnerna för bättre översikt
add_filter( 'manage_edit-medlemmar_sortable_columns', 'medlemmar_sortable_columns' );
function medlemmar_sortable_columns( $columns ) {
	$columns['medlemstyp'] = 'medlemstyp';
	$columns['bostadsort'] = 'bostadsort';
	$columns['datum'] = 'datum';
	return $columns;
}

// Kör bara på edit sidan i admin
add_action( 'load-edit.php', 'my_edit_medlemmar_load' );
function my_edit_medlemmar_load() {
	add_filter( 'request', 'my_sort_medlemmar' );
}

// Sortera medlemmar
function my_sort_medlemmar( $vars ) {
	/* Check if we're viewing the 'medlemmar' post type. */
	if ( isset( $vars['post_type'] ) && 'medlemmar' == $vars['post_type'] ) {
		// Kolla om ordning är satt efter bostadsort
		if ( isset( $vars['orderby'] ) && 'bostadsort' == $vars['orderby'] ) {
			// Kolla mot dom egna metafälten
			$vars = array_merge(
				$vars,
				array(
					'meta_key' => 'medlem_ort',
					'orderby' => 'meta_value'
				)
			);
		}

		// Kolla om ordning är satt efter medlemstyp
		if ( isset( $vars['orderby'] ) && 'medlemstyp' == $vars['orderby'] ) {
			// Kolla mot dom egna metafälten
			$vars = array_merge(
				$vars,
				array(
					'meta_key' => 'medlem_medlemstyp',
					'orderby' => 'meta_value'
				)
			);
		}
	}
	return $vars;
}











/*********************
Styrelse
*********************/
add_filter('manage_styrelse_posts_columns', 'styrelse_kolumn_head', 10);  
add_action('manage_styrelse_posts_custom_column', 'styrelse_kolumn_content', 10, 2);

function styrelse_kolumn_head($defaults) {
	$defaults['roll'] = 'Roll';
	$defaults['bild'] = 'Bild';

	// Byt namn på title
	$defaults['title'] = _x('Namn', 'column name');

	unset($defaults['date']);
	return $defaults;  
}  
  
function styrelse_kolumn_content($column_name, $post_ID) { 
	$post_meta_data = get_post_custom($post_ID);
	
	if($column_name == 'roll') {  
		echo $post_meta_data['styrelse_roll'][0];
    }
	
	if($column_name == 'bild') {
		$bild = get_post_meta($post_ID, 'styrelse_bild', true);
		echo wp_get_attachment_image($bild['id'], 'thumbnail');
	}
}

// Dessa indenterade funktioner gör så att det går att sortera kolumnerna för bättre översikt
add_filter( 'manage_edit-styrelse_sortable_columns', 'styrelse_sortable_columns' );
function styrelse_sortable_columns( $columns ) {
	$columns['roll'] = 'roll';

	return $columns;
}

// Kör bara på edit sidan i admin
add_action( 'load-edit.php', 'my_edit_styrelse_load' );
function my_edit_styrelse_load() {
	add_filter( 'request', 'my_sort_styrelse' );
}

// Sortera styrelse
function my_sort_styrelse( $vars ) {
	/* Check if we're viewing the 'styrelse' post type. */
	if ( isset( $vars['post_type'] ) && 'styrelse' == $vars['post_type'] ) {

		// Kolla om ordning är satt efter roll
		if ( isset( $vars['orderby'] ) && 'roll' == $vars['orderby'] ) {
			// Kolla mot dom egna metafälten
			$vars = array_merge(
				$vars,
				array(
					'meta_key' => 'styrelse_roll',
					'orderby' => 'meta_value'
				)
			);
		}
	}

	return $vars;
}

?>