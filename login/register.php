<?PHP
//======================================================================
// register.php
// Registratie pagina aanmaken van gebruikersaccount
// 
//======================================================================
// 
// Laatste bijwerking : 17-04-2017

include 'jscripts/checkform/users_checkform.js';

#############################################################################################################################
		if ($i=="register")
		{
		
			$rs_select_user= mysql_query("SELECT user_id FROM users WHERE user_login='".$_POST['email']."'");
			if (mysql_num_rows($rs_select_user)>0)
			{
				echo "<span class='false_warning' >Het E-Mail adres is al in gebruik.</span>";
				echo '<META http-equiv="refresh" content="2;URL=?p='.$p.'">';
			}
			elseif( ($_POST['email']=="") || ($_POST['pass']=="") || ($_POST['passcheck']=="") )
			{
				echo "<span class='false_warning' >Een van de velden is niet ingevuld.</span>";
				echo '<META http-equiv="refresh" content="2;URL=?p='.$p.'">';
			}
			elseif (md5($_POST['pass'])!=md5($_POST['passcheck']))
			{
				echo "<span class='false_warning' >De wachtwoorden komen niet overeen.</span>";
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
					'".test_input($row_user['user_id'])."', 
					'".test_input($_POST['voornaam'])."', 
					'".test_input($_POST['achternaam'])."', 
					'".test_input($_POST['straat'])."', 
					'".test_input($_POST['huisnummer'])."', 
					'".test_input($_POST['postcode'])."', 
					'".test_input($_POST['woonplaats'])."', 
					'".test_input($_POST['telefoonnummer'])."', 
					'".test_input($_POST['aanhef'])."')
				");
# test_input zorgt voor een extra validatie op geldige invoer.
				echo "<span class='true_warning' >Profiel toegevoegd.</span>";
				//echo '<META http-equiv="refresh" content="2;URL=?p='.$p.'">';
			
			}
		}
#############################################################################################################################
		else
		{
?>
	<h1>Registreren</h1>
	
		<form name="register" method="post" action="?p=<?PHP echo $p?>&i=register" onsubmit="return checkform_register('register')">
				<div class="aanhef">
					<p>Aanhef</p>
					<div>
						<label><input type="radio" name="aanhef" checked="checked" value="Dhr." />Dhr.</label>
						<label><input type="radio" name="aanhef" value="Mevr." />Mevr.</label>
					</div>
				</div>
				<div>
					<label for="voornaam">Voornaam *</label>
					<input name="voornaam" type="text" id="voornaam" size="25" maxlength="40" required />
				</div>
				<div>
					<label for="achternaam">Achternaam *</label>
					<input name="achternaam" type="text" id="achternaam" size="25" maxlength="40" />
				</div>
				<div>
					<label for="straat">Straatnaam *</label>
					<input name="straat" type="text" id="straat" size="25" maxlength="25" required />
				</div>
				<div>
					<label for="huisnummer">Huisnummer *</label>
					<input name="huisnummer" type="text" id="huisnummer" size="10" maxlength="5" required/>
				</div>
				<div>
					<label for="postcode">Postcode *</label>
					<input name="postcode" type="text" id="postcode" size="10" maxlength="6" required />
				</div>
				<div>
					<label for="woonplaats">Woonplaats *</label>
					<input name="woonplaats" type="text" id="woonplaats" size="25" maxlength="25" required />
                    <td> <?php echo "let op: alleen in Groningen wordt bezorgd"?></td>
				</div>
				<div>
					<label for="email">E-Mail *</label>
					<input name="email" type="text" id="email" size="25" maxlength="100" required/>
				</div>
				<div>
					<label for="telefoonnummer">Telefoon *</label>
					<input name="telefoonnummer" type="text" id="telefoonnummer" size="10" maxlength="15" required />
				</div>
				<div>
					<label for="pass">Wachtwoord *</label>
					<input type="password" name="pass" maxlength="25" required />
				</div>
				<div>
					<label for="passcheck">Wachtwoord controle *</label>		
					<input type="password" name="passcheck" maxlength="25" required />
				</div>

				<input type="submit" name="Submit" value="Opslaan" />

		</form>

<?PHP
#############################################################################################################################
}
?>