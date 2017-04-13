<h3>Pizzas</h3>

</table>

<?PHP

	if (!isset($_GET['product_id']))
	{
		$product_id = NULL;
	}
	else
	{
		$product_id = $_GET['product_id'];
	}

#####################################################################################################################################
	if ($i=="add_to_cart")
	{
		
		if(!isset($_SESSION['product_id']) OR !isset($_SESSION['prod_grootte']) OR !isset($_SESSION['prod_aantal']))
		{
			$_SESSION['product_id']=array();
			$_SESSION['prod_grootte']=array();	
			$_SESSION['prod_aantal']=array();
		}
		
		$al_in_winkelmand = '0';
		foreach ($_SESSION['product_id'] as $key => $value)
		{	
			if($value == $product_id AND $_SESSION['prod_grootte'][$key] == $_POST['prod_grootte'] )
			{
				$al_in_winkelmand ++;
			}
		}
			
		if($al_in_winkelmand > '0')
		{
			foreach ($_SESSION['product_id'] as $key => $value)
			{	
				if($value == $product_id AND $_SESSION['prod_grootte'][$key] )
				{
					$waarde = $_SESSION['prod_aantal'][$key] + $_POST['prod_aantal'];
					$_SESSION['prod_aantal'][$key] = $waarde;
				}
			}
				
			echo "<span class='true_warning' ><strong>Pizza toegevoegd aan winkelmand.</strong></span>";
		}
		else
		{
			array_push($_SESSION['product_id'], $product_id);
			array_push($_SESSION['prod_aantal'], $_POST['prod_aantal']);
			array_push($_SESSION['prod_grootte'], $_POST['prod_grootte']);
				
			echo "<span class='true_warning' ><strong>Pizza toegevoegd aan winkelmand.</strong></span>";
		}
		
		echo '<META http-equiv="refresh" content="2;URL=?p='.$p.'">';

	}
#####################################################################################################################################
	elseif ($i=="bestel_prod")
	{
		$sql_select_prod= mysql_query("SELECT * FROM `producten` WHERE product_id = ".$product_id." ");
		$row_prod= mysql_fetch_array($sql_select_prod);
?>

<form name="bestel_prod" id="bestel_prod" method="post" action="?p=<?PHP echo $p?>&i=add_to_cart&product_id=<?PHP echo $row_prod['product_id']?>">
	<div align="center">
    	<table border="1" cellspacing="0" width="450">
        	<tr>
            	<td class="custom_bgcollor" width="50%">
                	<strong>Naam</strong>
	            </td>
    	        <td class="custom_bgcollor" width="20%">
        	        <strong>Prijs</strong>
            	</td>
	            <td class="custom_bgcollor" width="15%">
    	            <strong>Aantal</strong>
        	    </td>
            	<td class="custom_bgcollor" width="10%">
                	<strong>Grootte</strong>
 	           </td>
    	        <td class="custom_bgcollor" width="10%">
        	        <strong>Bestel</strong>
            	</td>
  	      </tr>
    	    <tr>
        	    <td>
            	    <?PHP echo $row_prod['naam']?>
	            </td>
    	        <td>
        	        <?PHP echo ShowCash($row_prod['prijs'])?>
            	</td>
  	          <td>
    	        	<input name="prod_aantal" type="text" id="prod_aantal" size="3" maxlength="2" />
        	    </td>
					<td>
						<select name="prod_grootte" id="prod_grootte">
							<option value='s'>Small</option>
							<option value='m'>Medium</option>
							<option value='l'>Large</option>
						</select>
					</td>
            	<td align="center">
            		<input type="submit" name="Submit" value="Bestel pizza" />
  	          </td>
    	    </tr>
		</table>
	</div>
</form>
<?PHP
	}
#####################################################################################################################################
	else
	{
?>
<div align="center">
    <table border="1" cellspacing="0" width="700">
        <tr>
            <td class="custom_bgcollor" width="150px">
                <strong>Afbeelding</strong>
            </td>
			<td class="custom_bgcollor" width="300px">
                <strong>Naam</strong>
            </td>
            <td class="custom_bgcollor" width="120px">
                <strong>Prijs</strong>
            </td>
            <td class="custom_bgcollor" width="140px">
                <strong>Bestel</strong>
            </td>
        </tr>
<?PHP
		$sql_select_prod= mysql_query("SELECT * FROM `producten` ORDER BY naam ASC");
		WHILE ($row_prod= mysql_fetch_array($sql_select_prod))
		{
?>
        <tr>
            <td>
                <?PHP echo '<img src="img/prd/'.$row_prod['product_id'].'.png" width="120" height="120">' ?>
            </td>
			
			
			<td>
                <?PHP echo '<b>'.$row_prod['naam'].'</b><br>'.$row_prod['omschrijving'] 
				
				?>
            </td>
            <td>
                <?PHP echo ShowCash($row_prod['prijs'])?>
            </td>
            <td align="center">
                <a href="?p=<?PHP echo $p?>&i=bestel_prod&product_id=<?PHP echo $row_prod['product_id']?>">Bestel</a>
            </td>
        </tr>
<?PHP
		}
?>

</div>
<?PHP
	} 
?>	