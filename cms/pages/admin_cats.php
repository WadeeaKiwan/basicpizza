<?PHP

if (!isset($_SESSION['level']) OR  $_SESSION['level'] >=5)
{
		
	include 'jscripts/checkform/admin_checkform.js';

	if (!isset($_GET['categorie_id']))
	{
		$categorie_id = NULL;
	}
	else
	{
		$categorie_id = $_GET['categorie_id'];
	}
	
#####################################################################################################################################

	if ($i=="create_cat")
	{
		if ($ii=="create")
		{
			mysql_query("INSERT INTO categorie (`categorie`) VALUES ('".Escape($_POST['cat_name'])."')");

			echo "<span class='true_warning' ><strong>Categorie toegevoegd.</strong></span>";
			
			echo '<META http-equiv="refresh" content="1;URL=?p='.$p.'">';
		}
		else
		{
?>
<form name="create_cat" id="create_cat" method="post" action="?p=<?PHP echo $p?>&i=<?PHP echo $i?>&ii=create" onsubmit="return checkform_create_cat('create_cat')">
  <h1>Voeg categorie toe</h1>
        <table>
            <tr>
                <td>*&nbsp;Naam:</td>
                <td><input name="cat_name" type="text" id="cat_name" size="40" maxlength="40" /></td>
            </tr>
        </table>
        <input type="submit" name="Submit" value="Voeg categorie toe" />
</form>
<?PHP
		}
	}
#####################################################################################################################################
	elseif ($i=="edit_cat")
	{
		if ($ii=="edit")
		{
			mysql_query("UPDATE categorie SET categorie='".Escape($_POST['cat_name'])."' WHERE categorie_id=".$categorie_id);
			
			echo "<span class='true_warning' ><strong>Categorie gewijzigd.</strong></span>";
			
			echo '<META http-equiv="refresh" content="1;URL=?p='.$p.'">';
		}
		else
		{
			$rs_select_cat= mysql_query("SELECT * FROM categorie WHERE categorie_id=".$categorie_id);
			$row_cat= mysql_fetch_array($rs_select_cat);
?>
<form name="edit_cat" id="edit_cat" method="post" action="?p=<?PHP echo $p?>&i=<?PHP echo $i?>&ii=edit&categorie_id=<?PHP echo $categorie_id?>" onsubmit="return checkform_edit_cat('edit_cat')">
    <h1>Bewerk Categorie</h1>
        <table>
            <tr>
                <td>*&nbsp;Naam:</td>
                <td><input name="cat_name" type="text" id="cat_name" size="40" maxlength="40" value="<?PHP echo $row_cat['categorie']?>" /></td>
            </tr>
        </table>
        <input type="submit" name="Submit" value="Wijzig categorie" />
</form>
<?PHP
		}
	}
#####################################################################################################################################
	elseif ($i=="delete_cat")
	{
		mysql_query("DELETE FROM categorie WHERE categorie_id=".$categorie_id);

		echo "<span class='true_warning' ><strong>Categorie verwijderd.</strong></span>";

		echo '<META http-equiv="refresh" content="1;URL=?p='.$p.'">';
	}
#####################################################################################################################################
	else
	{
?>

<h1>Categorieen</h1>

<a href="?p=<?PHP echo $p?>&i=create_cat">Nieuwe Categorie</a>

    <table>
        <tr>
            <th>Naam</th>
            <th>Bewerken</th>
			<th>Verwijderen</th>
        </tr>
<?PHP
		$sql_select_cat= mysql_query("SELECT * FROM `categorie` ORDER BY categorie ASC");
		WHILE ($row_cat= mysql_fetch_array($sql_select_cat))
		{
?>
        <tr>
            <td>
                <?PHP echo $row_cat['categorie']?>
            </td>
            <td>
                <a href="?p=<?PHP echo $p?>&i=edit_cat&categorie_id=<?PHP echo $row_cat['categorie_id']?>"><img src="../img/edit.png" border="0" alt="Bewerken"></a>
            </td>
            <td>
                <a onclick="return confirm('Weet u zeker dat u deze categorie wilt verwijderen?')" href="?p=<?PHP echo $p?>&i=delete_cat&categorie_id=<?PHP echo $row_cat['categorie_id']?>"><img src="../img/del.png" border="0" alt="Verwijderen"></a>
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