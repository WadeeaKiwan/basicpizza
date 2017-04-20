<?PHP
	if (!isset($_SESSION['level']) OR  $_SESSION['level'] >=5)
	{
?>
<h1>Bestellingen</h1>
<?PHP
#####################################################################################################################################
		
		$t= time();
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
			$sql_select_order= mysql_query("SELECT * FROM `order` WHERE order_id= '".$order_id."' ");
			$row_order= mysql_fetch_array($sql_select_order);
			
			$sql_select_user= mysql_query("SELECT * FROM `users` WHERE user_id='".$row_order['users_user_id']."'");
			$row_user= mysql_fetch_array($sql_select_user);

			$sql_select_profile= mysql_query("SELECT * FROM `user_profiles` WHERE user_id='".$row_order['users_user_id']."'");
			$row_profile= mysql_fetch_array($sql_select_profile);
			
?>	
	<h3>Klant gegevens</h3>		
	<table>
		<tr>
			<td>
<?PHP
				echo $row_profile['voornaam']." ".$row_profile['achternaam']."<br>";
				echo $row_profile['straat']."  ".$row_profile['huisnummer']."<br>";
				echo $row_profile['postcode']." ".$row_profile['woonplaats']."<br>";
				echo $row_profile['telefoonnummer']."<br>";
?>
			</td>
		</tr>
	</table>

	<h3>Betaal gegevens</h3>
	<table>
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
			<td>gewenste levering</td>
			<td><?PHP echo $row_order['levermoment'] ?></td>
		</tr>
        <tr>
			<td>werkelijke levering</td>
			<td><?PHP echo $row_order['levering'] ?></td>
		</tr>
	</table>
	<br><br>
    <table>
       	<tr>
           	<th>Naam</th>
	        <th>Aantal</th>
            <th>Grootte</th>
    	    <td>Prijs</th>
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
					$toeslag = 200 * $row_order_rule['aantal'];
          	    	echo ShowCash($toeslag);
           	    }
           	    elseif($row_order_rule['grootte'] == 'l')
        	    {
					$toeslag = 400 * $row_order_rule['aantal'];
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
            <td width="75%" colspan="5" align="right">
                <strong>TotaalPrijs</strong>
	        </td>
    	    <td width="20%">
        	    <strong><?PHP echo ShowCash($totaal_prijs);  ?></strong>
            </td>
		</tr>
	</table>					
<?PHP
		}
#####################################################################################################################################		
		elseif ($i=="betaald")
		{
			mysql_query("UPDATE `order` SET order_status='Afgeleverd' WHERE order_id=".$order_id);
            
            mysql_query("UPDATE `order` SET levering= current_timestamp WHERE order_id=".$order_id);
            
            
			echo '<META http-equiv="refresh" content="0;URL=?p='.$p.'">';
          	
				
		}
#####################################################################################################################################
		else
		{
?>
<h3>Nog niet afgeleverde Pizzas</h3>

    <table>
        <tr>
            <th>Bestelling</th>
            <th>Gewenste Levering</th>
            <th>Ordernummer</th>
            <th>Type aflevering</th>
            <th>Betaald?</th>
            <th>Status Bestelling</th>
        </tr>
<?PHP
		$sql_select_order= mysql_query("SELECT * FROM `order` WHERE order_status='Betaald' ORDER BY bestelmoment desc");
		WHILE ($row_order= mysql_fetch_array($sql_select_order))
		{
?>
		<tr onclick="window.document.location='?p=<?PHP echo $p ?>&i=view_bestelling&order_id=<?PHP echo $row_order['order_id'] ?>';" onmouseover="this.style.cursor='pointer';">
            <td>
            	<a href='?p=<?PHP echo $p ?>&i=view_bestelling&order_id=<?PHP echo $row_order['order_id'] ?>'>Bekijk bestelling</a>
            </td>
            <td>
                <?PHP echo $row_order['levermoment'] ?>
            </td>
             <td>
                <?PHP echo $row_order['order_id'] ?>
            </td>
            <td>
                <?PHP 
                	$type_bezorging = $row_order['type_bezorging'];
                	if($type_bezorging=="a"){
                		echo "Afhalen";
                	} else {
                		echo "Bezorging";
                	}
                ?>
            </td>
            <td>
                <?PHP 
         $type_betaling = $row_order['betaling'];
         if($type_betaling=="c")
         {
             echo "contant";
         } else {
             echo "pin";
         } ?>
            </td>
            <td>
				<a href="?p=<?PHP echo $p?>&i=betaald&order_id=<?PHP echo $row_order['order_id']?>">Zet order op afgeleverd</a>
			</td>
        </tr>
<?PHP
		}
?>
	</table>

	<h3>Afgeleverde Pizzas</h3>
    <table>
        <tr>
        	<th>Bestelling</th>
            <th>Ordernummer</th>
            <th>Gewenste levertijd</th>
            <th>Werkelijke levertijd</th>
            <th>Status</th>
            <th>On-Time (difference in minutes)</th>
        </tr>
<?PHP
		$sql_select_order= mysql_query("SELECT * FROM `order` WHERE order_status='Afgeleverd' ORDER BY order_id desc");
		WHILE ($row_order= mysql_fetch_array($sql_select_order))
		{
?>
		<tr onclick="window.document.location='?p=<?PHP echo $p ?>&i=view_bestelling&order_id=<?PHP echo $row_order['order_id'] ?>';" onmouseover="this.style.cursor='pointer';" >
            <td>
            	<a href='?p=<?PHP echo $p ?>&i=view_bestelling&order_id=<?PHP echo $row_order['order_id'] ?>'>Bekijk bestelling</a>
            </td>
            <td>
                <?PHP echo $row_order['order_id'] ?>
            </td>
            <td>
                <?PHP echo $row_order['levermoment'] ?>
            </td>
            <td>
                <?PHP echo $row_order['levering'] ?>
            </td>
            <td>
                <?PHP echo $row_order['order_status'] ?>
            </td>
            
          	<td>
            
              <?PHP
###################################################################################################################################			  
            $timelevering = substr($row_order['levering'],-8,5);
            $timegewenst =substr($row_order['levermoment'],-8,5);
            $timeleveringA=strtotime($timelevering);
            $timegewenstA=strtotime($timegewenst);
            $diff= ($timeleveringA-$timegewenstA)/60;
			echo $diff;
###################################################################################################################################		 
              ?>
              
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
		if (!$_SESSION['level'])
		{

			if (!$_SESSION['level'])
			{
				include 'login/login.php';
				exit;
			}
		}
		else
		{
			echo "<span class='false_warning' ><strong>Onvoldoende rechten.</strong></span>";
		}
	}
?>	