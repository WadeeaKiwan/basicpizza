<?PHP

if (!isset($_SESSION['level']) OR  $_SESSION['level'] >=5)
{
		
	include 'jscripts/checkform/admin_checkform.js';

	if (!isset($_GET['product_id']))
	{
		$product_id = NULL;
	}
	else
	{
		$product_id = $_GET['product_id'];
	}
	
#####################################################################################################################################

	if ($i=="create_prod")
	{
		if ($ii=="create")
		{
			mysql_query("INSERT INTO producten (`naam`, `omschrijving`, `prijs`, `categorie_categorie_id` ) 
			VALUES ('".Escape($_POST['prod_name'])."', '".Escape($_POST['prod_text'])."', '".$_POST['prod_price']."', '".$_POST['cat_id']."')");

			echo "<span class='true_warning' ><strong>Pizza toegevoegd.</strong></span>";
			
			echo '<META http-equiv="refresh" content="1;URL=?p='.$p.'">';
		}
		else
		{
?>

<form name="create_prod" id="create_prod" method="post" action="?p=<?PHP echo $p?>&i=<?PHP echo $i?>&ii=create" onsubmit="return checkform_create_prod('create_prod')">

<h1>Voeg pizza toe</h1>
        <table>
            <tr>
                <td>*&nbsp;Naam:</td>
                <td><input name="prod_name" type="text" id="prod_name" size="40" maxlength="40" /></td>
            </tr>
            <tr>
                <td>*&nbsp;Cat:</td>
                <td>
					<select name="cat_id">
<?PHP
							$rs_select_cat= mysql_query("SELECT * FROM categorie ORDER BY categorie ASC");
							while ($row_cat= mysql_fetch_array($rs_select_cat))
							{	
								echo '<option value="'.$row_cat['categorie_id'].'">'.$row_cat['categorie'].'</option>';
							}
?>
					</select>
				</td>
            </tr>
            <tr>
                <td>*&nbsp;Prijs:</td>
                <td><input name="prod_price" type="text" id="prod_price" size="40" maxlength="40" /></td>
            </tr>
            <tr>
                <td>*&nbsp;Omschrijving:</td>
                <td><textarea name="prod_text" ip="prod_text" rows="4" cols="50"></textarea></td>
            </tr>
        </table>
        <input type="submit" name="Submit" value="Voeg pizza toe" />
</form>
<?PHP
		}
	}
#####################################################################################################################################
	elseif ($i=="edit_prod")
	{
		if ($ii=="edit")
		{		
			mysql_query("UPDATE producten SET naam='".Escape($_POST['prod_name'])."', omschrijving='".Escape($_POST['prod_text'])."', prijs='".$_POST['prod_price']."', categorie_categorie_id='".$_POST['cat_id']."' WHERE product_id=".$product_id);
			
			echo "<span class='true_warning' ><strong>Pizza gewijzigd.</strong></span>";
			
			echo '<META http-equiv="refresh" content="1;URL=?p='.$p.'">';
		}
		else
		{
			$rs_select_prod= mysql_query("SELECT * FROM producten WHERE product_id=".$product_id);
			$row_prod= mysql_fetch_array($rs_select_prod);
?>
<form name="edit_prod" id="edit_prod" method="post" action="?p=<?PHP echo $p?>&i=<?PHP echo $i?>&ii=edit&product_id=<?PHP echo $product_id?>" onsubmit="return checkform_edit_prod('edit_prod')">

<h1>Bewerk Pizza</h1>
        <table>
            <tr>
                <td>*&nbsp;Naam:</td>
                <td><input name="prod_name" type="text" id="prod_name" size="40" maxlength="40" value="<?PHP echo $row_prod['naam']?>" /></td>
            </tr>
            <tr>
                <td>*&nbsp;Cat:</td>
                <td>
					<select name="cat_id">
<?PHP
							$rs_select_cat= mysql_query("SELECT * FROM categorie");
							while ($row_cat= mysql_fetch_array($rs_select_cat))
							{	
								if($row_cat['categorie_id'] == $row_prod['categorie_categorie_id'])
								{
									echo '<option value="'.$row_cat['categorie_id'].'" selected>'.$row_cat['categorie'].'</option>';
								}
								else
								{
									echo '<option value="'.$row_cat['categorie_id'].'">'.$row_cat['categorie'].'</option>';
								}
							}
?>
					</select>
				</td>
            </tr>
            <tr>
                <td>*&nbsp;Prijs:</td>
                <td><input name="prod_price" type="text" id="prod_price" size="40" maxlength="40" value="<?PHP echo $row_prod['prijs']?>" /></td>
            </tr>
            <tr>
                <td>*&nbsp;Omschrijving:</td>
                <td><textarea name="prod_text" ip="prod_text" rows="4" cols="50"><?PHP echo $row_prod['omschrijving']?></textarea></td>
            </tr>
        </table>
        <input type="submit" name="Submit" value="Wijzig pizza" value="<?PHP echo $row_prod['naam']?>" />
</form>
<?PHP
		}
	}
#####################################################################################################################################
	elseif ($i=="delete_prod")
	{
		mysql_query("DELETE FROM producten WHERE product_id=".$product_id);

		echo "<span class='true_warning' ><strong>Pizza verwijderd.</strong></span>";

		echo '<META http-equiv="refresh" content="1;URL=?p='.$p.'">';
	}
#####################################################################################################################################
	else
	{
?>

<h1>Pizzas</h1>

<a href="?p=<?PHP echo $p?>&i=create_prod">Nieuwe Pizza</a>

    <table>
        <tr>
            <th>Naam</th>
            <th>Bewerken</th>
			<th>Verwijderen</th>
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
                <a href="?p=<?PHP echo $p?>&i=edit_prod&product_id=<?PHP echo $row_prod['product_id']?>"><img src="../img/edit.png" border="0" alt="Bewerken"></a>
            </td>
            <td>
                <a onclick="return confirm('Weet u zeker dat u deze pizza wilt verwijderen?')" href="?p=<?PHP echo $p?>&i=delete_prod&product_id=<?PHP echo $row_prod['product_id']?>"><img src="../img/del.png" border="0" alt="Verwijderen"></a>
            </td>
        </tr>
<?PHP
		}
?>
	</table>

<?PHP
	} 
#####################################################################################################################################
}
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