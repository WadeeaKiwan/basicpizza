<script type="text/JavaScript">	

function checkform_create_mat ( form ){
	
	var create_mat=document.forms[form];
	if (create_mat.mat_name.value == "") {
		alert( "De naam dient ingevuld te worden." );
		create_mat.mat_name.focus();
		return false ;
		exit;
	}
	if (create_mat.mat_price.value == "") {
		alert( "De prijs dient ingevuld te worden." );
		create_mat.mat_price.focus();
		return false ;
		exit;
	}
	return true ;
}


</script>