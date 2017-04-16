<script type="text/JavaScript">	

function checkform_login ( form ){
	
	var login=document.forms[form];
	if (login.login.value == "") {
		alert( "Uw e-mail dient ingevuld te worden." );
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