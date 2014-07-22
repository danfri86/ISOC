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
 
    echo $before_widget;
    $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
 
    if (!empty($title))
      echo $before_title . $title . $after_title;;
    
    global $post;

    // WP_Query arguments
    $args = array (
      'p'   => $post->ID
    );

    // The Query
    $bilagor = new WP_Query( $args );

    // The Loop
    if ( $bilagor->have_posts() ) {
      while ( $bilagor->have_posts() ) {
        $bilagor->the_post();

          $allaBilagor = get_post_meta($post->ID,'bilaga_re_',true);
          foreach ($allaBilagor as $bilaga){
              //print_r($bilaga['bilaga_fil']);
              echo '<p>';
                echo $bilaga['bilaga_fil']['url'];
              echo '</p>';
              
              echo '<p>';
                $filData = get_attached_file( $bilaga['bilaga_fil']['id'] );
                print_r($filData['file']);
                echo $filData['image_meta'];
              echo '</p>';
          }

          // $bilaga = get_post_meta($post->ID,'image_field_id',true);
          // echo '<img src="'.$bilaga['url'].'">';
            
        }
    } else {
      // no posts found
    }

    // Restore original Post Data
    wp_reset_postdata();
 
    echo $after_widget;
  }
}
add_action( 'widgets_init', create_function('', 'return register_widget("bilagor_widget");') );
 
?>