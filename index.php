<?PHP

	session_start();
	if (!isset($_SESSION['level']))
	{
		$_SESSION['level']= NULL;
	}

	#remove all errors.
	#error_reporting(0);
	
	include 'db/connect.php';
	include 'functions/functies.php';

	#defining variables
	if (!isset($_GET['p']))
	{
		$p = NULL;
	}
	else
	{
		$p = $_GET['p'];
	}
	if (!isset($_GET['i']))
	{
		$i = NULL;
	}
	else
	{
		$i = $_GET['i'];
	}
	if (!isset($_GET['ii']))
	{
		$ii = NULL;
	}
	else
	{
		$ii = $_GET['ii'];
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<META NAME="description" CONTENT="Pizzeria">
	<META NAME="robot" CONTENT="index,follow">

	<title>Pizzeria Basic Pizza</title>
	<link rel="stylesheet" type="text/css" href="css/main.css" madia="screen" />
</head>
<body background="img\bg.png">
<div class="header" align="center">
	<table width="850" border="0" cellspacing="0">
		<tr>
			<td height="70" valign="middle" align="center">
				<img src="img/basicpizzalogo.png" width="800" height="80" alt="Pizzeria Basic Pizza">
			</td>
		</tr>
		<tr>
			<td>
				<hr width="100%">
			</td>
		</tr>
		<tr>
			<td align="center"  >
				<a href='?p=pizzas'><img src="img/b_pizza.png" alt="Kies uw pizza's"></a>&nbsp;&nbsp;
				<a href='?p=winkelmand'><img src="img/b_winkelmand.png" alt="Kies uw pizza's"></a>&nbsp;&nbsp;	
<?PHP
					if (isset($_SESSION['loggedin']))
					{
						echo "<a href='?p=bestellingen'><img src='img/b_bestellingen.jpg' alt='Bestellingen'></a>&nbsp;&nbsp;";
						echo "<a href='?p=profile'><img src='img/b_profiel.png' alt='Profiel'></a>&nbsp;&nbsp;";
						echo "<a href='?p=logout'><img src='img/b_uitloggen.png' alt='Uitloggen'></a>&nbsp;&nbsp;";
					}
					else
					{
						echo "<a href='?p=register'><img src='img/b_registreren.png' alt='Registreren'></a>&nbsp;&nbsp;";
						echo "<a href='?p=login'><img src='img/b_inloggen.png' alt='Inloggen'></a>&nbsp;&nbsp;";
					}
?>
				<a href='?p=contact'><img src="img/b_contact.png" alt="Contact"></a>
			</td>
		</tr>
		<tr>
			<td>
				<hr width="100%">
			</td>
		</tr>
	</table>
</div>	


		
<div align="center">
	<table width="850" border="0" cellspacing="0">			
		
		
		
		<tr>
			<td height="300" valign="top">
				<div align="center">
					<br>
					<?PHP
					if($p == "login")
					{
						include 'login/login.php';
					}
					elseif($p == "logout")
					{
						include 'login/logout.php';
					}
					elseif($p == "register")
					{
						include 'login/register.php';
					}
					elseif($p == "profile")
					{
						include 'login/profile.php';
					}
					elseif($p == "pizzas" or $p == "")
					{
						include 'pages/pizzas.php';
					}
					elseif($p == "winkelmand")
					{
						include 'pages/winkelmand.php';
					}
					elseif($p == "contact")
					{
						include 'pages/contact.php';
					}
					elseif($p == "bestellingen")
					{
						include 'pages/bestellingen.php';
					}
					?>
				</div>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td valign="middle">
				<div class="footer" >
					<span class="makers"><b><center>Design &amp; Coding by Janita Top, Frank Pons, Geert Kruit, Peter Verschuur, Wadeea Kiwan</center></b></span>
				</div>
			</td>
		</tr>
	</table>
</div>
</body>
</html>