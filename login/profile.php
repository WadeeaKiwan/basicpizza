<?PHP

	include 'jscripts/checkform/users_checkform.js';

	if (isset($_SESSION['loggedin']) AND $_SESSION['loggedin']==1)
	{
		$user_id = $_SESSION['user_id'];
		
#####################################################################################################################################		
		if ($i=="change_profile")
		{
			if ($ii=="update_profile")
			{	
				$rs_select_profile= mysql_query("SELECT * FROM user_profiles WHERE user_id=".$user_id);

				if (mysql_num_rows($rs_select_profile))
				{
					mysql_query("UPDATE user_profiles SET aanhef='".$_POST['aanhef']."', voornaam='".$_POST['voornaam']."', achternaam='".$_POST['achternaam']."', straat='".$_POST['straat']."', huisnummer='".$_POST['huisnummer']."', postcode='".$_POST['postcode']."', woonplaats='".$_POST['woonplaats']."', telefoonnummer='".$_POST['telefoonnummer']."' WHERE user_id=".$user_id);

					echo "<span class='true_warning' ><strong>Profiel gewijzigd.</strong></span>";
				}
				else
				{
					mysql_query("INSERT INTO `user_profiles` (`user_id`, `voornaam`, `achternaam`, `straat`, `huisnummer`, `postcode`, `woonplaats`, `telefoonnummer`, `aanhef`) VALUES ('".$user_id."', '".$_POST['voornaam']."', '".$_POST['achternaam']."', '".$_POST['straat']."', '".$_POST['huisnummer']."', '".$_POST['postcode']."', '".$_POST['woonplaats']."', '".$_POST['telefoonnummer']."', '".$_POST['aanhef']."')");

					echo "<span class='true_warning' ><strong>Profiel toegevoegd.</strong></span>";
				}

				echo '<META http-equiv="refresh" content="2;URL=?p='.$p.'&i='.$i.'&user_id='.$user_id.'">';
			}
			##################################
			else
			{
				$sql_select_user= mysql_query("SELECT * FROM `users` WHERE user_id='".$user_id."'");
				$row_user= mysql_fetch_array($sql_select_user);

				$sql_select_user_profile= mysql_query("SELECT * FROM `user_profiles` WHERE user_id='".$user_id."'");
				$row_user_profile= mysql_fetch_array($sql_select_user_profile);
				
				if ($row_user_profile['voornaam']=="" AND $row_user_profile['achternaam']=="")
				{
					$naam= $row_user['user_login'];
				}
				else
				{
					$naam= "".$row_user_profile['voornaam']."&nbsp;".$row_user_profile['achternaam']."";
				}
					
				$rs_select_profile= mysql_query("SELECT * FROM user_profiles WHERE user_id=".$user_id);
				$row_profile= mysql_fetch_array($rs_select_profile);
?>
	<table width="35%" border="0" align="center">
		<tr>
			<td align="center"><u><h3>Persoonlijk profiel bewerken van: <?PHP echo $naam?>.</h3></u></td>
		</tr>
		<tr>
			<td align="center" valign="top">
				<a href="?p=<?PHP echo $p?>">Terug.</a>
			</td>
		</tr>
		<tr>
			<td colspan="2"><hr width="100%"></hr></td>
		</tr>
	</table>

	</br>

	<table>
		<tr>
			<td>
				<form name="update_profile" method="post" action="?p=<?PHP echo $p?>&i=<?PHP echo $i?>&ii=update_profile&user_id=<?PHP echo $user_id?>" onsubmit="return checkform_update_profile('update_profile')">
					<table width="100%" border="0" align="center">
						<tr>
							<td align="right" width="5%">*</td>
							<td align="left" width="35%">Aanhef</td>
							<td align="left" width="60%">
								<p>
								<?PHP
								if ($row_profile['aanhef']=="Mevr.")
								{?>
								<label><input type="radio" name="aanhef" value="Dhr." />Dhr.</label>
								<label><input type="radio" name="aanhef" checked="checked" value="Mevr." />Mevr.</label>
								<?PHP
								}
								else
								{
								?>
								<label><input type="radio" name="aanhef" checked="checked" value="Dhr." />Dhr.</label>
								<label><input type="radio" name="aanhef" value="Mevr." />Mevr.</label>
								<?PHP
								}
								?>
								</p>
							</td>
						</tr>
						<tr>
							<td align="right">*</td>
							<td align="left">Voornaam</td>
							<td align="left"><input name="voornaam" type="text" id="voornaam" size="25" maxlength="25" value="<?PHP echo $row_profile['voornaam']?>" /></td>
						</tr>
						<tr>
							<td align="right">*</td>
							<td align="left">Achternaam</td>
							<td align="left"><input name="achternaam" type="text" id="achternaam" size="25" maxlength="25" value="<?PHP echo $row_profile['achternaam']?>" /></td>
						</tr>
						<tr>
							<td align="right">*</td>
							<td align="left">Straatnaam</td>
							<td align="left"><input name="straat" type="text" id="straat" size="25" maxlength="25" value="<?PHP echo $row_profile['straat']?>" /></td>
						</tr>
						<tr>
							<td align="right">*</td>
							<td align="left">Huisnummer</td>
							<td align="left"><input name="huisnummer" type="text" id="huisnummer" size="10" maxlength="10" value="<?PHP echo $row_profile['huisnummer']?>" /></td>
						</tr>
						<tr>
							<td align="right">*</td>
							<td align="left">Postcode</td>
							<td align="left"><input name="postcode" type="text" id="postcode" size="10" maxlength="10" value="<?PHP echo $row_profile['postcode']?>" /></td>
						</tr>
						<tr>
							<td align="right">*</td>
							<td align="left">Woonplaats</td>
							<td align="left"><input name="woonplaats" type="text" id="woonplaats" size="25" maxlength="25" value="<?PHP echo $row_profile['woonplaats']?>" /></td>
						</tr>
						<tr>
							<td align="right">*</td>
							<td align="left">Telefoon</td>
							<td align="left"><input name="telefoonnummer" type="text" id="telefoonnummer" size="15" maxlength="15" value="<?PHP echo $row_profile['telefoonnummer']?>" /></td>
						</tr>
						<tr>
							<td colspan="3">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="3">
								<div align="center">
								<input type="submit" name="Submit" value="Opslaan" />
								</div>
							</td>
						</tr>
					</table>
				</form>
			</td>
		</tr>
	</table>
<?PHP
			}
		}
#####################################################################################################################################	
		elseif ($i=="change_pass")
		{	
			if ($ii=="update_pass")
			{
				$rs_select_user= mysql_query("SELECT * FROM users WHERE user_id=".$_SESSION['user_id']);
				$row_user= mysql_fetch_array($rs_select_user);
				if ( md5($_POST['old_pass'])==$row_user['user_pass'] )
				{
					if ( ($_POST['pass']!="") && (md5($_POST['pass'])!=md5($_POST['passcheck'])) )
					{
						echo "<div align=\"center\"><span class='false_warning' ><strong>De wachtwoorden komen niet overeen.</strong></span></div>";
						echo '<META http-equiv="refresh" content="2;URL=?p='.$p.'&i=change_pass">';
					}
					else
					{
						if ($_POST['pass']!="")
						{
							$pass= md5($_POST['pass']);
						}
						else
						{
							$pass= $row_user['user_pass'];
						}

						mysql_query("UPDATE users SET user_pass='".$pass."' WHERE user_id=".$_SESSION['user_id']);
			
						echo "<div align=\"center\"><span class='true_warning' ><strong>Wachtwoord gewijzigd.</strong></span></div>";
	
						echo '<META http-equiv="refresh" content="2;URL=?p='.$p.'">';
					}
				}
				else
				{
					echo "<div align=\"center\"><span class='false_warning' ><strong>Het oude wachtwoord is niet goed ingevuld.</strong></span></div>";
					echo '<META http-equiv="refresh" content="2;URL=?p='.$p.'&i=change_pass">';
				}
			}
			else
			{
?>
	<form name="change_pass" action="?p=<?PHP echo $p?>&i=change_pass&ii=update_pass" method="post" onsubmit="return checkform_change_pass('change_pass')">
		<div align="center">
			<table width="45%">
				<tr>
					<td align="left">Oude Wachtwoord</td>
					<td><input type="password" name="old_pass"></td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
				<tr>
					<td align="left">Nieuwe Wachtwoord</td>
					<td><input type="password" name="pass"></td>
				</tr>
				<tr>
					<td align="left">Nieuwe Wachtwoord<br>Controle</td>
					<td><input type="password" name="passcheck"></td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" value="Wijzigen"></td>
				</tr>
			</table>
		</div>
	</form>
<?PHP
			}
		}
		else
		{
			echo "&nbsp;&nbsp;<a href='?p=".$p."&i=change_profile'>Pofiel wijzigen</a>";
			echo "<br><br>";
			echo "&nbsp;&nbsp;<a href='?p=".$p."&i=change_pass'>Wachtwoord wijzigen</a>";
		}
	}
	else
	{
		echo "<span class='false_warning' ><strong>U bent niet ingelogd.</strong></span>";
	}
?>