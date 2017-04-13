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

	/*defining variables:
	$p = pagina
	$i = subpagina
	$ii = subsubpagina
	*/
	
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

<!DOCTYPE html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="robot" content="noindex,nofollow">
	<title>Pizzeria Basic Pizza</title>
	<link rel="stylesheet" type="text/css" href="css/main.css" media="screen" />
</head>

<body>

	<header>
		<nav>
			<ul>
				<li><a href='?p=pizzas'><img src="img/b_pizza.png" alt="Kies uw pizza's"></a></li>
				<li><a href='?p=winkelmand'><img src="img/b_winkelmand.png" alt="Kies uw pizza's"></a></li>
				<?PHP
					if (isset($_SESSION['loggedin']))
					{
						echo "<li><a href='?p=bestellingen'><img src='img/b_bestellingen.jpg' alt='Bestellingen'></a></li>";
						echo "<li><a href='?p=profile'><img src='img/b_profiel.png' alt='Profiel'></a></li>";
						echo "<li><a href='?p=logout'><img src='img/b_uitloggen.png' alt='Uitloggen'></a></li>";
					}
					else
					{
						echo "<li><a href='?p=register'><img src='img/b_registreren.png' alt='Registreren'></a></li>";
						echo "<li><a href='?p=login'><img src='img/b_inloggen.png' alt='Inloggen'></a></li>";
					}
				?>

				<li><a href='?p=contact'><img src="img/b_contact.png" alt="Contact"></a></li>
			</ul>
		</nav>
		
		<main>
			<table>
				<tr>
					<td>
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
					</td>
				</tr>
			</table>
		</main>

	<footer>
		<span class="makers">Design &amp; Coding by Janita Top, Frank Pons, Geert Kruit, Peter Verschuur, Wadeea Kiwan</span>
	</footer>

</body>
</html>