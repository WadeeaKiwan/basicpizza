<?PHP

	$mysql_host="localhost";
	$mysql_user="root";
	//$mysql_pwd="qwerty";
	$mysql_pwd="root";
	$mysql_db="seniorenappartement_apeldoorn_nl_pizzeria";
	//$mysql_port="3306";
	$mysql_port="8889";

	//mysql_connect($mysql_host,$mysql_user,$mysql_pwd) or die(mysql_error());
	//mysql_select_db($mysql_db) or die(mysql_error());

	
	//php >= 5.6
	$link = mysqli_init();
	$success = mysqli_real_connect(
	   $link, 
	   $mysql_host, 
	   $mysql_user, 
	   $mysql_pwd, 
	   $mysql_db,
	   $mysql_port
	);

?>