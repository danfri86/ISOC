<?php
/*
Template Name: Nyheter
*/
?>

<?php get_header(); ?>

<div class="container mt20 mb50 page-layout posts" role="main">	
	  
	<div class="box-12">

		<div class="page-header">
			<h1>Arkiv</h1>
		</div>

		<div class="box-12 np">
  		<div class="box-8 tablet-12">

				<?php
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		    // WP_Query arguments
		    $args = array (
		      'post_type'   => 'post',
		      'paged' => $paged
		    );

		    // The Query
		    $nyhetsArkiv = new WP_Query( $args );

		    // The Loop
		    if ( $nyhetsArkiv->have_posts() ) {
	    		echo '<ul>';
		      while ( $nyhetsArkiv->have_posts() ) {
		        $nyhetsArkiv->the_post(); ?>

		        <li class="box-12">

							<?php
	            // Om det finns en utvald bild
	            if ( has_post_thumbnail() ) {
	              echo '<div class="box-3 nyhet-thumb">';
	                the_post_thumbnail('thumbnail');
	              echo '</div>';

	              // Början på titel+text
	              echo '<div class="box-9">';
	            } else {
	              // Om det inte finns en utvald bild så hämtas artikelns första bild
	              $args = array(
	                 'post_type' => 'attachment',
	                 'post_mime_type' => array('image/jpg', 'image/jpeg', 'image/png', 'image/gif'),
	                 'numberposts' => 1,
	                 'post_status' => null,
	                 'post_parent' => $post->ID
	              );

	              $attachments = get_posts( $args );
	              // Om det finns en attachment och det är en bild
	              // Fix för om inlägget har bilagor
	              if ( $attachments ) {
	                echo '<div class="box-3">';
	                  foreach ( $attachments as $attachment ) {
	                    echo wp_get_attachment_image( $attachment->ID, 'thumbnail', false );
	                  }
	                echo '</div>';

	                // Början på titel+text
	              echo '<div class="box-9">';
	              } else {
	                echo '<div class="box-12">';
	              }
	            }
	            ?>
	            
	              <a href="<?php the_permalink(); ?>">
	                <h3><?php the_title(); ?></h3>
	                <p>
	                  <span class="kategori">
	                    <?php foreach((get_the_category()) as $category) {
	                      echo $category->category_nicename . ' ';
	                    } ?>
	                  </span>
	                  <?php echo get_the_excerpt(); ?>
	                </p>
	              </a>
	            </div>

						</li>
					<?php } 
				} else {
	      // no posts found
	    	}

	    	echo '</ul>';

	    	// Restore original Post Data
	    	wp_reset_postdata();
	    	?>

	    	<div class="pagination">
	    		<?php pagination('»', '«'); ?>
	    	</div>

			</div>

			<div class="box-4 np">
				<?php get_sidebar(); ?>
			</div>

		</div>
	</div>
<!-- /container -->
</div>

<?php get_footer(); ?>