<script type="text/JavaScript">	

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



function checkform_login ( form ){
	
	var login=document.forms[form];
	if (login.login.value == "") {
		alert( "Uw gebruikersnaam dient ingevuld te worden." );
		login.login.focus();
		return false ;
		exit;
	}
	if (login.pass.value == "") {
		alert( "Uw wachtwoord dient ingevuld te worden." );
		login.pass.focus();
		return false ;
		exit;
	}
	return true ;
}

</script>