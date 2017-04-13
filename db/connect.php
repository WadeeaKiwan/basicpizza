<?PHP

	$mysql_host="localhost";
	$mysql_user="root";
	$mysql_pwd="root";
	$mysql_db="seniorenappartement_apeldoorn_nl_pizzeria";
	$mysql_port="8889";

	mysql_connect($mysql_host,$mysql_user,$mysql_pwd) or die(mysql_error());
	mysql_select_db($mysql_db) or die(mysql_error());

?>