<?php
/**
 * Sidebar för produktsidor
 */
?>
<aside class="main-sidebar" role="complementary">

	<?php if ( is_active_sidebar( 'sidebar-1' ) ){
		dynamic_sidebar( 'sidebar-1' );
	} else {
		echo '<p>Inga widgets här än';
	} ?>

</aside><!-- #secondary -->
