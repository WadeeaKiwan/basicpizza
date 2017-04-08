<script type="text/JavaScript">	

function checkform_create_user ( form ){	

	var create_user=document.forms[form];
	if (create_user.login.value == "") {
		alert( "De gebruikersaam dient ingevuld te worden." );
		create_user.login.focus();
		return false ;
		exit;
	}
	if (create_user.pass.value == "") {
		alert( "Het wachtwoord dient ingevuld te worden." );
		create_user.pass.focus();
		return false ;
		exit;
	}
	if (create_user.passcheck.value == "") {
		alert( "Het controlewachtwoord dient ingevuld te worden." );
		create_user.passcheck.focus();
		return false ;
		exit;
	}
	return true ;
}

function checkform_update_profile ( form ){
	
	var update_profile=document.forms[form];
	if (update_profile.aanhef.value == "") {
		alert( "Uw aanhef dient ingevuld te worden." );
		update_profile.aanhef.focus();
		return false ;
		exit;
	}
	if (update_profile.voornaam.value == "") {
		alert( "Uw voornaam dient ingevuld te worden." );
		update_profile.voornaam.focus();
		return false ;
		exit;
	}
	if (update_profile.achternaam.value == "") {
		alert( "Uw achternaam dient ingevuld te worden." );
		update_profile.achternaam.focus();
		return false ;
		exit;
	}
	if (update_profile.straat.value == "") {
		alert( "Uw straatnaam dient ingevuld te worden." );
		update_profile.straat.focus();
		return false ;
		exit;
	}
	if (update_profile.huisnummer.value == "") {
		alert( "Uw huisnummer dient ingevuld te worden." );
		update_profile.huisnummer.focus();
		return false ;
		exit;
	}
	if (update_profile.postcode.value == "") {
		alert( "Uw postcode dient ingevuld te worden." );
		update_profile.postcode.focus();
		return false ;
		exit;
	}	
	if (update_profile.woonplaats.value == "") {
		alert( "Uw woonplaats dient ingevuld te worden." );
		update_profile.woonplaats.focus();
		return false ;
		exit;
	}	
	if (update_profile.telefoonnummer.value == "") {
		alert( "Uw telefoonnummer dient ingevuld te worden." );
		update_profile.telefoonnummer.focus();
		return false ;
		exit;
	}
	return true ;
}

function checkform_change_pass ( form ){
	
	var change_pass=document.forms[form];
	if (change_pass.pass.value == "") {
		alert( "Uw nieuwe wachtwoord dient ingevuld te worden." );
		change_pass.pass.focus();
		return false ;
		exit;
	}
	if (change_pass.passcheck.value == "") {
		alert( "Uw nieuwe wachtwoord controle dient ingevuld te worden." );
		change_pass.passcheck.focus();
		return false ;
		exit;
	}
	return true ;
}

</script>