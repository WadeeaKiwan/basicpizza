<?PHP
//======================================================================
// pizzas.php
// Deze pagina geeft alle Producten weer van alle categorien met een mooie layout
// Gebruikt CSS
// bestaat uit meerdere pagina's
// $i = paginanaam in URL
// 		add_to_cart 	= Pagina 2e stap toevoegen aan winkelmand 
// 		bestel_prod 	= pagina 1e stap toevoegen aan winkelmand (aanvulling size een aantal)
// 		pizzas 			= overzichtspagina met alle pizzas uit alle categoriën
// 
//======================================================================
// 
// Laatste bijwerking : 17-04-2017
	if (!isset($_GET['product_id']))
	{
		$product_id = NULL;
	}
	else
	{
		$product_id = $_GET['product_id'];
	}

#####################################################################################################################################
# toevoegen van een product aan het winkelmandje
if ($i=="add_to_cart" )
	{

# controle op 0 pizzas toevoegen
	if ($_POST['prod_aantal']!=0)
		{
# als de arrays niet bestaan in de sessie, worden ze gemaakt en zijn ze nog leeg.
		if(!isset($_SESSION['product_id']) OR !isset($_SESSION['prod_grootte']) OR !isset($_SESSION['prod_aantal']))
		{
			$_SESSION['product_id']=array();
			$_SESSION['prod_grootte']=array();	
			$_SESSION['prod_aantal']=array();
		}
# eerste item in de winkelwagen
		{	
		$al_in_winkelmand = '0';
		foreach ($_SESSION['product_id'] as $key => $value)
		{	
			if($value == $product_id AND $_SESSION['prod_grootte'][$key] == $_POST['prod_grootte'] )
			{
				$al_in_winkelmand ++;
			}
		}
# alle volgende items in de winkelwagen			
		if($al_in_winkelmand > '0')
		{
		foreach ($_SESSION['product_id'] as $key => $value)
		{	
			if($value == $product_id AND $_SESSION['prod_grootte'][$key])
			{
				$waarde = $_SESSION['prod_aantal'][$key] + $_POST['prod_aantal'];
				$_SESSION['prod_aantal'][$key] = $waarde;
			}
		}
				
			echo "<span class='true_warning'>Pizza toegevoegd aan winkelmand</span>";
			echo "<a class='button' href='?p=winkelmand'>Ga naar winkelmand</a>";
			echo "<a class='button' href='?p=pizzas'>Winkel verder</a>";
		}
		else
		{
# product toevoegen aan de arrays		
			array_push($_SESSION['product_id'], $product_id);
			array_push($_SESSION['prod_aantal'], $_POST['prod_aantal']);
			array_push($_SESSION['prod_grootte'], $_POST['prod_grootte']);
			echo "<p class='true_warning' >Pizza toegevoegd aan winkelmand.</p>";
			echo "<a class='button' href='?p=winkelmand'>Ga naar winkelmand</a>";
			echo "<a class='button' href='?p=pizzas'>Winkel verder</a>";
		}
		}
	} 
	else 
	{
	echo "<p class='true_warning' >GEEN Pizza toegevoegd aan winkelmand.</p>";
	echo "<a class='button' href='?p=winkelmand'>Ga naar winkelmand</a>";
	echo "<a class='button' href='?p=pizzas'>Winkel verder</a>";
	}
	}
#####################################################################################################################################
	elseif ($i=="bestel_prod")
	{
		$sql_select_prod= mysql_query("SELECT * FROM `producten` WHERE product_id = ".$product_id." ");
		$row_prod= mysql_fetch_array($sql_select_prod);
# HTML body van het keuze formulier met aantal en size
?>

<h1>Mijn bestellingen</h1>
<form name="bestel_prod" id="bestel_prod" method="post" action="?p=<?PHP echo $p?>&i=add_to_cart&product_id=<?PHP echo $row_prod['product_id']?>">
	
	<table>
      <tr>
    	<th>Naam pizza</th>
        <th>Prijs</th>
        <th>Aantal</th>
    	<th>Grootte</th>
      </tr>
	  <tr>
	    <td><?PHP echo $row_prod['naam']?></td>
        <td><?PHP echo ShowCash($row_prod['prijs'])?></td>
        <td>
        	<input name="prod_aantal" type="text" id="prod_aantal" size="3" maxlength="2" value="1"/>
	    </td>
		<td>
			<select name="prod_grootte" id="prod_grootte">
				<option value='s'>Small</option>
				<option value='m'>Medium</option>
				<option value='l'>Large</option>
			</select>
		</td>
       </tr>
	</table>

	<input type="submit" name="Submit" value="Bestel pizza" />
        
</form>
<?PHP
	}
#####################################################################################################################################
	else
	{
# HTML body van de front end pizza pagina
?>

<h1>Onze pizza's</h1>
<div class="pizzas">
    
	<?PHP
# Sortering van pizza's gegroepeerd op categorie
		$sql_select_cat= mysql_query(" select categorie_id from categorie");
		WHILE ($row_cat= mysql_fetch_array($sql_select_cat))
		{	
			$sql_select_prod= mysql_query("
				SELECT product_id, naam, omschrijving, prijs, categorie.categorie
				FROM producten	
				JOIN categorie ON (producten.categorie_categorie_id=categorie.categorie_id)
				WHERE categorie.categorie_id = ".$row_cat['categorie_id']."
				ORDER BY naam ASC
				");
							
			WHILE ($row_prod= mysql_fetch_array($sql_select_prod))
			{

			?>

            <section>

	            <?PHP echo '<img src="img/prd/'.substr($row_prod['product_id'], -1).'.png">'; ?>
	            <span class="categorie">
	            	<?PHP echo $row_prod['categorie']; ?> 
	            </span>
	            <?PHP echo '<h3>'.$row_prod['naam'].'</h3><p>'.$row_prod['omschrijving']."</p>"; 
				?>
	        	<span class="prijs">
	            	<?PHP echo "<span>S</span> ".ShowCash($row_prod['prijs'])."<br>";?>
					<?PHP echo "<span>M</span> ".ShowCash($row_prod['prijs']+200)."<br>";?>
					<?PHP echo "<span>L</span> ".ShowCash($row_prod['prijs']+400)."<br>";?>
	            </span>
	        
	            <a class="bestel" href="?p=<?PHP echo $p?>&i=bestel_prod&product_id=<?PHP echo $row_prod['product_id']?>">Bestel</a>

            </section>
        
<?PHP
			}
		}
?>

</div>

<?PHP
	} 
?>	
