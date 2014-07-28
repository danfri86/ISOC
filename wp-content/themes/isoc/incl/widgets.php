<?php 
class bilagor_widget extends WP_Widget
{
  function bilagor_widget()
  {
    $widget_ops = array('classname' => 'bilagor_widget', 'description' => 'Visar dom bilagor som tillhör ett inlägg');
    $this->WP_Widget('bilagor_widget', 'Bilagor för inlägg', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args((array) $instance, array( 'title' => '' ));
    $title = $instance['title'];
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
    
    global $post;

    if( is_single($post->ID) ) {
      // WP_Query arguments
      $args = array (
        'p'   => $post->ID,
      );
    }

    if( is_page($post->ID) ) {
      // WP_Query arguments
      $args = array (
        'page_id' => $post->ID
      );
    }

    // The Query
    $inlaggSida = new WP_Query( $args );

    // The Loop
    if ( $inlaggSida->have_posts() ) {
      while ( $inlaggSida->have_posts() ) {
        $inlaggSida->the_post();

          $bilagor = get_post_meta($post->ID,'bilaga_re_',true);
          if( $bilagor ) {
            echo $before_widget;
            $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
         
            if (!empty($title))
              echo $before_title . $title . $after_title;

            foreach ($bilagor as $bilaga){
                //print_r($bilaga['bilaga_fil']);
                
                echo '<a href="'. $bilaga['bilaga_fil']['url'] .'" target="_blank" class="btn blue bilaga"><i class="fa fa-paperclip"></i>';
                  echo get_the_title( $bilaga['bilaga_fil']['id'] );

                  // Hämta filändendelsen. Hela url'en som parameter. ['ext'] hämtar bara filändelsen
                  $filtyp = wp_check_filetype( $bilaga['bilaga_fil']['url'] );
                  echo '.'. $filtyp['ext'];

                  echo ' <small>'. floor( filesize( get_attached_file($bilaga['bilaga_fil']['id']) )/1000 ) .'kb</small>';
                echo '</a>';
            }
            echo $after_widget;
          }            
        }
    } else {
      // no posts found
    }

    // Restore original Post Data
    wp_reset_postdata();
 
    
  }
}
add_action( 'widgets_init', create_function('', 'return register_widget("bilagor_widget");') );
 
?>