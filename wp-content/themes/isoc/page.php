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
					<div class="box-10 sidenote tablet-12">
						<h4>ISOC-SE</h4>
						<p>ISOC-SE arbetar för att internet ska fortsätta utvecklas som en plattform för ekonomisk och social utveckling för människor på alla håll i världen. Vi menar att internets styrka ligger i dess öppenhet och i dess decentraliserade struktur.</p>
					</div>

					<!-- om bilaga finns -->
					<div class="box-10 sidenote tablet-12">
						<h4>Som medlem</h4>
						<p>Som medlem i ISOC-SE är du också medlem i Internet Society, som har över 50 000 medlemmar över hela världen. Läs mer om <a href="!#">Internet Society.</a></p>
					</div>
				</div>
    </div>
  </div>

<!-- /container -->
</div>

<?php get_footer(); ?>