<?PHP

	$mysql_host="localhost";
	$mysql_user="root";
	$mysql_pwd="";
	$mysql_db="basicpizza"; 
	$mysql_port="3306";
	
#	$mysql_host="seniorenappartement-apeldoorn.nl.mysql";
#	$mysql_user="seniorenappartement_apeldoorn_nl_pizzeria";
#	$mysql_pwd="qwerty12!";
#	$mysql_db="seniorenappartement_apeldoorn_nl_pizzeria";
#	$mysql_port="3306";

	mysql_connect($mysql_host,$mysql_user,$mysql_pwd) or die(mysql_error());
	mysql_select_db($mysql_db) or die(mysql_error());

?>