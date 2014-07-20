<div class="box-12 medlem-form tablet-12">
	<form id="medlemFormular" action="<?php the_permalink(); ?>" method="post">
		<div class="box-6 np">
			<input type="name" name="fornamn" required placeholder="Förnamn*">
			<input type="name" name="efternamn" required placeholder="Efternamn*">
			<input type="name" name="adress" required placeholder="Gatuadress*">
			<input type="name" name="postnummer" required placeholder="Postnummer*">
			<input type="name" name="ort" required placeholder="Ort*">
			<input type="name" name="email" required placeholder="E-mail*">

			<div class="medlem-foretag">
  			<input type="name" name="foretag-namn" placeholder="Företagsnamn*">
    		<input type="name" name="foretag-adress" placeholder="Gatuadress*">
    		<input type="name" name="foretag-postnummer" placeholder="Postnummer*">
    		<input type="name" name="foretag-ort" placeholder="Ort*">
    	</div>
		</div>

		<div class="box-6 np pl">
			<textarea name="meddelande" rows="5" cols="30" placeholder="Ditt meddelande"></textarea>

			<select name="medlemstyp" required>
			  <option value="">Typ av medlemsskap &#xf107;</option>
		  	<option value="Fullbetalande">Fullbetalande</option>
		  	<option value="Studerande">Studerande</option>
		  	<option value="Pensionär">Pensionär</option>
			</select>

			<input type="checkbox" name="annanBetalar" id="checkboxForetag" value="Företag/Organisation betalar"><small>Företag/organisation ska betala</small>
			
			<?php
			// För säkerhet
			wp_nonce_field( 'post_nonce', 'post_nonce_field' );
			?>

			<input class="btn blue" name="bli-medlem-submit" type="submit" value="Skicka">
		</div>  			
	</form>
</div>