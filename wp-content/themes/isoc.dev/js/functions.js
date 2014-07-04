
$(document).ready(function() {
	
	console.log("i love lamp");

	var win   = $(window);
	var doc   = $(document);
	var body  = $('body');
	var $self = $(this);


	// Om man trycker i checkbox under medlem-sidan 
	// så visar vi resten av formuläret.
	// Vi lägger även till "required" till fälten
	// i företagsformuläret om checkboxen är checkad.
	// Vilket vi inte vill ska göra det jobbigt för oss 
	// vid validering om man inte tryck i den.

	$('#checkboxForetag').change(function(){
		$('.medlem-foretag').fadeToggle();

		if($('#checkboxForetag').is(':checked')) {
		  	$('.medlem-foretag').find('input').prop('required',true);
		}
		else {
			$('.medlem-foretag').find('input').prop('required',false);
		}
	});

	// Verifiering av "bli medlem"-formulär
	// Löser sig ganska lätt med HTML5.
	$( "#medlemFormular" ).submit(function( event ) {
		alert("wop!");
		event.preventDefault();
	});
});