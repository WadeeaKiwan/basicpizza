<script type="text/JavaScript">	

function checkform_create_cat ( form ){
	
	var create_cat=document.forms[form];
	if (create_cat.cat_name.value == "") {
		alert( "De naam dient ingevuld te worden." );
		create_cat.cat_name.focus();
		return false ;
		exit;
	}
	return true ;
}

function checkform_edit_cat ( form ){
	
	var edit_cat=document.forms[form];
	if (edit_cat.cat_name.value == "") {
		alert( "De naam dient ingevuld te worden." );
		edit_cat.cat_name.focus();
		return false ;
		exit;
	}
	return true ;
}

function checkform_create_prod ( form ){
	
	var create_prod=document.forms[form];
	if (create_prod.prod_name.value == "") {
		alert( "De naam dient ingevuld te worden." );
		create_prod.prod_name.focus();
		return false ;
		exit;
	}
	if (create_prod.prod_price.value == "") {
		alert( "De prijs dient ingevuld te worden." );
		create_prod.prod_price.focus();
		return false ;
		exit;
	}
	if (create_prod.prod_text.value == "") {
		alert( "De text dient ingevuld te worden." );
		create_prod.prod_text.focus();
		return false ;
		exit;
	}
	return true ;
}

function checkform_edit_prod ( form ){
	
	var edit_prod=document.forms[form];
	if (edit_prod.prod_name.value == "") {
		alert( "De naam dient ingevuld te worden." );
		edit_prod.prod_name.focus();
		return false ;
		exit;
	}
	if (edit_prod.prod_price.value == "") {
		alert( "De prijs dient ingevuld te worden." );
		edit_prod.prod_price.focus();
		return false ;
		exit;
	}
	if (edit_prod.prod_text.value == "") {
		alert( "De text dient ingevuld te worden." );
		edit_prod.prod_text.focus();
		return false ;
		exit;
	}
	return true ;
}

</script>