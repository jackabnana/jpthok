<?php
include ('include/functions.php');
 $aa='';
if($_POST['cat_id']!='' && $_POST['subcat_id']!='' && $_POST['cat_id']!='undefined' && $_POST['subcat_id']!='undefined'){
$sql_query.='AND cat_id='.$_POST['cat_id'].' AND subcat_id='.$_POST['subcat_id'];
}else if($_POST['cat_id']!='' && $_POST['subcat_id']!='' && $_POST['cat_id']=='undefined' && $_POST['subcat_id']=='undefined'){
$sql_query.='AND cat_id='.$aa.' AND subcat_id='.$aa;
}
else if($_POST['cat_id']!='' && $_POST['cat_id']!='undefined' && $_POST['subcat_id']=='undefined'){
$sql_query.='AND cat_id='.$_POST['cat_id'];
}
else if($_POST['subcat_id']!='' && $_POST['subcat_id']=='undefined' && $_POST['cat_id']=='undefined'){
$sql_query.='AND subcat_id='.$_POST['subcat_id'];
}
else if($_POST['cat_id']!='' && $_POST['cat_id']=='undefined'){
$sql_query.='AND cat_id='.$aa;
}
else if($_POST['cat_id']!='' && $_POST['cat_id']!='undefined'){
$sql_query.='AND cat_id='.$_POST['cat_id'];
}
else if($_POST['subcat_id']!='' && $_POST['subcat_id']=='undefined'){
$sql_query.='AND subcat_id='.$aa;
}
else if($_POST['subcat_id']!='' && $_POST['subcat_id']!='undefined'){
$sql_query.='AND subcat_id='.$_POST['subcat_id'];
}

//echo "SELECT * FROM attribute_group WHERE status='active' $sql_query ";
?>


<table style="width:100%; margin:0;">
			<?
			$a=1;			
			$select_attribute = mysql_query("SELECT * FROM attribute WHERE status='active' $sql_query");
			while($select_attri=mysql_fetch_array($select_attribute)){
				if($a==1){ echo '<tr>'; }
			?>
		
			<td align="center" width="25%">
			<input type="hidden" name="attribute_id[]" value="<?=$select_attri['attribute_id']?>" />
			<b><?=$select_attri['attribute_name']?></b>
				<select name="attribute_option_id[]" multiple style="height:100px">
				<? 
				$select_sub_attribute = mysql_query("SELECT * FROM attribute_option WHERE attribute_id='{$select_attri['attribute_id']}' ");
				while($row=mysql_fetch_array($select_sub_attribute)):
				?>
				<option value="<?=$row['id']?>" <?=$get->get_attribute_option_id($row['id'],$_REQUEST['request_prod_id'])?>><?=$row['attribute_option_name']?></option>
				<? endwhile; ?>
				</select>
			</td>
				
			<? if($a==4){ echo '</tr>'; $a=0; } $a++; } ?>		
		
		</table>


