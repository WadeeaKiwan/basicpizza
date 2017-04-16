<?PHP

	session_start();
	
	#remove all errors.
#	error_reporting(0);
	
	if (!isset($_SESSION['level']))
	{
		$_SESSION['level']= 0;
	}

	include '../db/connect.php';
	include '../functions/functies.php';

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
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<META NAME="description" CONTENT="Pizzaria">
	<META NAME="robot" CONTENT="index,follow">

	<title>Pizzeria - CMS</title>
	<link rel="stylesheet" type="text/css" href="../css/main.css" madia="screen" />
</head>
<body class="cms">
<div align="center">

<?PHP
	if ($_SESSION['level']>=5)
	{
		$nu= date('U');
		$verschil= $nu - $_SESSION['last_act'];
		if ($verschil > 3600)
		{
			$_SESSION['loggedin']=0;
			session_destroy();	
		}
?>

<table width="100%" height="100%" border="0" cellspacing="0">
	<tr>
		<td colspan="3" bgcolor="DCDCDC">
			<img src="../img/logo2.svg" width="100" alt="Basic Pizza">Basic Pizza Beheer
		</td>
	</tr>
	<tr>
		<td colspan="3" bgcolor="DCDCDC" >
			<strong><hr width="100%"></strong><br>
		</td>
	</tr>
	<tr height="250" >
		<td width="125" valign="top" bgcolor="DCDCDC">
			<li><a href='?p=admin_users'>Users</a></li>
			<br>
			<hr width="125">
			<br>
			<li><a href='?p=admin_bestel'>Bestellingen</a></li>
			<li><a href='?p=admin_cats'>Categorie</a></li>
			<li><a href='?p=admin_pizzas'>Pizzas</a></li>
			<br>
			<hr width="125">
			<br>
			<li><a href='?p=logout'>Logout</a></li>
			<br><br><br><br>
		</td>
		<td valign="top">
			<div align="center">
				<br>
				<?PHP
				if($p == "login" or $p == "")
				{
					include 'login/login.php';
				}
				elseif($p == "admin_users")
				{
					include 'pages/admin_users.php';
				}
				elseif($p == "admin_bestel")
				{
					include 'pages/admin_bestellingen.php';
				}
				elseif($p == "admin_cats")
				{
					include 'pages/admin_cats.php';
				}
				elseif($p == "admin_pizzas")
				{
					include 'pages/admin_pizzas.php';
				}
				elseif($p == "logout")
				{
					include 'login/logout.php';
				}
				?>
			</div>
		</td>
	</tr>
	<tr>
		<td bgcolor="DCDCDC">&nbsp;</td>
		<td valign="middle">
			<div align="center">
				<br><br><span class="makers">Design &amp; Coding by Janita Top, Frank Pons, Geert Kruit, Peter Verschuur, Wadeea Kiwan </span>
			</div>
		</td>
	</tr>
</table>
</body>
</html>
<?PHP
	}
#####################################################################################################################################
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