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
					<div class="box-10 sidenote tablet-12">
						<h4>Dela</h4>
						<p>Dela den här härliga artikeln på sociala medier är du gullig.</p>
					</div>

					<!-- om bilaga finns -->
					<div class="box-10 sidenote tablet-12">
						<h4>Bilaga</h4>
						<a href="!#" class="btn blue bilaga"><i class="fa fa-paperclip"></i> Filnamn.pdf <small>37kb</small></a>
					</div>
				</div>
    </div>
  </div>

<!-- /container -->
</div>

<?php get_footer(); ?>