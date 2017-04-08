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

</script>