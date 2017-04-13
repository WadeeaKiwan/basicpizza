<?PHP

	$mysql_host="localhost";
	$mysql_user="root";
<<<<<<< HEAD
	$mysql_pwd="qwerty";
	$mysql_db="seniorenappartement_apeldoorn_nl_pizzeria";
	$mysql_port="3306";
=======
	$mysql_pwd="root";
	$mysql_db="seniorenappartement_apeldoorn_nl_pizzeria"; 
	$mysql_port="8889";
>>>>>>> c4387f5aaf2b14eb6765e8bc03b185f7318a4d59
	
#	$mysql_host="seniorenappartement-apeldoorn.nl.mysql";
#	$mysql_user="seniorenappartement_apeldoorn_nl_pizzeria";
#	$mysql_pwd="qwerty12!";
#	$mysql_db="seniorenappartement_apeldoorn_nl_pizzeria";
#	$mysql_port="3306";

	mysql_connect($mysql_host,$mysql_user,$mysql_pwd) or die(mysql_error());
	mysql_select_db($mysql_db) or die(mysql_error());

?>