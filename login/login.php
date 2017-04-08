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
					echo "<span class='false_warning' ><strong>Ongeldige gebruikersnaam en/of wachtwoord.</strong></span><br />";
					echo '<meta http-equiv="Refresh" content="2;URL=?p=login" />';
				}
			}
		}
		else
		{
?>

<form name="login" action="?p=login&i=login" method="POST" onsubmit="return checkform_login('login')">
	<table width="200" border="0" align="center">
		<tr>
			<td align="right">Gebruikersnaam </td>
			<td align="left"><input type="text" name="login"></td>
		</tr>
		<tr>
			<td align="right">Wachtwoord </td>
			<td align="left"><input type="password" name="pass"></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><input type="submit" name="submit" value="Inloggen"></td>
		</tr>
	</table>
</form>

<?PHP
		}
	}
	else
	{
?>
	<div align="center">
		<table width="100%">
			<tr>
				<td align="center" ><span class='true_warning' ><strong>U bent ingelogd als: <?PHP echo $_SESSION['user']?>.</strong></span></td>
				<meta http-equiv="Refresh" content="2;URL=?p=" />
			</tr>
		</table>
	</div>
<?PHP
	}
?>