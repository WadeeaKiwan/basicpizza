<?PHP
	if (!isset($_SESSION['level']) OR  $_SESSION['level'] >=5)
	{
?>
<table width="450" border="0" cellpadding="2">
	<tr>
		<td colspan="2" align="center" ><u><h3>Bestelling</h3></u></td>
	</tr>
</table>
<?PHP
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
			$sql_select_order= mysql_query("SELECT * FROM `order` WHERE order_id= '".$order_id."' ");
			$row_order= mysql_fetch_array($sql_select_order);
			
			$sql_select_user= mysql_query("SELECT * FROM `users` WHERE user_id='".$row_order['users_user_id']."'");
			$row_user= mysql_fetch_array($sql_select_user);

			$sql_select_profile= mysql_query("SELECT * FROM `user_profiles` WHERE user_id='".$row_order['users_user_id']."'");
			$row_profile= mysql_fetch_array($sql_select_profile);
			
?>				
	<table width="350" border="1" cellspacing="0" align="center">
		<tr>
           	<td class="custom_bgcollor">
               	<strong>Klant gegevens</strong>
	        </td>
	    <tr>
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
	<br><br>
	<table width="350" border="1" cellspacing="0" align="center">
		<tr>
           	<td class="custom_bgcollor" colspan='2'>
               	<strong>Betaal gegevens</strong>
	        </td>
	    <tr>
		<tr>
			<td align="left">Betaling</td>
			<td align="left">
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
			<td align="left">Type bezorging</td>
			<td align="left">
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
			<td align="left">Levermoment</td>
			<td align="left"><?PHP echo $row_order['levermoment'] ?></td>
		</tr>
	</table>
	<br><br>
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
            	<strong>Toeslag</strong>
    		</td>
    		<td class="custom_bgcollor" width="20%">
    			<strong>TotaalPrijs</strong>
            </td>
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
            <td class="custom_bgcollor" width="75%" colspan="5" align="right">
                <strong>TotaalPrijs</strong>
	        </td>
    	    <td class="custom_bgcollor" width="20%">
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
			
			echo '<META http-equiv="refresh" content="0;URL=?p='.$p.'">';
		}
#####################################################################################################################################
		else
		{
?>
<div align="center">
    <table border="1" cellspacing="0" width="450">
    	<tr>
    		<td class="custom_bgcollor" align="center" colspan='3'>
                <strong>Nog niet afgeleverde Pizzas</strong>
    		</td>
    	</tr>
        <tr>
            <td class="custom_bgcollor">
                <strong>Gewenste Levering</strong>
            </td>
            <td class="custom_bgcollor">
                <strong>Order_ID</strong>
            </td>
            <td class="custom_bgcollor">
                <strong>Betaald?</strong>
            </td>
            <td class="custom_bgcollor">
                <strong>Status Bestelling</strong>
            </td>
        </tr>
<?PHP
		$sql_select_order= mysql_query("SELECT * FROM `order` WHERE order_status='Betaald' ORDER BY bestelmoment ASC");
		WHILE ($row_order= mysql_fetch_array($sql_select_order))
		{
?>
		<tr>
            <td align="center" onclick="window.document.location='?p=<?PHP echo $p ?>&i=view_bestelling&order_id=<?PHP echo $row_order['order_id'] ?>';" onmouseover="this.style.cursor='pointer';" >
                <?PHP echo $row_order['levermoment'] ?>
            </td>
             <td align="center" onclick="window.document.location='?p=<?PHP echo $p ?>&i=view_bestelling&order_id=<?PHP echo $row_order['order_id'] ?>';" onmouseover="this.style.cursor='pointer';" >
                <?PHP echo $row_order['order_id'] ?>
            </td>
            <td align="center" onclick="window.document.location='?p=<?PHP echo $p ?>&i=view_bestelling&order_id=<?PHP echo $row_order['order_id'] ?>';" onmouseover="this.style.cursor='pointer';" >
                <?PHP echo $row_order['order_status'] ?>
            </td>
            <td align="center">
				 <a href="?p=<?PHP echo $p?>&i=betaald&order_id=<?PHP echo $row_order['order_id']?>">Afgeleverd</a>
			</td>
        </tr>
<?PHP
		}
?>
	</table>
	<br><br>
    <table border="1" cellspacing="0" width="450">
    	<tr>
    		<td class="custom_bgcollor" align="center" colspan='3'>
                <strong>Afgeleverde Pizzas</strong>
    		</td>
    	</tr>
        <tr>
            <td class="custom_bgcollor">
                <strong>Bestelling</strong>
            </td>
            <td class="custom_bgcollor">
                <strong>Status</strong>
            </td>
        </tr>
<?PHP
		$sql_select_order= mysql_query("SELECT * FROM `order` WHERE order_status='Afgeleverd' ORDER BY bestelmoment ASC");
		WHILE ($row_order= mysql_fetch_array($sql_select_order))
		{
?>
		<tr onclick="window.document.location='?p=<?PHP echo $p ?>&i=view_bestelling&order_id=<?PHP echo $row_order['order_id'] ?>';" onmouseover="this.style.cursor='pointer';" >
            <td align="center">
                <?PHP echo $row_order['bestelmoment'] ?>
            </td>
            <td align="center">
                <?PHP echo $row_order['order_status'] ?>
            </td>
        </tr>
<?PHP
		}
?>
	</table>
</div>
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