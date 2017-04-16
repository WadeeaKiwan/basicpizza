<h1>Bestellingen</h1>

<?PHP
	if (isset($_SESSION['loggedin']) AND $_SESSION['loggedin']==1)
	{
#####################################################################################################################################
		
		$user_id = $_SESSION['user_id'];
		
		if (!isset($_GET['order_id']))
		{
			$order_id = NULL;
		}
		else
		{
			$order_id = $_GET['order_id'];
		}
		
#####################################################################################################################################		
		if ($i=="view_bestelling")
		{
			
			$sql_select_user= mysql_query("SELECT * FROM `users` WHERE user_id='".$user_id."'");
			$row_user= mysql_fetch_array($sql_select_user);

			$sql_select_profile= mysql_query("SELECT * FROM `user_profiles` WHERE user_id='".$user_id."'");
			$row_profile= mysql_fetch_array($sql_select_profile);
			
			$sql_select_order= mysql_query("SELECT * FROM `order` WHERE order_id= '".$order_id."' ");
			$row_order= mysql_fetch_array($sql_select_order);
?>				
	<table>
		<tr>
           	<th>Klant gegevens</th>
	    <tr>
		<tr>
			<td>
			<?PHP
				echo $row_profile['voornaam']." ".$row_profile['achternaam']."<br>";
				echo $row_profile['straat']." ".$row_profile['huisnummer']."<br>";
				echo $row_profile['postcode']." ".$row_profile['woonplaats']."<br>";
				echo $row_profile['telefoonnummer']."<br>";
			?>
			</td>
		</tr>
	</table>

	<table>
		<tr>
           	<th>Betaal gegevens</th>
	    <tr>
		<tr>
			<td>Betaling</td>
			<td>
			<?PHP 
				if($row_order['betaling'] == 'c' ) 
				{
				echo "Contant";
				}
				elseif($row_order['betaling'] == 'p' ) 
				{
				echo "Pin";
				}
			?>
			</td>
		</tr>
		<tr>
			<td>Type bezorging</td>
			<td>
<?PHP 
				if($row_order['type_bezorging'] == 'a' ) 
				{
				echo "Afhalen";
				}
				elseif($row_order['type_bezorging'] == 'b' ) 
				{
				echo "Bezorging";
				}
?>
			</td>
		</tr>
		<tr>
			<td>Levermoment</td>
			<td><?PHP echo $row_order['levermoment'] ?></td>
		</tr>
	</table>

    <table>
       	<tr>
           	<th>Naam</th>
	        <th>Aantal</th>
            <th>Grootte</th>
    	    <th>Prijs</th>
    	    <th>Toeslag</th>
    		<th>TotaalPrijs</th>
		</tr>
<?PHP
			$totaal_prijs = '0';
			$sql_select_order_rule= mysql_query("SELECT * FROM `order_regel` where order_order_id=".$order_id."");
			WHILE ($row_order_rule= mysql_fetch_array($sql_select_order_rule))
			{
				$sql_select_prod= mysql_query("SELECT * FROM `producten` where product_id=".$row_order_rule['producten_product_id']."");
				$row_prod= mysql_fetch_array($sql_select_prod);
?>
		<tr>
      		<td>
            	<?PHP echo $row_prod['naam']; ?>
			</td>
      		<td>
            	<?PHP echo $row_order_rule['aantal']; ?>
			</td>
      		<td>
            	<?PHP echo $row_order_rule['grootte']; ?>
			</td>
      		<td>
            	<?PHP echo ShowCash($row_prod['prijs']); ?>
			</td>
      		<td>
<?PHP
				$toeslag = null;
        	    if($row_order_rule['grootte'] == 'm')
          	    {
					$toeslag = 2 * $row_order_rule['aantal'];
          	    	echo ShowCash($toeslag);
           	    }
           	    elseif($row_order_rule['grootte'] == 'l')
        	    {
					$toeslag = 4 * $row_order_rule['aantal'];
  	    	    	echo ShowCash($toeslag);
  	    	    }              	
?>      	          	
			</td>
      		<td>
<?PHP 
				$prijs = null;
				if($row_order_rule['grootte'] == 's')
          	    {
					$prijs = $row_prod['prijs'] * $row_order_rule['aantal'];
					$totaal_prijs = $totaal_prijs + $prijs;
					echo ShowCash($prijs);
          	    }
				elseif($row_order_rule['grootte'] == 'm')
        	    {
					$prijs = $row_prod['prijs'] * $row_order_rule['aantal'];
					$prijs = $prijs + $toeslag;
					$totaal_prijs = $totaal_prijs + $prijs;
					echo ShowCash($prijs);
          	    }
          	    elseif($row_order_rule['grootte'] == 'l')
           	    {
					$prijs = $row_prod['prijs'] * $row_order_rule['aantal'];
					$prijs = $prijs + $toeslag;
					$totaal_prijs = $totaal_prijs + $prijs;
					echo ShowCash($prijs);
           	    }    	    	    
?>
			</td>
		</tr>
<?PHP
			}
?>
		<tr>
            <th>TotaalPrijs</th>
    	    <td><?PHP echo ShowCash($totaal_prijs);  ?></td>
		</tr>
	</table>					
<?PHP
		}
#####################################################################################################################################
		else
		{
?>
    <table>
        <tr>
            <th>Bestelling</th>
            <th>Status</th>
        </tr>
<?PHP
		$sql_select_order= mysql_query("SELECT * FROM `order` WHERE users_user_id= ".$user_id." ORDER BY bestelmoment ASC");
		WHILE ($row_order= mysql_fetch_array($sql_select_order))
		{
?>
		<tr onclick="window.document.location='?p=<?PHP echo $p ?>&i=view_bestelling&order_id=<?PHP echo $row_order['order_id'] ?>';" onmouseover="this.style.cursor='pointer';" >
            <td>
                <?PHP echo $row_order['bestelmoment'] ?>
            </td>
            <td>
                <?PHP echo $row_order['order_status'] ?>
            </td>
        </tr>
<?PHP
		}
?>
	</table>

<?PHP

		}
	}
#####################################################################################################################################		
	else
	{
		echo "<span class='false_warning' >U bent niet ingelogd.</span>";
	}
?>