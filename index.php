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

	<title>Pizzeria</title>
	<link rel="stylesheet" type="text/css" href="css/main.css" madia="screen" />
</head>
<body>
<div align="center">
	<table width="900" border="0" cellspacing="0">
		<tr>
			<td colspan="4" height="70" valign="middle" align="center">
				<img src="img/logo-pizzeria.png" width="250"  alt="Pizzeria">
			</td>
		</tr>
		<tr>
			<td colspan="4" >
				<hr width="100%">
			</td>
		</tr>
		<tr>
			<td width="250" >
				&nbsp;
			</td>
					<td align="left" width="200" >
						<a href='?p=pizzas'>Pizzas</a>
						<a href='?p=winkelmand'>Winkelmand</a>
					</td>
					<td align="right" width="200" >	
<?PHP
						if (isset($_SESSION['loggedin']))
						{
							echo "&nbsp;&nbsp;<a href='?p=profile'>Pofiel</a>";
							echo "&nbsp;&nbsp;<a href='?p=logout'>Uitloggen</a>";
						}
						else
						{
							echo "&nbsp;&nbsp;<a href='?p=register'>Registreren</a>";
							echo "&nbsp;&nbsp;<a href='?p=login'>Inloggen</a>";
						}
?>
					</td>
			<td width="250" >
				&nbsp;
			</td>
		</tr>
		<tr>
			<td colspan="4">
				<hr width="100%">
			</td>
		</tr>
		<tr>
			<td colspan="4" height="300" valign="top">
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
					?>
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="4">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="4" valign="middle">
				<div align="center">
					<br><br><span class="makers">Design &amp; Coding by Janita Top, Frank Pons, Geert Kruit, Peter Verschuur, Wadeea Kiwan </span>
				</div>
			</td>
		</tr>
	</table>
</div>
</body>
</html>