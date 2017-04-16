<?PHP

	include 'jscripts/checkform/login_checkform.js';
	
	#remove all errors.
	error_reporting(0);
	
	if(!isset($_COOKIE["PHPSESSID"]))
	{
  		session_start();
	}
	
	if (!isset($_SESSION['loggedin']) OR $_SESSION['loggedin']!=1)
	{
		if ($i=="login")
		{
			if ( ($_POST['login']=="") || ($_POST['pass']=="") )
			{
				echo "<span class='false_warning' ><strong>Er zijn onvoldoende gegevens opgegeven.</strong></span>";
				echo '<meta http-equiv="Refresh" content="2;URL=?p=login" />';
			}
			else
			{
				$rs_select_user= mysql_query("SELECT * FROM users WHERE user_login='".$_POST['login']."'");
				$row_user= mysql_fetch_array($rs_select_user);

				if ( (md5($_POST['pass'])==$row_user['user_pass']) && ($row_user['user_level']>=1) )
				{

					$_SESSION['loggedin'] = 1;
					$_SESSION['user_id'] = $row_user['user_id'];
					$_SESSION['user'] = $row_user['user_login'];
					$_SESSION['level'] = $row_user['user_level'];
					$_SESSION['last_act'] = date("U");

					mysql_query("UPDATE users SET user_lastlogin='".date("Y-m-d H:i:s")."' WHERE user_login='".$_POST['login']."'");
				
					echo '<meta http-equiv="Refresh" content="0;URL=?p=login" />';
				}
				else
				{
					echo "<span class='false_warning' >Ongeldig emailadres en/of wachtwoord.</strong></span><br />";
					echo '<meta http-equiv="Refresh" content="2;URL=?p=login" />';
				}
			}
		}
		else
		{
?>

<h1>Inloggen</h1>

<form name="login" action="?p=login&i=login" method="POST" onsubmit="return checkform_login('login')">
	
	<div class="register">Nog geen inloggegevens? Ga eerst naar <a class="wijzigen" href='?p=register'>registreren</a></div>

	<div>
		<label for="login">E-Mail </label>
		<input type="text" name="login" id="login">
	</div>
	<div>
		<label for="pass">Wachtwoord </label>
		<input type="password" name="pass" id="pass">
	</div>
	
	<input type="submit" name="submit" value="Inloggen">

</form>



<?PHP
		}
	}
	else
	{
?>

	<span class='true_warning' >U bent ingelogd als: <?PHP echo $_SESSION['user']?>.</span><
	<meta http-equiv="Refresh" content="2;URL=?p=" />
			
<?PHP
	}
?>