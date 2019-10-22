<?PHP
/*error_reporting(E_ALL);
ini_set("display_errors", On);*/

	include 'jscripts/checkform/admin_login_checkform.js';
	
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
				echo "<table align='center'><tr><td><span class='false_warning' ><strong>Er zijn onvoldoende gegevens opgegeven.</strong></span><br /></td></tr></table>";
				echo '<meta http-equiv="Refresh" content="2;URL=../cms" />';
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
				
					echo "<table align='center'><tr><td><span class='true_warning' ><strong>U bent ingelogd als: ".$_SESSION['user']."</strong></span><br /></td></tr></table>";
					echo '<meta http-equiv="Refresh" content="2;URL=../cms" />';
				}
				else
				{
					echo "<table align='center'><tr><td><span class='false_warning' ><strong>Ongeldige gebruikersnaam en/of wachtwoord.</strong></span><br /></td></tr></table>";
					echo '<meta http-equiv="Refresh" content="2;URL=../cms" />';
				}
			}
		}
		else
		{
?>

<div align="center">
	<form name="login" action="?i=login" method="post" onsubmit="return checkform_login('login')">
		<table width="19%" border="1" cellspacing="0">
			<tr>
				<td class="custom_bgcollor"><div align="center"><strong>Inloggen</strong></div></td>
			</tr>
			<tr>
				<td>
					<div align="left">
						<table>
							<tr>
								<td width="40%">Login:</td>
								<td align="left"><input type="text" name="login"></td>
							</tr>
						</table>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div align="left">
						<table>
							<tr>
								<td width="40%">Password:</td>
								<td><input type="password" name="pass"></td>
							</tr>
						</table>
					</div>
				</td>
			</tr>
			<tr>
				<td><div align="center"><input type="submit" value="Inloggen"></div></td>
			</tr>
		</table>
	</form>
</div>

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
			</tr>
		</table>
	</div>
<?PHP
	}
?>
