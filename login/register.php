<?PHP

include 'jscripts/checkform/users_checkform.js';

#####################################################################################################################################
		if ($i=="register")
		{
		
			$rs_select_user= mysql_query("SELECT user_id FROM users WHERE user_login='".$_POST['email']."'");
			if (mysql_num_rows($rs_select_user)>0)
			{
				echo "<span class='false_warning' ><strong>Het E-Mail adres is al in gebruik.</strong></span>";
				echo '<META http-equiv="refresh" content="2;URL=?p='.$p.'">';
			}
			elseif( ($_POST['email']=="") || ($_POST['pass']=="") || ($_POST['passcheck']=="") )
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
				mysql_query("INSERT INTO users (
					user_login,
					user_pass,
					user_level
				) 
				VALUES (
					'".$_POST['email']."',
					'".md5($_POST['pass'])."',
					'1')
				");
			}
			
			$sql_select_user= mysql_query("SELECT user_id FROM `users` WHERE user_login='".$_POST['email']."'");
			$row_user= mysql_fetch_array($sql_select_user);
			
		
			mysql_query("INSERT INTO `user_profiles` (
				`user_id`, 
				`voornaam`, 
				`achternaam`, 
				`straat`, 
				`huisnummer`, 
				`postcode`, 
				`woonplaats`, 
				`telefoonnummer`, 
				`aanhef`
			)
			VALUES (
				'".$row_user['user_id']."', 
				'".$_POST['voornaam']."', 
				'".$_POST['achternaam']."', 
				'".$_POST['straat']."', 
				'".$_POST['huisnummer']."', 
				'".$_POST['postcode']."', 
				'".$_POST['woonplaats']."', 
				'".$_POST['telefoonnummer']."', 
				'".$_POST['aanhef']."')
			");

			echo "<span class='true_warning' ><strong>Profiel toegevoegd.</strong></span>";
			echo '<META http-equiv="refresh" content="2;URL=?p='.$p.'">';
		}
#####################################################################################################################################
		else
		{
?>
	<table>
		<tr>
			<td>
				<form name="register" method="post" action="?p=<?PHP echo $p?>&i=register" onsubmit="return checkform_register('register')">
					<table width="100%" border="0" align="center">
						<tr>
							<td align="right" width="5%">*</td>
							<td align="left" width="35%">Aanhef</td>
							<td align="left" width="60%">
								<p>
								<label><input type="radio" name="aanhef" checked="checked" value="Dhr." />Dhr.</label>
								<label><input type="radio" name="aanhef" value="Mevr." />Mevr.</label>
								</p>
							</td>
						</tr>
						<tr>
							<td align="right">*</td>
							<td align="left">Voornaam</td>
							<td align="left"><input name="voornaam" type="text" id="voornaam" size="25" maxlength="25" /></td>
						</tr>
						<tr>
							<td align="right">*</td>
							<td align="left">Achternaam</td>
							<td align="left"><input name="achternaam" type="text" id="achternaam" size="25" maxlength="25" /></td>
						</tr>
						<tr>
							<td align="right">*</td>
							<td align="left">Straatnaam</td>
							<td align="left"><input name="straat" type="text" id="straat" size="25" maxlength="25" /></td>
						</tr>
						<tr>
							<td align="right">*</td>
							<td align="left">Huisnummer</td>
							<td align="left"><input name="huisnummer" type="text" id="huisnummer" size="10" maxlength="10" /></td>
						</tr>
						<tr>
							<td align="right">*</td>
							<td align="left">Postcode</td>
							<td align="left"><input name="postcode" type="text" id="postcode" size="10" maxlength="10" /></td>
						</tr>
						<tr>
							<td align="right">*</td>
							<td align="left">Woonplaats</td>
							<td align="left"><input name="woonplaats" type="text" id="woonplaats" size="25" maxlength="25" /></td>
						</tr>
						<tr>
							<td align="right">*</td>
							<td align="left">E-Mail</td>
							<td align="left"><input name="email" type="text" id="email" size="15" maxlength="50" /></td>
						</tr>
						<tr>
							<td align="right">*</td>
							<td align="left">Telefoon</td>
							<td align="left"><input name="telefoonnummer" type="text" id="telefoonnummer" size="15" maxlength="15" /></td>
						</tr>
						<tr>
							<td align="right">*</td>
							<td align="left">Wachtwoord</td>
							<td><input type="password" name="pass"></td>
						</tr>
						<tr>
							<td align="right">*</td>
							<td align="left">Wachtwoord controle</td>		
							<td><input type="password" name="passcheck"></td>
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
#####################################################################################################################################
}
?>