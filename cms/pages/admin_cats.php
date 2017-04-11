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
			mysql_query("INSERT INTO categorie (`categorie`) VALUES ('".$_POST['cat_name']."')");

			echo "<span class='true_warning' ><strong>Categorie toegevoegd.</strong></span>";
			
			echo '<META http-equiv="refresh" content="1;URL=?p='.$p.'">';
		}
		else
		{
?>
<form name="create_cat" id="create_cat" method="post" action="?p=<?PHP echo $p?>&i=<?PHP echo $i?>&ii=create" onsubmit="return checkform_create_cat('create_cat')">
    <div align="center">
        <table width="300">
            <tr>
                <td align="left">*&nbsp;Naam:</td>
                <td align="left"><input name="cat_name" type="text" id="cat_name" size="40" maxlength="40" /></td>
            </tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
            <tr>
                <td align="center" colspan="2"><input type="submit" name="Submit" value="Voeg categorie toe" /></td>
            </tr>
        </table>
    </div>
</form>
<?PHP
		}
	}
#####################################################################################################################################
	elseif ($i=="edit_cat")
	{
		if ($ii=="edit")
		{
			mysql_query("UPDATE categorie SET categorie='".$_POST['cat_name']."' WHERE categorie_id=".$categorie_id);
			
			echo "<span class='true_warning' ><strong>Categorie gewijzigd.</strong></span>";
			
			echo '<META http-equiv="refresh" content="1;URL=?p='.$p.'">';
		}
		else
		{
			$rs_select_cat= mysql_query("SELECT * FROM categorie WHERE categorie_id=".$categorie_id);
			$row_cat= mysql_fetch_array($rs_select_cat);
?>
<form name="edit_cat" id="edit_cat" method="post" action="?p=<?PHP echo $p?>&i=<?PHP echo $i?>&ii=edit&categorie_id=<?PHP echo $categorie_id?>" onsubmit="return checkform_edit_cat('edit_cat')">
    <div align="center">
        <table width="300">
            <tr>
                <td align="left">*&nbsp;Naam:</td>
                <td align="left"><input name="cat_name" type="text" id="cat_name" size="40" maxlength="40" value="<?PHP echo $row_cat['categorie']?>" /></td>
            </tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
            <tr>
                <td align="center" colspan="2"><input type="submit" name="Submit" value="Wijzig categorie" /></td>
            </tr>
        </table>
    </div>
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
<table width="450" border="0" cellpadding="2">
	<tr>
		<td colspan="2" align="center" ><u><h3>Categorieen</h3></u></td>
	</tr>
</table>

<div align="center">
	<table border="0">
		<tr>
			<td align="center" valign="top">
				<a href="?p=<?PHP echo $p?>&i=create_cat">Nieuwe Categorie</a>
			</td>
		</tr>
	</table>
	</br>
    <table border="1" cellspacing="0" width="450">
        <tr>
            <td class="custom_bgcollor">
                <strong>Naam</strong>
            </td>
            <td class="custom_bgcollor" width="5%">
                <strong>Bewerken</strong>
            </td>
			<td class="custom_bgcollor" width="5%">
                <strong>Verwijderen</strong>
            </td>
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
            <td align="center">
                <a href="?p=<?PHP echo $p?>&i=edit_cat&categorie_id=<?PHP echo $row_cat['categorie_id']?>"><img src="../img/edit.png" border="0" alt="Bewerken"></a>
            </td>
            <td align="center">
                <a onclick="return confirm('Weet u zeker dat u deze categorie wilt verwijderen?')" href="?p=<?PHP echo $p?>&i=delete_cat&categorie_id=<?PHP echo $row_cat['categorie_id']?>"><img src="../img/del.png" border="0" alt="Verwijderen"></a>
            </td>
        </tr>
<?PHP
		}
?>
	</table>
</div>
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