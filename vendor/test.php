<br>
		<?
		$selectattributecheckbox = mysql_query("SELECT * FROM attribute ORDER BY id ASC");
		while($attributerow=mysql_fetch_object($selectattributecheckbox)):
		?>
		<label style="padding:10px 20px; margin:15px 5px; background-color:orange">
		<input type="checkbox" onclick="showhide(<?=$attributerow->attribute_id?>)" <?=$get->get_attribute($attributerow->attribute_id,$_GET['request_prod_id'])?> style="width:16px; height:16px;"> 
		&nbsp; <?=$attributerow->attribute_name?> 
		</label>
		<? endwhile; ?>
		<br><br>
		<div class="cboth"></div>
		<?
		$selectattributecheckbox = mysql_query("SELECT * FROM attribute ORDER BY id ASC");
		while($attributerow=mysql_fetch_object($selectattributecheckbox)):
		?>
		<div id="<?=$attributerow->attribute_id?>" style="<? if($get->get_attribute($attributerow->attribute_id,$_GET['request_prod_id']) =='') { echo 'display:none;'; } else { 'display:block;'; } ?> width:49%; margin:10px 0.2%; height:500px; float:left; overflow-y:scroll;">
		<table style="width:100%; margin:0;">		
		<tr><td colspan="5"><?=$attributerow->attribute_name?></td></tr>
		<? 
		$selectattributeoption = mysql_query("SELECT * FROM attribute_option WHERE attribute_id='$attributerow->attribute_id' ");
		while($rowabc=mysql_fetch_object($selectattributeoption)){
		if($get->get_attribute_option_id($rowabc->id,$rowabc->attribute_id,$_GET['request_prod_id']) == 'checked')
		{
			$bgcolor = '#ED3237';
		}
			else {
				$bgcolor = '#FFF';
			}
		?>
		
		<tr bgcolor="<?=$bgcolor?>">
		<td>
		<input type="checkbox" value="" name="" <?=$get->get_attribute_option_id($rowabc->id,$rowabc->attribute_id,$_REQUEST['request_prod_id'])?>/> 
		<input type="hidden" value="<?=$rowabc->id?>" name="attribute_option_id[]" /> 
		<input type="hidden" name="attribute_id[]" value="<?=$attributerow->attribute_id?>" /></td>
		<td><?=$rowabc->attribute_option_name?></td>
		<td><input type="text"  name="attribute_pricea[]" Placeholder="<?=$attributerow->attribute_name?> Price" value="<?=$get->get_attribute_option_price($rowabc->id,$_REQUEST['request_prod_id'])?>" /></td>
		<td><input type="text"  name="attribute_dis_price[]" Placeholder="<?=$attributerow->attribute_name?> Dis. Price" value="<?=$get->get_attribute_option_disprice($rowabc->id,$_REQUEST['request_prod_id'])?>" /></td>
		<td align="center">
		<input type="checkbox" id="attribute_stock_check_<?=$rowabc->id?>" onclick="check_stock(<?=$rowabc->id?>);" <? if($get->get_attribute_option_stock($rowabc->id,$rowabc->attribute_id,$_REQUEST['request_prod_id']) == 1 ) { echo 'checked';} ?> style="width:22px; height:22px;" />
		
		<input type="hidden" name="attribute_stock[]" value="<?=$get->get_attribute_option_stock($rowabc->id,$rowabc->attribute_id,$_REQUEST['request_prod_id'])?>" style="width:25px; height:22px;" id="attribute_stock_<?=$rowabc->id?>"  /> Stock </td>
		</tr>
		<? } ?>
		
		</table>
		</div>
		<? endwhile; ?>
		<div class="cboth"></div>