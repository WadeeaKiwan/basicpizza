<table width="450" border="0" cellpadding="2">
	<tr>
		<td colspan="2" align="center" ><u><h3>Winkelmand</h3></u></td>
	</tr>
</table>

<?PHP
	if (!isset($_GET['array_row']))
	{
		$array_row = NULL;
	}
	else
	{
		$array_row = $_GET['array_row'];
	}
#####################################################################################################################################
	if ($i=="update_best")
	{
		if($_POST['prod_aantal'] == NULL OR $_POST['prod_aantal'] == '0')
		{
  			unset($_SESSION['product_id'][$array_row]);
  			unset($_SESSION['prod_aantal'][$array_row]);
  			unset($_SESSION['prod_grootte'][$array_row]);  
		}
		else
		{
			$_SESSION['prod_aantal'][$array_row] = $_POST['prod_aantal'];
			$_SESSION['prod_grootte'][$array_row] = $_POST['prod_grootte'];
		}
		
		echo '<META http-equiv="refresh" content="0;URL=?p='.$p.'">';
	}
#####################################################################################################################################
	elseif ($i=="bestellen")
	{
		if (!isset($_SESSION['loggedin']) OR $_SESSION['loggedin']!=1)
		{
			include 'login/login.php';
		}
		else
		{
			if(isset($_SESSION['user_id']))
			{
				$user_id = $_SESSION['user_id'];
			}
		
			if ($ii=="betalen")
			{	
				mysql_query("INSERT INTO `order` (
					`type_bezorging`,
					`levermoment`,
					`betaling`,
					`users_user_id`,
					`order_status`
				) VALUES (
					'".$_POST['type_bezorging']."',
					'".$_POST['levermoment']."',
					'".$_POST['betaling']."',
					'".$_SESSION['user_id']."',
					'Betaald'
				)") or die(mysql_error());
				
				$sql_select_order= mysql_query("SELECT order_id FROM `order` ORDER BY order_id DESC LIMIT 1");
				$row_order= mysql_fetch_array($sql_select_order);
				
				foreach ($_SESSION['product_id'] as $key => $value)
				{
					mysql_query("INSERT INTO order_regel (
						`order_order_id`,
						`producten_product_id`,
						`order_user_id`,
						`aantal`,
						`grootte`
					) VALUES (
						'".$row_order['order_id']."',
						'".$_SESSION['product_id'][$key]."',
						'".$_SESSION['user_id']."',
						'".$_SESSION['prod_aantal'][$key]."',
						'".$_SESSION['prod_grootte'][$key]."'
					)");
				}
				
				unset($_SESSION['product_id']);
  				unset($_SESSION['prod_aantal']);
  				unset($_SESSION['prod_grootte']); 
				
				echo "<span class='true_warning' ><strong>U heeft betaald.</strong></span>";
				echo '<META http-equiv="refresh" content="2;URL=?p=">';
			}
			else
			{
				echo "BESTEL GEGEVENS<br>";
				
				$sql_select_user= mysql_query("SELECT * FROM `users` WHERE user_id='".$user_id."'");
				$row_user= mysql_fetch_array($sql_select_user);

				$sql_select_profile= mysql_query("SELECT * FROM `user_profiles` WHERE user_id='".$user_id."'");
				$row_profile= mysql_fetch_array($sql_select_profile);
?>				
				<form name="betalen" method="post" action="?p=<?PHP echo $p?>&i=<?PHP echo $i?>&ii=betalen">
					<table width="350" border="0" align="center">
						<tr>
							<td>
<?PHP
								echo $row_profile['voornaam']."".$row_profile['achternaam']."<br>";
								echo $row_profile['straat']."".$row_profile['huisnummer']."<br>";
								echo $row_profile['postcode']."".$row_profile['woonplaats']."<br>";
								echo $row_profile['telefoonnummer']."<br>";
?>
							</td>
							<td>
								<a href='?p=profile&i=change_profile'>Adres wijzigen</a>
							</td>
						</tr>
						<tr>
							<td align="left">Betaling</td>
							<td align="left">
								<select name="betaling" id="betaling">
									<option value='c'>Contant</option>
									<option value='p'>Pin</option>
								</select>
							</td>
						</tr>
						<tr>
							<td align="left">Type bezorging</td>
							<td align="left">
								<select name="type_bezorging" id="type_bezorging">
									<option value='a'>Afhalen</option>
									<option value='b'>Bezorging</option>
								</select>
							</td>
						</tr>
						<tr>
							<td align="left">Levermoment</td>
							<td align="left">
								<select name="levermoment" id="levermoment">
									<option value='16.30'>16:30</option>
									<option value='17.00'>17:00</option>
									<option value='17.30'>17:30</option>
									<option value='18.00'>18:00</option>
									<option value='18.30'>18:30</option>
									<option value='19.00'>19:00</option>
									<option value='19.30'>19:30</option>
									<option value='20.00'>20:00</option>
									<option value='20.30'>20:30</option>
									<option value='21.00'>21:00</option>
									<option value='21.30'>21:30</option>
									<option value='22.00'>22:00</option>
								</select>
							</td>
						</tr>
						<tr>
							<td colspan="3">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="3">
								<div align="center">
								<input type="submit" name="Submit" value="Betaal" />
								</div>
							</td>
						</tr>
					</table>
				</form>
<?PHP			
			}
		}
	}
#####################################################################################################################################
	else
	{
		if(isset($_SESSION['product_id']) AND isset($_SESSION['prod_grootte']) AND isset($_SESSION['prod_aantal']))
		{ 			
?>
	<div align="center">
    	<table border="1" cellspacing="0" width="650">
        	<tr>
            	<td class="custom_bgcollor" width="40%">
                	<strong>Naam</strong>
	            </td>
	            <td class="custom_bgcollor" width="5%">
    	            <strong>Aantal</strong>
        	    </td>
            	<td class="custom_bgcollor" width="10%">
                	<strong>Grootte</strong>
 	           </td>
    	        <td class="custom_bgcollor" width="20%">
        	        <strong>Prijs</strong>
            	</td>
    	        <td class="custom_bgcollor" width="20%">
        	        <strong>TotaalPrijs</strong>
            	</td>
    	        <td class="custom_bgcollor" width="5%">
        	        <strong>Bijwerken</strong>
            	</td>
			</tr>
<?PHP
			$totaal_prijs = '0';
			foreach ($_SESSION['product_id'] as $key => $value)
			{	
				$rs_select_cat= mysql_query("SELECT * FROM producten WHERE product_id=".$_SESSION['product_id'][$key]);
				$row_cat= mysql_fetch_array($rs_select_cat);
?>
			<form name="bestel_prod" id="bestel_prod" method="post" action="?p=<?PHP echo $p?>&i=update_best&array_row=<?PHP echo $key?>">
      			<tr>
         	   		<td>
            	    	<?PHP echo $row_cat['naam']; ?>
					</td>
		            <td>
		            	<input name="prod_aantal" type="text" id="prod_aantal" size="3" maxlength="2" value="<?PHP echo $_SESSION['prod_aantal'][$key]?>" />
        	    	</td>
            		<td>
		            	<select name="prod_grootte" id="prod_grootte">
		    			
<?PHP
							if($_SESSION['prod_grootte'][$key] == 's')
							{
								echo '<option value="s" selected>Small</option>';
								echo '<option value="m">Medium</option>';
								echo '<option value="l">Large</option>';
							}
							elseif($_SESSION['prod_grootte'][$key] == 'm')
							{
								echo '<option value="s">Small</option>';
								echo '<option value="m" selected>Medium</option>';
								echo '<option value="l">Large</option>';
							}
							elseif($_SESSION['prod_grootte'][$key] == 'l')
							{
								echo '<option value="s">Small</option>';
								echo '<option value="m">Medium</option>';
								echo '<option value="l" selected>Large</option>';
							}
?>		    			
						</select>
		            </td>
    	    	    <td>
<?PHP 
						
						$toeslag = null;
        	    	    echo ShowCash($row_cat['prijs']);
        	    	    if($_SESSION['prod_grootte'][$key] == 'm')
        	    	    {
							$toeslag = 2 * $_SESSION['prod_aantal'][$key];
        	    	    	echo " (+ ".ShowCash($toeslag).")";
        	    	    }
        	    	    elseif($_SESSION['prod_grootte'][$key] == 'l')
        	    	    {
							$toeslag = 4 * $_SESSION['prod_aantal'][$key];
        	    	    	echo " (+ ".ShowCash($toeslag).")";
        	    	    }    	    	    
?>
    	        	</td>
    	    	    <td>
<?PHP 
						$prijs = null;
						if($_SESSION['prod_grootte'][$key] == 's')
        	    	    {
							$prijs = $row_cat['prijs'] * $_SESSION['prod_aantal'][$key];
							$totaal_prijs = $totaal_prijs + $prijs;
							echo ShowCash($prijs);
        	    	    }
						elseif($_SESSION['prod_grootte'][$key] == 'm')
        	    	    {
							$prijs = $row_cat['prijs'] * $_SESSION['prod_aantal'][$key];
							$prijs = $prijs + $toeslag;
							$totaal_prijs = $totaal_prijs + $prijs;
							echo ShowCash($prijs);
        	    	    }
        	    	    elseif($_SESSION['prod_grootte'][$key] == 'l')
        	    	    {
							$prijs = $row_cat['prijs'] * $_SESSION['prod_aantal'][$key];
							$prijs = $prijs + $toeslag;
							$totaal_prijs = $totaal_prijs + $prijs;
							echo ShowCash($prijs);
        	    	    }    	    	    
?>
    	        	</td>
	    	        <td align="center">
	    	        	<input type="submit" name="Submit" value="Werk Bij" />
            		</td>
				</tr>
    	  	  
			</form>
<?PHP
			}
?>
			<tr>
            	<td class="custom_bgcollor" width="75%" colspan="4" align="right">
                	<strong>TotaalPrijs</strong>
	            </td>
    	        <td class="custom_bgcollor" width="20%">
        	        <strong><?PHP echo ShowCash($totaal_prijs);  ?></strong>
            	</td>
    	        <td class="custom_bgcollor" width="5%">
        	        <form name="bestel_prod" id="bestel_prod" method="post" action="?p=<?PHP echo $p?>&i=bestellen">
        	        	<input type="submit" name="Submit" value="BESTEL" />
        	        </form>
            	</td>
			</tr>
		</table>
	</div>
<?PHP
		}
#####################################################################################################################################
		else
		{
?>
<div align="center">
	<table border="0" cellspacing="0" width="450">
		<tr>
			<td align="center">
				<span class='true_warning' ><strong>Winkelmand is leeg.</strong></span>
			</td>
		</tr>
	</table>
</div>
<?PHP
		}
	}
#####################################################################################################################################
?>