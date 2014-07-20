<?php
//Fallback validering om jQuery inte fungerar
$formStatus = '';

$return = '';

if( isset( $_POST['bli-medlem-submit'] ) && isset( $_POST['post_nonce_field'] ) && wp_verify_nonce( $_POST['post_nonce_field'], 'post_nonce' ) ) {
	if( empty( $_POST['fornamn'] ) ) $formStatus .= 'Fyll i ditt förnamn';
	if( empty( $_POST['efternamn'] ) ) $formStatus .= '</br>Fyll i ditt efternamn';
	if( empty( $_POST['adress'] ) ) $formStatus .= '</br>Fyll i din adress';
	if( empty( $_POST['postnummer'] ) ) $formStatus .= '</br>Fyll i ditt postnummer';
	if( empty( $_POST['ort'] ) ) $formStatus .= '</br>Fyll i din bostadsort';
	if( empty( $_POST['email'] ) ) $formStatus .= '</br>Fyll i din epostadress';
	if( empty( $_POST['medlemstyp'] ) ) $formStatus .= '</br>Välj medlemstyp';

	if( !empty( $_POST['fornamn']) && !empty( $_POST['efternamn']) && !empty( $_POST['adress']) && !empty( $_POST['postnummer']) && !empty( $_POST['ort']) && !empty( $_POST['email']) && !empty( $_POST['medlemstyp']) ){
		$formStatus = 'Anmälan är gjord';

		// Skapa användare vid klientregistrering
		require_once('incl/skapa-anvandare.php');

		// Anropa funktionen i filen ovan
		// $return måste användas för att felmeddelande ska kunna visas
		$return = skapaAnvandare();
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
					<?php if( !empty($formStatus) ) {
						echo $formStatus;
					}
					?>

					<?php the_content(); ?>
				</div>

				<div class="box-3 sidenote tablet-12">
					<h4>Dela</h4>
					<p>Dela den här härliga artikeln på sociala medier är du gullig.</p>
				</div>

			<?php endwhile; ?>

			<!-- om bilaga finns -->
			<div class="box-3 sidenote tablet-12">
				<h4>Bilaga</h4>
				<a href="!#" class="btn blue bilaga"><i class="fa fa-paperclip"></i> Filnamn.pdf <small>37kb</small></a>
			</div>
    </div>
  </div>

<!-- /container -->
</div>

<?php get_footer(); ?>