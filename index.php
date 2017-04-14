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
				<li><a href='?p=pizzas'>Pizza's</a></li>
				<li><a href='?p=winkelmand'>Winkelmand</a></li>
				<?PHP
					if (isset($_SESSION['loggedin']))
					{
						echo "<li><a href='?p=bestellingen'>Bestellingen</a></li>";
						echo "<li><a href='?p=profile'>Profiel</a></li>";
						echo "<li><a href='?p=logout'>Uitloggen</a></li>";
					}
					else
					{
						echo "<li><a href='?p=register'>Registreren</a></li>";
						echo "<li><a href='?p=login'>Inloggen</a></li>";
					}
				?>

				<li><a href='?p=contact'>Contact</a></li>
			</ul>
		</nav>

	</header>
		
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