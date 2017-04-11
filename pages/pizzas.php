<table width="450" border="0" cellpadding="2">
	<tr>
		<td colspan="2" align="center" ><u><h3>Pizzas</h3></u></td>
	</tr>
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
		else
		{
			$al_in_winkelmand = '0';
			$array_row = '0';
			foreach ($_SESSION['product_id'] as $value)
			{	
				if($value == $product_id AND $_SESSION['prod_grootte'][$array_row] == $_POST['prod_grootte'] )
				{
					$al_in_winkelmand ++;
				}
				
				$array_row ++;
			}
			
			if($al_in_winkelmand > '0')
			{
				$array_row = '0';
				foreach ($_SESSION['product_id'] as $value)
				{	
					if($value == $product_id AND $_SESSION['prod_grootte'][$array_row] )
					{
						$waarde = $_SESSION['prod_aantal'][$array_row] + $_POST['prod_aantal'];
						$_SESSION['prod_aantal'][$array_row] = $waarde;
					}
					$array_row ++;
				}
				
				echo "<span class='true_warning' ><strong>Pizza toegevoegd aan winkelmand2.</strong></span>";
			}
			else
			{
				array_push($_SESSION['product_id'], $product_id);
				array_push($_SESSION['prod_aantal'], $_POST['prod_aantal']);
				array_push($_SESSION['prod_grootte'], $_POST['prod_grootte']);
				
				echo "<span class='true_warning' ><strong>Pizza toegevoegd aan winkelmand.</strong></span>";
			}
		}
		
		echo '<META http-equiv="refresh" content="2;URL=?p='.$p.'">';

	}
#####################################################################################################################################
	elseif ($i=="bestel_prod")
	{
		$sql_select_prod= mysql_query("SELECT * FROM `producten` WHERE product_id = ".$product_id." ");
		$row_prod= mysql_fetch_array($sql_select_prod);
?>

<form name="bestel_prod" id="bestel_prod" method="post" action="?p=<?PHP echo $p?>&i=add_to_cart&product_id=<?PHP echo $row_prod['product_id']?>" onsubmit="return checkform_create_prod('create_prod')">
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
							<option value='L'>Large</option>
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
    <table border="1" cellspacing="0" width="450">
        <tr>
            <td class="custom_bgcollor" width="60%">
                <strong>Naam</strong>
            </td>
            <td class="custom_bgcollor" width="20%">
                <strong>Prijs</strong>
            </td>
            <td class="custom_bgcollor" width="20%">
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
                <?PHP echo $row_prod['naam']?>
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
	</table>
</div>
<?PHP
	} 
?>	