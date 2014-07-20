<?php

function skapaAnvandare(){
	// Skapa variabler av formulärets fält
	$fornamn = $_POST['fornamn'];
	$efternamn = $_POST['efternamn'];
	$adress = $_POST['adress'];
	$postnummer = $_POST['postnummer'];
	$ort = $_POST['ort'];
	$email = $_POST['email'];

	$foretagNamn = $_POST['foretag-namn'];
	$foretagAdress = $_POST['foretag-adress'];
	$foretagPostnummer = $_POST['foretag-postnummer'];
	$foretagOrt = $_POST['foretag-ort'];

	$meddelande = $_POST['meddelande'];
	$medlemstyp = $_POST['medlemstyp'];
	$annanBetalar = $_POST['annanBetalar'];

	// Kolla så att en användare med samma användarnamn(epost) och epost inte existerar
  if( !username_exists($email) || !email_exists($email) ){
  	// Skapa ett lösenord
    $password = wp_generate_password();

    // wp_create_user(anv.namn, lösenprd, epost)
    $user_id = wp_create_user($email, $password, $email);    

    wp_update_user(
      array(
        'ID'        => $user_id,
        'nickname'  => $fornamn,
        'first_name'=> $fornamn,
        'last_name' => $efternamn,
        'display_name' => $fornamn,
        'description' => $meddelande,
      )
    );

    // Om användaren skapades
    if( $user_id ){
    	// Lägg till egna fält
    	update_user_meta($user_id, 'medlemstyp', $medlemstyp);
    	update_user_meta($user_id, 'adress', $medlemstyp);
    	update_user_meta($user_id, 'postnummer', $medlemstyp);
    	update_user_meta($user_id, 'ort', $medlemstyp);

			update_user_meta($user_id, 'foretag-namn', $medlemstyp);
    	update_user_meta($user_id, 'foretag-adress', $medlemstyp);
    	update_user_meta($user_id, 'foretag-postnummer', $medlemstyp);
    	update_user_meta($user_id, 'foretag-ort', $medlemstyp);

      // Maila klienten och admin
      nyAnvandare_epost_klient($email, $password);
      nyAnvandare_epost_admin($namn);
    }
  }
}





function nyAnvandare_epost_klient($email, $password){
  $subject = 'Välkommen!';

  ob_start();
  include("email_header.php");

    echo '<h3>Välkommen!</h3>';

    echo '<p>Användarnamn: '. $email .'</br>Lösenord: '. $password .'</p>';
    echo '<p>Logga in på <a href="'. site_url() .'">hemsidan</a>.<br/>';
    //echo 'När du loggat in kan du ändra ditt lösenord i din profil.</p>';

  include("email_footer.php");
  $meddelande = ob_get_contents();
  ob_end_clean();

  wp_mail( $email, $subject, $meddelande );
}





function nyAnvandare_epost_admin($namn){
  // Hämta admins email
  $adminMail = get_option( 'admin_email' );

  $subject = 'Ny användare!';

  ob_start();
  include("email_header.php");

    echo '<h3>En användare har registrerat sig</h3>';
    // echo '<p class="lead">Ingress</p>';

    echo '<p>'. $namn .' har registrerat sig på ISOCs webbsida.</p>';

  include("email_footer.php");
  $meddelande = ob_get_contents();
  ob_end_clean();

  wp_mail( $adminMail, $subject, $meddelande );
}

?>