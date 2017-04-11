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
<div align="center">
	<table width="900" border="0" cellspacing="0">
		<tr>
			<td colspan="5" height="70" valign="middle" align="center">
				<img src="img/basicpizzalogo.png" width="800" height="80" alt="Pizzeria Basic Pizza">
			</td>
		</tr>
		<tr>
			<td colspan="5" >
				<hr width="100%">
			</td>
		</tr>
		<tr>
			<td width="160" align="center"  >
						<a href='?p=pizzas'><img src="img/b_pizza.png" width="160" height="40" alt="Kies uw pizza's"></a>
			</td>
			
			<td width="160" align="center"  >
					<a href='?p=winkelmand'><img src="img/b_winkelmand.png" width="160" height="40" alt="Kies uw pizza's"></a>
			</td>
			
			<td width="160" align="center"  >	
<?PHP
						if (isset($_SESSION['loggedin']))
						{
							echo "<a href='?p=profile'><img src='img/b_profiel.png' width='160' height='40' alt='Profiel'></a>";
							echo '</td><td width="160" align="center"  >';
							echo "<a href='?p=logout'><img src='img/b_uitloggen.png' width='160' height='40' alt='Uitloggen'></a>";
						}
						else
						{
							echo "<a href='?p=register'><img src='img/b_registreren.png' width='160' height='40' alt='Registreren'></a>";
							echo '</td><td width="160" align="center"  >';
							echo "<a href='?p=login'><img src='img/b_inloggen.png' width='160' height='40' alt='Inloggen'></a>";
						}
?>
			</td>
			<td width="160" align="center"  >
				<a href='?p=contact'><img src="img/b_contact.png" width="160" height="40" alt="Contact"></a>
			</td>
		</tr>
		<tr>
			<td colspan="5">
				<hr width="100%">
			</td>
		</tr>
		<tr>
			<td colspan="5" height="300" valign="top">
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
					?>
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="4">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="4" valign="middle">
				<div class="footer" >
					<span class="makers"><b><center>Design &amp; Coding by Janita Top, Frank Pons, Geert Kruit, Peter Verschuur, Wadeea Kiwan</center></b></span>
				</div>
			</td>
		</tr>
	</table>
</div>
</body>
</html>