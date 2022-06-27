<?php 
include ('include/functions.php');

$cat_id = $_POST['cat_id'];
$category_list = $get->get_subcategory_menu($cat_id);
echo '<option value="">Select Subcategory</option>';
while($rows=mysql_fetch_array($category_list)){ ?>
<option value="<?=$rows['category_id']?>" <?php if($rows['category_id']==$cat_id){ echo "selected"; }?> ><?=$rows['category_name']?></option>
<?php }?>