<?php get_header(); ?>

<div class="puffar-start">
  <article>
    <div>
      <a href="#">
        <div class="bild"></div>
        <h3>Rubrik</h3>
        <p>Här kommer lite text</p>
      </a>
    </div>
  </article>

  <article>
    <div>
      <a href="#">
        <div class="bild"></div>
        <h3>Rubrik</h3>
        <p>Här kommer lite text</p>
      </a>
    </div>
  </article>

  <article>
    <div>
      <a href="#">
        <div class="bild"></div>
        <h3>Rubrik</h3>
        <p>Här kommer lite text</p>
      </a>
    </div>
  </article>

  <article>
    <div>
      <a href="#">
        <div class="bild"></div>
        <h3>Rubrik</h3>
        <p>Här kommer lite text</p>
      </a>
    </div>
  </article>
</div>

<div class="row">
  <div class="valkommen">
    <div>
      <p>
      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut leo nisl, hendrerit vel egestas in, aliquet eu turpis. Nulla sed porttitor sem, nec lacinia odio. Ut vitae justo faucibus, mattis dui id, eleifend nulla. Quisque ac massa vitae est iaculis auctor. Sed rhoncus, sapien porta eleifend ullamcorper, sem diam rhoncus ante, sit amet cursus ipsum urna vel sem. Donec facilisis diam eget magna blandit, in euismod nunc feugiat. In rutrum, mauris et condimentum venenatis, justo ligula venenatis lorem, ac sagittis augue ligula sed tortor.
      </p>
    </div>
  </div>

  <div class="snabblankar-start">
    <div>
      <ul>
        <li><a href="#">Katalog bestellen</a></li>
        <li><a href="#">Anfragen senden</a></li>
        <li><a href="#">Länk</a></li>
        <li><a href="#">Länk</a></li>
        <li><a href="#">Länk</a></li>
        <li><a href="#">Länk</a></li>
      </ul>
    </div>
  </div>
</div>

<div class="nyheter-front">
  <h5>Neuigkeiten</h5>

  <div>
    <?php
    // WP_Query arguments
    $args = array (
      'post_type'   => 'post',
      'pagination'  => false,
      'showposts'   => 4,
    );

    // The Query
    $neuigketen = new WP_Query( $args );

    // The Loop
    if ( $neuigketen->have_posts() ) {
      while ( $neuigketen->have_posts() ) {
        $neuigketen->the_post(); ?>
          
          <article>
            <a href="<?php the_permalink(); ?>">
              <h4>
                <?php
                // Begränsa längden på rubriken till att sträcka sig det som motsvarar max 2 rader
                if( strlen(get_the_title()) > 40)
                  echo substr(get_the_title(), 0, 40) .'...';
                else
                  echo get_the_title();
                ?>
              </h4>

              <p class="small"><?php the_time( get_option( 'date_format' ) ); ?></p>
            </a>
          </article>

      <?php }
    } else {
      // no posts found
    }

    // Restore original Post Data
    wp_reset_postdata();
    ?>
  </div>

  <a class="btn btn-primary" href="<?php bloginfo('url'); ?>/neuigkeiten">Weitere Neuigkeiten</a>
</div>

<?php // get_sidebar('products'); ?>
<?php // get_sidebar('affiliated'); ?>

<?php get_footer(); ?>
