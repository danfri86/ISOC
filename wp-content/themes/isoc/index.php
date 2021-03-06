<?php get_header();

$options = get_option('isoc_options');
?>
  
<div class="hero">
  <div class="container">

    <div class="hero-headline tablet-12">
      <h1><?php echo $options['banner_rubrik']; ?></h1>
      <?php echo apply_filters('the_content', $options['banner_text']); ?>

      <p><a class="btn blue" href="<?php bloginfo('url'); ?>/bli-medlem">Bli medlem</a> eller <a href="<?php bloginfo('url'); ?>/om" class="btn border">läs mer om ISOC-SE</a></p>
    </div>

    <div class="tablet-12">
      <img src="<?php bloginfo('template_directory'); ?>/static/hero-bg.png" alt="">
    </div>
  </div>

</div>

<div class="container mt50 mb100 index" role="main">
  <div class="box-9 puff mt20 nyheter tablet-12">
    <h3 class="uppercase">Nyheter</h3>

    <?php
    // WP_Query arguments
    $args = array (
      'post_type'   => 'post',
      'pagination'  => false,
      'showposts'   => 2,
    );

    // The Query
    $nyheter = new WP_Query( $args );

    // The Loop
    if ( $nyheter->have_posts() ) {
      while ( $nyheter->have_posts() ) {
        $nyheter->the_post(); ?>

          <div class="nyhet">

            <?php
            // Om det finns en utvald bild
            if ( has_post_thumbnail() ) {
              echo '<div class="box-3">';
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
              if ( $attachments ) {
                echo '<div class="box-3">';
                  foreach ( $attachments as $attachment ) {
                    echo wp_get_attachment_image( $attachment->ID, 'thumbnail', false );
                  }
                echo '</div>';

                // Början på titel+text
              echo '<div class="box-9">';
              } else {
                echo '<div class="box-3">';
                  echo '<img src="'. get_bloginfo('template_directory') .'/static/logo-planet.png" width="140" height="140" alt="ISOC" />';
                echo '</div>';
                
                echo '<div class="box-9">';
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

          </div>
        <?php }
    } else { ?>
      <div class="nyhet">
        <p>Inga nyheter är postade än</p>
      </div>
    <?php }

    // Restore original Post Data
    wp_reset_postdata();
    ?>

    <a href="<?php bloginfo('url'); ?>/nyheter" class="btn blue">Fler nyheter</a>

  </div>

  <div class="box-3 puff mt20 arkiv tablet-12">
    <h3 class="uppercase">arkivet</h3>

    <?php
    $args = array(
      'type'            => 'monthly',
      'limit'           => '11',
      'format'          => 'html', 
      'before'          => '',
      'after'           => '',
      'show_post_count' => false,
      'echo'            => 1,
      'order'           => 'DESC'
    );

    echo '<ul>';
      wp_get_archives( $args );
      echo '<li><a href="'. get_bloginfo('url') .'/nyheter" class="btn blue">Äldre inlägg</a></li>';
    echo '</ul>';
    ?>
  </div>

  <div class="box-12 puff mt50 om-isoc">
    <div class="box-6 network-img">
        <img class="network" src="<?php bloginfo('template_directory'); ?>/static/infra.png" alt="">
    </div>

    <div class="box-6">
      <h3>Vad är ISOC-SE?</h3>

      <?php echo apply_filters('the_content', $options['framsida_info']); ?>
      <a href="<?php bloginfo('url'); ?>/om-isoc-se/" class="btn blue">Läs mer</a>
    </div>
  </div>

  <div class="box-6 puff mt50 meta">
    <h3 class="uppercase">Nästkommande event</h3>
    
    <div class="box-12 np">
      <p>Inga event är planerade för tillfället</p>
    </div>
    <?php /*
    <div class="box-6 np">
      <h4><a href="!#">APrIGF 2014</a></h4>
      <small>3 Aug to 6 Aug, 2014</small>
      <p>Delhi, India</p>
    </div>
   
    <div class="box-6 np">
      <h4><a href="!#">APrIGF 2014</a></h4>
      <small>3 Aug to 6 Aug, 2014</small>
      <p>Delhi, India</p>
    </div>
    */ ?>
  </div>

  <div class="box-6 puff mt50 meta">
    <h3 class="uppercase">Bli medlem</h3>
    <?php echo apply_filters('the_content', $options['banner_text']); ?>
    <p>Läs mer om <a href="<?php bloginfo('url'); ?>/om">Internet Society</a>.</p>
  </div>

</div>

<?php // get_sidebar('products'); ?>

<?php get_footer(); ?>
