<?php
/**
 * Sidebar för produktsidor
 */
?>
<aside class="main-sidebar" role="complementary">

	<?php if ( is_active_sidebar( 'sidebar-1' ) ){
		dynamic_sidebar( 'sidebar-1' );
	} else {
		echo '<div class="box-10 sidenote tablet-12">';
			echo '<p>Inga widgets här än';
		echo '</div>';
	} ?>

</aside><!-- #secondary -->
