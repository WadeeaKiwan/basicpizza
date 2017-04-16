<?PHP

if (isset($_SESSION['level']) AND $_SESSION['level']>=5)
{
	include 'jscripts/checkform/admin_users_checkform.js';
	
	if (!isset($_GET['user_id']))
	{
		$user_id = NULL;
	}
	else
	{
		$user_id = $_GET['user_id'];
	}
	
#####################################################################################################################################
		if ($i=="add")
		{
			$rs_select_user= mysql_query("SELECT user_id FROM users WHERE user_login='".$_POST['login']."'");
			if (mysql_num_rows($rs_select_user)>0)
			{
				echo "<span class='false_warning' ><strong>Gebruikersnaam is al in gebruik.</strong></span>";
				echo '<META http-equiv="refresh" content="2;URL=?p='.$p.'">';
			}
			elseif( ($_POST['login']=="") || ($_POST['pass']=="") || ($_POST['passcheck']=="") )
			{
				echo "<span class='false_warning' ><strong>Een van de velden is niet ingevuld.</strong></span>";
				echo '<META http-equiv="refresh" content="2;URL=?p='.$p.'">';
			}
			elseif (md5($_POST['pass'])!=md5($_POST['passcheck']))
			{
				echo "<span class='false_warning' ><strong>De wachtwoorden komen niet overeen.</strong></span>";
				echo '<META http-equiv="refresh" content="2;URL=?p='.$p.'">';
			}
			else
			{
				mysql_query("INSERT INTO users (user_login, user_pass, user_level) VALUES ('".$_POST['login']."', '".md5($_POST['pass'])."', '".$_POST['level']."')");

				echo "<span class='true_warning' ><strong>Account toegevoegd.</strong></span>";

				echo '<META http-equiv="refresh" content="2;URL=?p='.$p.'">';
			}
		}
#####################################################################################################################################
		elseif ($i=="del")
		{
			mysql_query("DELETE FROM users WHERE user_id=".$user_id);
			mysql_query("DELETE FROM user_profiles WHERE user_id=".$user_id);
			mysql_query("DELETE FROM user_days WHERE user_id=".$user_id);

			echo "<span class='true_warning' ><strong>Account verwijderd.</strong></span>";
				
			echo '<META http-equiv="refresh" content="1;URL=?p='.$p.'">';
		}
#####################################################################################################################################
		elseif ($i=="edit_user")
		{		
			if($ii=="change")
			{	
				$rs_select_user= mysql_query("SELECT * FROM users WHERE user_id=".$user_id);
				$row_user= mysql_fetch_array($rs_select_user);

				if ( ($_POST['pass']!="") && (md5($_POST['pass'])!=md5($_POST['passcheck'])) )
				{
					echo "<span class='false_warning' ><strong>De wachtwoorden komen niet overeen.</strong></span>";

					echo '<META http-equiv="refresh" content="2;URL=?p='.$p.'&i=edit_user&user_id='.$row_user['user_id'].'">';
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

					mysql_query("UPDATE users SET user_level='".$_POST['level']."', user_pass='".$pass."' WHERE user_id=".$user_id);

					echo "<span class='true_warning' ><strong>Account gewijzigd.</strong></span>";

					echo '<META http-equiv="refresh" content="2;URL=?p='.$p.'">';
				}
			}
			else
			{
				$rs_select_user= mysql_query("SELECT * FROM users WHERE user_id=".$user_id);
				$row_user= mysql_fetch_array($rs_select_user);
?>
	<table>
		<tr>
			<td colspan="5" align="center"><h3>Account wijzigen van: <?PHP echo $row_user['user_login']?>.</h3></td>
		</tr>
		<tr>
			<td><strong>Gebruikersnaam</strong></td>
			<td><strong>Wachtwoord</strong></td>
			<td><strong>Wachtwoord controle</strong></td>
			<td><strong>Level</strong></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<form name="change_pass" method="post" action="?p=<?PHP echo $p?>&i=edit_user&ii=change&user_id=<?PHP echo $row_user['user_id']?>" onsubmit="return checkform_change_pass('change_pass')">
				<td><?PHP echo $row_user['user_login']?></td>
				<td><input type="password" id="pass" name="pass"></td>
				<td><input type="password" id="passcheck" name="passcheck"></td>
				<td>
					<select name="level" id="level">
						<option value='1'>(1) Klant</option>
						<option value='5'>(5) Admin</option>
					</select>
				</td>
				<td><input type="submit"value="Wijzigen"></td>
			</form>
		</tr>
	</table>
<?PHP
			}
		}
#####################################################################################################################################
		elseif ($i=="profile")
		{
			if ($ii=="update_profile")
			{	
				$rs_select_profile= mysql_query("SELECT * FROM user_profiles WHERE user_id=".$user_id);

				if (mysql_num_rows($rs_select_profile))
				{
					mysql_query("UPDATE user_profiles SET aanhef='".Escape($_POST['aanhef'])."', voornaam='".Escape($_POST['voornaam'])."', achternaam='".Escape($_POST['achternaam'])."', straat='".Escape($_POST['straat'])."', huisnummer='".Escape($_POST['huisnummer'])."', postcode='".Escape($_POST['postcode'])."', woonplaats='".Escape($_POST['woonplaats'])."', telefoonnummer='".Escape($_POST['telefoonnummer'])."' WHERE user_id=".$user_id);

					echo "<span class='true_warning' ><strong>Profiel gewijzigd.</strong></span>";
				}
				else
				{
					mysql_query("INSERT INTO `user_profiles` (`user_id`, `voornaam`, `achternaam`, `straat`, `huisnummer`, `postcode`, `woonplaats`, `telefoonnummer`, `aanhef`) VALUES ('".$user_id."', '".Escape($_POST['voornaam'])."', '".Escape($_POST['achternaam'])."', '".Escape($_POST['straat'])."', '".Escape($_POST['huisnummer'])."', '".Escape($_POST['postcode'])."', '".Escape($_POST['woonplaats'])."', '".Escape($_POST['telefoonnummer'])."', '".Escape($_POST['aanhef'])."')");

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
		else
		{
?>
	<table>
		<tr>
			<td colspan="5" align="center"><h3>Nieuw account</h3></td>
		</tr>
		<tr>
			<td><strong>Gebruikersnaam</strong></td>
			<td><strong>Wachtwoord</strong></td>
			<td><strong>Wachtwoord controle</strong></td>
			<td><strong>Level</strong></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<form name="create_user" action="?p=<?PHP echo $p?>&i=add" method="post" onsubmit="return checkform_create_user('create_user')">
				<td><input type="text" name="login"></td>
				<td><input type="password" name="pass"></td>
				<td><input type="password" name="passcheck"></td>
				<td>
					<select name="level" id="level">
						<option value='1'>(1) Klant</option>
						<option value='5'>(5) Admin</option>
					</select>
				</td>
				<td><input type="submit" value="Toevoegen"></td>
			</form>
		</tr>
	</table>
	<br /><br />
<?PHP
?>
	<div align="center">
		<h3>Accounts</h3>
	</div>
	<table width="75%" border="1" cellspacing="0">
		<tr>
			<td class="custom_bgcollor"><strong>Gebruikersnaam</strong></td>
			<td class="custom_bgcollor"><strong>Level</strong></td>
			<td class="custom_bgcollor"><strong>Laatste login</strong></td>
			<td class="custom_bgcollor"><strong>Profiel</strong></td>
			<td class="custom_bgcollor"><strong>&nbsp;</strong></td>
		</tr>
<?PHP
			$rs_select_users= mysql_query("SELECT * FROM `users` WHERE user_level<=".$_SESSION['level']." ORDER BY user_level DESC");
			while ($row_users=mysql_fetch_array($rs_select_users))
			{
				$date_time= split(" ", $row_users['user_lastlogin']);

				$level= ($row_users['user_level']);
?>
		<tr>
			<td><?PHP echo $row_users['user_login']?>&nbsp;</td>
			<td><?PHP if($level=='1'){echo "(1) Klant";} else{echo "(5) Admin";}?></td>
			<td><?PHP echo SwitchDate($date_time[0])."&nbsp;&nbsp;&nbsp;".$date_time[1]?></td>
			<td><a href="?p=<?PHP echo $p?>&i=profile&user_id=<?PHP echo $row_users['user_id']?>">Profiel</a></td>
			<td>
				<a href="?p=<?PHP echo $p?>&i=edit_user&user_id=<?PHP echo $row_users['user_id']?>"><img src="../img/edit.png" border="0" alt="Account bewerken"></a>
				&nbsp;&nbsp;&nbsp;
				<a onclick="return confirm('LET OP: Weet u zeker dat u het account wilt verwijderen ? U verwijderd hiermee al zijn gegevens!')" href="?p=<?PHP echo $p?>&i=del&user_id=<?PHP echo $row_users['user_id']?>"><img src="../img/del.png" border="0" alt="Account verwijderen"></a>
			</td>
		</tr>
<?PHP
			}
?>
	</table>
<?PHP
		}
#####################################################################################################################################
}
else
{
	echo "<span class='false_warning' ><strong>Onvoldoende rechten.</strong></span>";
}
?>