<?php
$args = array (
  'post_type'   => 'styrelse',
  'pagination'  => false,
  'showposts'   => -1,
);

// The Query
$styrelse = new WP_Query( $args );

// The Loop
if ( $styrelse->have_posts() ) {
	echo '<div class="box-12 np styrelse">';
  while ( $styrelse->have_posts() ) {
    $styrelse->the_post(); ?>

    <div class="box-6">
    	<?php
    	$bildID = get_post_meta(get_the_id(), 'styrelse_bild', true);
    	echo wp_get_attachment_image( $bildID['id'], 'medium');
    	?>

			<p>
				<?php
				the_title();
				echo ', '. strtolower( get_post_meta(get_the_id(), 'styrelse_roll', true) );
				?>
			</p>
		</div>
      
   <?php }
   echo '</div>';
}

// Restore original Post Data
wp_reset_postdata();
?>