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
	elseif ($i=="betalen")
	{
		echo "<span class='true_warning' ><strong>U heeft betaald.</strong></span>";
		echo '<META http-equiv="refresh" content="2;URL=?p='.$p.'">';
	}
	else
	{
		if($_SESSION['product_id'] != NULL OR $_SESSION['prod_grootte'] != NULL OR $_SESSION['prod_aantal'] != NULL)
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
        	    	    echo $row_cat['prijs'];
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
							echo $prijs;
        	    	    }
						elseif($_SESSION['prod_grootte'][$key] == 'm')
        	    	    {
							$prijs = $row_cat['prijs'] * $_SESSION['prod_aantal'][$key];
							$prijs = $prijs + $toeslag;
							$totaal_prijs = $totaal_prijs + $prijs;
							echo $prijs;
        	    	    }
        	    	    elseif($_SESSION['prod_grootte'][$key] == 'l')
        	    	    {
							$prijs = $row_cat['prijs'] * $_SESSION['prod_aantal'][$key];
							$prijs = $prijs + $toeslag;
							$totaal_prijs = $totaal_prijs + $prijs;
							echo $prijs;
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
        	        <form name="bestel_prod" id="bestel_prod" method="post" action="?p=<?PHP echo $p?>&i=betalen">
        	        	<input type="submit" name="Submit" value="BETAAL" />
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