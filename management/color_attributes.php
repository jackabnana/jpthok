<input type="hidden" name="attribute_id" value="<?=$fetchrow->attribute_id?>"/>
		<tr>
		<td colspan="3">
		<p style="width:50%; float:left; ">
		<div class="fleft" style="width:20%; text-align:center; margin:2px 5px;">Option Name</div>
        <div style="width:8%; margin:2px 5px; text-align:center" class="fleft">Color Code</div>		
		<div style="width:15%; margin:2px 5px; text-align:center" class="fleft">Position</div>
		
		<p style="width:50%; float:left">
		<div style="width:20%; margin:2px 5px; text-align:center" class="fleft">Option Name</div>
        <div style="width:8%; margin:2px 5px; text-align:center" class="fleft">Color Code</div>		
		<div style="width:15%; margin:2px 5px; text-align:center" class="fleft">Position</div>
		
		</p>
		<? 
		$selectoption = mysql_query("SELECT * FROM attribute_option WHERE attribute_id='$fetchrow->attribute_id' ORDER BY attribute_position ASC");
		while($optionrow=mysql_fetch_object($selectoption)):
		
		$data=$optionrow->attribute_position;
		
		?>
		<input type="hidden" name="attribute_action[]" value="edit" />
		<input type="hidden" name="id[]" value="<?=$optionrow->id?>" />
		<p style="width:50%; float:left">
		<input type="text" id="p_new" name="attribute_option_name[]" value="<?=$optionrow->attribute_option_name?>" required placeholder="Attribute Options" style="width:30%; margin:2px 5px;" />
		<input type="text" id="p_new" name="attribute_hex_code[]" value="<?=$optionrow->attribute_hex_code?>" required style="width:25%; margin:2px 5px;" placeholder="Color Hex Code" maxlength="7" />
		<input type="text" id="p_new" name="attribute_position[]" value="<?=$optionrow->attribute_position?>" style="width:25%; margin:2px 5px;" placeholder="Attribute Position" />
		<a href="<?=ADMIN_PATH?>/<?=$currentpage?>?role=edit&page=<?=$page?>&id=<?=$_REQUEST['id']?>&did=<?=$optionrow->id?>" class="green_button">Delete</a></p>
		<? endwhile;?>
		</td>
		</tr>