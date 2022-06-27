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


<select id="theSelect" style="width:200px;" onchange="showstock(this.value);">
		            <option value="">- Select -</option>
					<? 
					$select_group = mysql_query("SELECT * FROM attribute_group WHERE status='active' $sql_query ");
					while($row_group=mysql_fetch_array($select_group))
					{
					
						$select_product_group = mysql_query("SELECT * FROM product_attribute WHERE prod_id='{$_POST['pid']}' and attri_group_id!=0 ");
						$select_product_group_row=mysql_fetch_array($select_product_group);
						echo $select_product_group_row['attri_group_id'].'='.$row_group['attri_group_id'];
						if($select_product_group_row['attri_group_id'] == $row_group['attri_group_id']){
							$selecteda = "selected";
						} else {
							$selecteda = "";
						}
						?>
						<option value="<?=$row_group['attri_group_id']?>" <?=$selecteda?>><?=$row_group['attri_group_name']?></option>
						<?
					}
					?>
		        </select>