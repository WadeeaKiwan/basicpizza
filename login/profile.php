<?PHP
//======================================================================
// profile.php
// Weergave van profiel van gebruiker en gebruiker kan wijzigingen doen
// bestaat uit meerdere pagina's
// $i = paginanaam in URL $ii = subpagina 
// 
// 		change_profile 	= laat profiel pagina zien 
// 		update_profile  = wijzigingen pagina
// 		change_pass 	= mogelijkheid om wachtwoord te wijzigen
// 
//======================================================================
// 
// Laatste bijwerking : 17-04-2017
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
					mysql_query("UPDATE user_profiles SET aanhef='".$_POST['aanhef']."', voornaam='".test_input($_POST['voornaam'])."', achternaam='".test_input($_POST['achternaam'])."', straat='".test_input($_POST['straat'])."', huisnummer='".test_input($_POST['huisnummer'])."', postcode='".test_input($_POST['postcode'])."', woonplaats='".test_input($_POST['woonplaats'])."', telefoonnummer='".test_input($_POST['telefoonnummer'])."' WHERE user_id=".$user_id);

					echo "<span class='true_warning' >Profiel gewijzigd.</span>";
				}
				else
				{
					mysql_query("INSERT INTO `user_profiles` (`user_id`, `voornaam`, `achternaam`, `straat`, `huisnummer`, `postcode`, `woonplaats`, `telefoonnummer`, `aanhef`) 
						VALUES ('".$user_id."', '".test_input($_POST['voornaam'])."', '".test_input($_POST['achternaam'])."', '".test_input($_POST['straat'])."', '".test_input($_POST['huisnummer'])."', '".test_input($_POST['postcode'])."', '".test_input($_POST['woonplaats'])."', '".test_input($_POST['telefoonnummer'])."', '".test_input($_POST['aanhef'])."')");

					echo "<span class='true_warning' >Profiel toegevoegd.</span>";
				}

				//echo '<META http-equiv="refresh" content="2;URL=?p='.$p.'&i='.$i.'&user_id='.$user_id.'">';
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
	<h1>Persoonlijk profiel bewerken van: <?PHP echo $naam?></h1>
	
	<a class="wijzigen" href="?p=<?PHP echo $p?>">Ga terug</a>

		<form name="update_profile" method="post" action="?p=<?PHP echo $p?>&i=<?PHP echo $i?>&ii=update_profile&user_id=<?PHP echo $user_id?>" onsubmit="return checkform_update_profile('update_profile')">

			<div class="aanhef">
				<p>Aanhef</p>
				<div>
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
				</div>
			</div>
			
			<div>
				<label for="voornaam">Voornaam</label>
				<input name="voornaam" type="text" id="voornaam" size="25" maxlength="25" value="<?PHP echo $row_profile['voornaam']?>" />
			</div>
		
			<div>
				<label for="achternaam">Achternaam</label>
				<input name="achternaam" type="text" id="achternaam" size="25" maxlength="25" value="<?PHP echo $row_profile['achternaam']?>" />
			</div>

			<div>
				<label for="straat">Straatnaam</label>
				<input name="straat" type="text" id="straat" size="25" maxlength="25" value="<?PHP echo $row_profile['straat']?>" />
			</div>

			<div>
				<label for="huisnummer">Huisnummer</label>
				<input name="huisnummer" type="text" id="huisnummer" size="10" maxlength="10" value="<?PHP echo $row_profile['huisnummer']?>" />
			</div>

			<div>
				<label for="postcode">Postcode</label>
				<input name="postcode" type="text" id="postcode" size="10" maxlength="10" value="<?PHP echo $row_profile['postcode']?>" />
			</div>

			<div>
				<label for="woonplaats">Woonplaats</label>
				<input name="woonplaats" type="text" id="woonplaats" size="25" maxlength="25" value="<?PHP echo $row_profile['woonplaats']?>" />
			</div>

			<div>
				<label for="telefoonnummer">Telefoon</label>
				<input name="telefoonnummer" type="text" id="telefoonnummer" size="15" maxlength="15" value="<?PHP echo $row_profile['telefoonnummer']?>" />
			</div>

			<input type="submit" name="Submit" value="Opslaan" />
						
		</form>

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
						echo "<span class='false_warning'>De wachtwoorden komen niet overeen.</span>";
						echo '<META http-equiv="refresh" content="3;URL=?p='.$p.'&i=change_pass">';
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
			
						echo "<span class='true_warning'>Wachtwoord gewijzigd.</span>";
	
						//echo '<META http-equiv="refresh" content="2;URL=?p='.$p.'">';
					}
				}
				else
				{
					echo "<span class='false_warning' >Het oude wachtwoord is niet goed ingevuld.</span>";
					echo '<META http-equiv="refresh" content="3;URL=?p='.$p.'&i=change_pass">';
				}
			}
			else
			{
?>
	<h1>Wachtwoord wijzigen</h1>
	<form name="change_pass" action="?p=<?PHP echo $p?>&i=change_pass&ii=update_pass" method="post" onsubmit="return checkform_change_pass('change_pass')">
		
		<div>
			<label for="old_pass">Oud wachtwoord</label>
			<input type="password" name="old_pass" id="old_pass">
		</div>
		<div>
			<label for="pass">Nieuw wachtwoord</label>
			<input type="password" name="pass" id="pass">
		</div>
		<div>
			<label for="passcheck">Nieuw wachtwoord<br>Controle</label>
			<input type="password" name="passcheck" id="passcheck">
		</div>

		<input type="submit" value="Wijzigen">
		
	</form>
<?PHP
			}
		}
		else
		{
			echo "<h1>Profiel</h1>";
			echo "<div><a class='wijzigen' href='?p=".$p."&i=change_profile'>Profiel wijzigen</a>";
			echo "<a class='wijzigen' href='?p=".$p."&i=change_pass'>Wachtwoord wijzigen</a></div>";
		}
	}
	else
	{
		echo "<span class='false_warning' ><strong>U bent niet ingelogd.</strong></span>";
	}
?>