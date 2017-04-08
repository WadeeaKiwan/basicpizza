<script type="text/JavaScript">	

function checkform_register ( form ){
	
	var register=document.forms[form];
	if (register.aanhef.value == "") {
		alert( "Uw aanhef dient ingevuld te worden." );
		register.aanhef.focus();
		return false ;
		exit;
	}
	if (register.voornaam.value == "") {
		alert( "Uw voornaam dient ingevuld te worden." );
		register.voornaam.focus();
		return false ;
		exit;
	}
	if (register.achternaam.value == "") {
		alert( "Uw achternaam dient ingevuld te worden." );
		register.achternaam.focus();
		return false ;
		exit;
	}
	if (register.straat.value == "") {
		alert( "Uw straatnaam dient ingevuld te worden." );
		register.straat.focus();
		return false ;
		exit;
	}
	if (register.huisnummer.value == "") {
		alert( "Uw huisnummer dient ingevuld te worden." );
		register.huisnummer.focus();
		return false ;
		exit;
	}
	if (register.postcode.value == "") {
		alert( "Uw postcode dient ingevuld te worden." );
		register.postcode.focus();
		return false ;
		exit;
	}	
	if (register.woonplaats.value == "") {
		alert( "Uw woonplaats dient ingevuld te worden." );
		register.woonplaats.focus();
		return false ;
		exit;
	}	
	if (register.email.value == "") {
		alert( "Uw E-Mail adres dient ingevuld te worden." );
		register.email.focus();
		return false ;
		exit;
	}	
	if (register.telefoonnummer.value == "") {
		alert( "Uw telefoonnummer dient ingevuld te worden." );
		register.telefoonnummer.focus();
		return false ;
		exit;
	}
	if (register.pass.value == "") {
		alert( "Het wachtwoord dient ingevuld te worden." );
		register.pass.focus();
		return false ;
		exit;
	}
	if (register.passcheck.value == "") {
		alert( "Het controlewachtwoord dient ingevuld te worden." );
		register.passcheck.focus();
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
	if (change_pass.old_pass.value == "") {
		alert( "Uw oude wachtwoord dient ingevuld te worden." );
		change_pass.old_pass.focus();
		return false ;
		exit;
	}	
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