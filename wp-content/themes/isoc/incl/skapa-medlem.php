<?php

function skapaMedlem(){
	// Skapa variabler av formulärets fält
	$fornamn = sanitize_text_field($_POST['fornamn']);
	$efternamn = sanitize_text_field($_POST['efternamn']);
	$adress = sanitize_text_field($_POST['adress']);
	$postnummer = sanitize_text_field($_POST['postnummer']);
	$ort = sanitize_text_field($_POST['ort']);
	$email = sanitize_text_field($_POST['email']);

	$foretagNamn = sanitize_text_field($_POST['foretag-namn']);
	$foretagAdress = sanitize_text_field($_POST['foretag-adress']);
	$foretagPostnummer = sanitize_text_field($_POST['foretag-postnummer']);
	$foretagOrt = sanitize_text_field($_POST['foretag-ort']);

	$meddelande = wp_kses_post($_POST['meddelande']);
	$medlemstyp = sanitize_text_field($_POST['medlemstyp']);
	$annanBetalar = sanitize_text_field($_POST['annanBetalar']);

  // Skapa meta för inlägget
  $post_meta = array(
    'post_type'   => 'medlemmar',
    'post_title'  => $fornamn .' '. $efternamn,
    'post_status' => 'publish',
  );

  // Skapa inlägg
  $post_id = wp_insert_post($post_meta);

  // Sätt in data i egna metafält om inlägget har skapats korrekt
  if( $post_id ) {
    add_post_meta($post_id, 'medlem_adress', $adress);
    add_post_meta($post_id, 'medlem_postnummer', $postnummer);
    add_post_meta($post_id, 'medlem_ort', $ort);
    add_post_meta($post_id, 'medlem_email', $email);
    add_post_meta($post_id, 'medlem_meddelande', $meddelande);

    add_post_meta($post_id, 'medlem_medlemstyp', $medlemstyp);
    add_post_meta($post_id, 'medlem_foretag-betalar', $annanBetalar);

    add_post_meta($post_id, 'medlem_foretag-namn', $foretagNamn);
    add_post_meta($post_id, 'medlem_foretag-adress', $foretagAdress);
    add_post_meta($post_id, 'medlem_foretag-postnummer', $foretagPostnummer);
    add_post_meta($post_id, 'medlem_foretag-ort', $foretagOrt);

    // Om inlägget skapats så epost konfirmation till medlemmen
    nyMedlem_epost_klient($email);

    // Om inlägget skapats så eposta meddelande till admin
    nyMedlem_epost_admin($fornamn, $efternamn, $adress, $postnummer, $ort, $email, $meddelande, $medlemstyp, $annanBetalar, $foretagNamn, $foretagAdress, $foretagPostnummer, $foretagOrt);
  }

}





function nyMedlem_epost_klient($email) {
  $themeOptions = get_option('isoc_options');

  $subject = 'Välkommen till ISOC-SE!';

  ob_start();
  include("email_header.php");

    echo '<h3>'. $themeOptions['bliMedlem_rubrik'] .'</h3>';

    echo apply_filters('the_content', $themeOptions['bliMedlem_text']);

  include("email_footer.php");
  $meddelande = ob_get_contents();
  ob_end_clean();

  wp_mail( $email, $subject, $meddelande );
}





function nyMedlem_epost_admin($fornamn, $efternamn, $adress, $postnummer, $ort, $email, $meddelande, $medlemstyp, $annanBetalar, $foretagNamn, $foretagAdress, $foretagPostnummer, $foretagOrt) {
  // Hämta admins email
  $adminMail = get_option( 'admin_email' );

  $subject = 'Ny medlem i ISOC-SE!';

  ob_start();
  include("email_header.php");

    echo '<h3>ISOC-SE har fått en ny medlem.</h3>';

    echo '<p>';
      echo '<b>Namn:</b> '. $fornamn .' '. $efternamn .'</br>';
      echo '<b>Epost:</b> '. $email .'</br>';
      echo '<b>Medlemstyp:</b> '. $medlemstyp .'</br>';
      echo '<b>Adress:</b> '. $adress .', '. $postnummer .' '. $ort;
    echo '</p>';

    if( !empty($meddelande) ) {
      echo '<p><b>Meddelande</b></p>';
      echo apply_filters('the_content', $meddelande);
    }


    if( !empty($annanBetalar) ) {
      echo '<p>';
        echo 'Någon annan än personen själv betalar medlemsskapet. Följande företag/organistaion har angetts:</br>';
        echo '<b>Företag:</b> '. $foretagNamn .'</br>';
        echo '<b>Adress:</b> '. $foretagAdress .', '. $foretagPostnummer .' '. $foretagOrt;
      echo '</p>';
    }

    echo '<p>En konfirmation har automatiskt skickats till den nya medlemmen.</p>';

  include("email_footer.php");
  $meddelande = ob_get_contents();
  ob_end_clean();

  wp_mail( $adminMail, $subject, $meddelande );
}

?>