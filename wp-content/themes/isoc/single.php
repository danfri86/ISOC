<?php get_header(); ?>

<div class="container mt20 mb50 page-layout nyhet" role="main">	
	  
	<div class="box-12">

		<?php // Starta loopen
    while ( have_posts() ) : the_post(); ?>

			<div class="page-header">
				<h1><?php the_title(); ?></h1>
				<h3>Skrivet av <a href=""><?php the_author(); ?></a>
				<?php the_time( get_option( 'date_format' ) ); ?>.</h3>
			</div>

			<div class="box-12 np">
				<div class="box-8 tablet-12">
		  		<p>
		  			<span class="kategori">
		  			<?php foreach((get_the_category()) as $category) {
              echo $category->category_nicename . ' ';
            } ?>
           </span>

           <?php // the_excerpt(); ?>
          </p> 
					
					<?php the_content(); ?>
				</div>

			<?php endwhile; ?>

			<div class="box-4 np">
				<?php get_sidebar(); ?>
			</div>
    </div>
  </div>

<!-- /container -->
</div>

<?php get_footer(); ?>