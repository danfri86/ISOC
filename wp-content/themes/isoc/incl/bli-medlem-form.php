<div class="box-12 medlem-form tablet-12">
	<form id="medlemFormular" action="<?php the_permalink(); ?>" method="post">
		<div class="box-6 np">
			<label for="fornamn">Förnamn*</label>
			<input type="name" name="fornamn" required placeholder="">

			<label for="efternamn">Efternamn*</label>
			<input type="name" name="efternamn" required placeholder="">

			<label for="adress">Gatuadress*</label>
			<input type="name" name="adress" required placeholder="">

			<label for="postnummer">Postnummer*</label>
			<input type="name" name="postnummer" required placeholder="">

			<label for="ort">Ort*</label>
			<input type="name" name="ort" required placeholder="">

			<label for="email">E-mail*</label>
			<input type="name" name="email" required placeholder="">

			<div class="medlem-foretag">
  			<input type="name" name="foretag-namn" placeholder="Företagsnamn*">
    		<input type="name" name="foretag-adress" placeholder="Gatuadress*">
    		<input type="name" name="foretag-postnummer" placeholder="Postnummer*">
    		<input type="name" name="foretag-ort" placeholder="Ort*">
    	</div>
		</div>

		<div class="box-6 np pl">
			<label for="meddelande">Ditt meddelande</label>
			<textarea name="meddelande" rows="5" cols="30" placeholder=""></textarea>

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