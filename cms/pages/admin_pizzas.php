<?PHP

	session_start();
	
	if (!isset($_SESSION['level']) OR  $_SESSION['level'] >=5)
	{
		
#####################################################################################################################################

 		echo "PIZZAS";
 
#####################################################################################################################################
	}
	else
	{
		if (!$_SESSION['level'])
		{

			if (!$_SESSION['level'])
			{
				include 'login/login.php';
				exit;
			}
		}
		else
		{
			echo "<span class='false_warning' ><strong>Onvoldoende rechten.</strong></span>";
		}
	}
?>	