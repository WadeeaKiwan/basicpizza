<table width="450" border="0" cellpadding="2">
	<tr>
		<td colspan="2" align="center" ><u><h3>Winkelmand</h3></u></td>
	</tr>
</table>


	
<?PHP
#####################################################################################################################################
	
	if($_SESSION['product_id'] != NULL OR $_SESSION['prod_grootte'] != NULL OR $_SESSION['prod_aantal'] != NULL)
	{ 	
# 		print_r($_SESSION['product_id']);
#		echo "<br>";
#		print_r($_SESSION['prod_aantal']);
#		echo "<br>";
#		print_r($_SESSION['prod_grootte']);
#		
#		echo "<br>";
#		echo "<a href=cart-remove-all.php>Remove all</a>";
#		echo "<br>";
		
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
        	        <strong>Update</strong>
            	</td>
			</tr>
<?PHP
		$array_row = '0';
		
		foreach ($_SESSION['product_id'] as $value)
		{	
			$rs_select_cat= mysql_query("SELECT * FROM producten WHERE product_id=".$_SESSION['product_id'][$array_row]);
			$row_cat= mysql_fetch_array($rs_select_cat);
?>
      		<tr>
         	   	<td>
            	    	<?PHP echo $row_cat['naam']; ?>
					</td>
    	    	    <td>
        	    	    <?PHP echo $row_cat['prijs']; ?>
    	        	</td>
		            <td>
    	            	<?PHP echo $_SESSION['prod_aantal'][$array_row]?>
        	    	</td>
            		<td>
        	        	<?PHP echo $_SESSION['prod_grootte'][$array_row]?>
		            </td>
	    	        <td align="center">
        	    	    <a href="?p=<?PHP echo $p?>&i=bestel_prod&product_id=<?PHP echo $row_prod['product_id']?>">Wijzig</a>
            		</td>
    	  	  </tr>
<?PHP
			$array_row ++;
		}
?>
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
?>