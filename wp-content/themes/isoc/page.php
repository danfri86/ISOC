<?php
//Fallback validering om jQuery inte fungerar
$formError = '';
$formSuccess = '';

$return = '';

if( isset( $_POST['bli-medlem-submit'] ) && isset( $_POST['post_nonce_field'] ) && wp_verify_nonce( $_POST['post_nonce_field'], 'post_nonce' ) ) {
	if( empty( $_POST['fornamn'] ) ) $formError .= 'Fyll i ditt förnamn';
	if( empty( $_POST['efternamn'] ) ) $formError .= '</br>Fyll i ditt efternamn';
	if( empty( $_POST['adress'] ) ) $formError .= '</br>Fyll i din adress';
	if( empty( $_POST['postnummer'] ) ) $formError .= '</br>Fyll i ditt postnummer';
	if( empty( $_POST['ort'] ) ) $formError .= '</br>Fyll i din bostadsort';
	if( empty( $_POST['email'] ) ) $formError .= '</br>Fyll i din epostadress';
	if( empty( $_POST['medlemstyp'] ) ) $formError .= '</br>Välj medlemstyp';

	if( !empty( $_POST['fornamn']) && !empty( $_POST['efternamn']) && !empty( $_POST['adress']) && !empty( $_POST['postnummer']) && !empty( $_POST['ort']) && !empty( $_POST['email']) && !empty( $_POST['medlemstyp']) ){
		$formSuccess = 'Anmälan är gjord';

		// Skapa användare vid klientregistrering
		require_once('incl/skapa-medlem.php');

		// Anropa funktionen i filen ovan
		// $return måste användas för att felmeddelande ska kunna visas
		$return = skapaMedlem();
	}
}
?>

<?php get_header(); ?>

<div class="container mt20 mb50 page-layout nyhet" role="main">	

	<div class="box-12">

		<?php // Starta loopen
    while ( have_posts() ) : the_post(); ?>

			<div class="page-header">
				<h1><?php the_title(); ?></h1>
			</div>

			<div class="box-12 np">
				<div class="box-8 tablet-12">
					<?php
					if( !empty($formError) ) {
						echo $formError;
					}

					if( !empty($formSuccess) ) {
						echo $formSuccess;
					}
					?>

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