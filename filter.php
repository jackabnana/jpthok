<?php
include 'management/include/functions.php';
extract($_REQUEST);

	$sql = "SELECT P.*, 
	CASE WHEN prodcut_discount_rate = 0 THEN product_rate ELSE prodcut_discount_rate END AS final_rate
	FROM product as P 
	INNER JOIN category as C ON P.cat_id = C.category_id ";	
	
	if($attribute !='')
	{
		$sql .= "JOIN product_attribute as PA ON P.prod_id = PA.prod_id ";
	}
	
	$sql .= " WHERE P.status = 'active' ";
	if($search_text !=''){
	$words = explode(" ", $search_text);
	$count = sizeof($words);
		if( $count <=2 ){
			$x=1;
			foreach ($words as $w) {
				if($x == 1) { $sql_where .= ' AND '; } else { $sql_where .= ' OR '; }
			$sql_where .= " P.product_name like '%$w%'";
			$x++; 
			}
		}
		else {
			$sql_where .= " AND P.product_name like '%$search_text%'";
		}
	}
	
	if($category !='')
	{
		$ab1=1;
		$ba1=sizeof($category);
		foreach($category as $cate)
		{
			if($ab1 == 1) { $sql_where .= ' AND ('; } else { $sql_where .= ' OR '; }
			$sql_where .= " FIND_IN_SET($cate,P.sub_subcat_id) ";
			if($ba1==$ab1) { $sql_where .= ')'; }
			$ab1++;
		}
	}
	
	
	
	//if($category !='')
	//{
		//$sql_where .= " and FIND_IN_SET($category,P.cat_id) ";	
	//}
	
	if($nowaction == 'c' & $nowid !=''){
		$sql_where .= " and (FIND_IN_SET($nowid,P.cat_id) OR  FIND_IN_SET($nowid,P.subcat_id) OR FIND_IN_SET($nowid,P.sub_subcat_id) ) ";	
		
		$get_cat_banner = $get->get_category_banner($nowid);
	}
	
	//if($nowaction == 's' & $nowid !=''){
		//$sql_where .= " and FIND_IN_SET($nowid,P.subcat_id) ";	
	//}
	
	//if($nowaction == 'sc' & $nowid !=''){
		//$sql_where .= " and FIND_IN_SET($nowid,P.sub_subcat_id) ";	
	//}
	
	
	if($sort_val == 'PP'){
		$sql_where .= " and FIND_IN_SET('$sort_val',best_sales) ";	
	}
	
	if($sort_val == 'DO'){
		$sql_where .= " and FIND_IN_SET('$sort_val',best_sales) ";	
	}
	
	
	if($attribute !=''){
		$ab=1;
		$ba=sizeof($attribute);
		foreach($attribute as $attri){
			if($ab == 1) { $sql_where .= ' AND ('; } else { $sql_where .= ' OR '; }
			$sql_where .= " PA.attribute_option_id='$attri'";
			if($ba==$ab) { $sql_where .= ')'; }
			$ab++;
		}
	}
	
	$sql_where .=" GROUP BY P.prod_id";
	
	if(isset($amount) && $amount!="")
	{
		 $values = str_replace(' ','',$amount);
		 $values = str_replace('Rs.','',$values);
		 $values = explode('-',$values);
		 $min = $values[0];
		 $max = $values[1];

		$sql_where .= " HAVING final_rate >= $min and final_rate <= $max ";		 
	}
	
	
	if($sort_val =='PHL'){
	$sql_order = " ORDER BY P.product_rate DESC";
	}else if($sort_val=='PLH'){
	$sql_order = " ORDER BY P.product_rate ASC";
	}else{
	$sql_order = " ORDER BY P.product_rate ASC ";
	}
	
	$query = $sql.$sql_where.$sql_order;
	
	
	$getproduct = mysql_query($query);
	$count = mysql_num_rows($getproduct);

	if($count > 0 )
	{
		$x=1;
		while($res_product=mysql_fetch_array($getproduct))
		{
			$img = $get->get_single_product_img($res_product['prod_id']);
			if($res_product['product_name'] != '')
			{
				$seo_name = $get->seo_friendly_url($res_product['product_name']);
				$url = $site_url.'/detail/pid-'.$res_product['prod_id'].'/'.$seo_name;
			}
			
			$search_div.="<li><a href='$url'>
						  <div class='box'>
						  <div class='box-img'>";
		  
			$prod_image = mysql_query("SELECT * FROM product_image WHERE prod_id = '".$res_product['prod_id']."'  ORDER BY rand() LIMIT 1");
			while($res_image = mysql_fetch_array($prod_image))
			{
				$prod_img = $res_image['product_img'];
				$search_div.="<img src='$site_url/upload/product/thumb/th_$prod_img'>";

			} 
			$search_div.="</div>";
			$search_div.="<div class='box-content'><h4>";
	
				$prod_name_23 = substr($res_product['product_name'],0,23).'..';
				$prod_name = $res_product['product_name'];
				
				if(strlen($prod_name) > 23)
				{ 
					$search_div.="$prod_name_23";
				}
				else
				{
					$search_div.="$prod_name";
				}
				$rate = $res_product['product_rate'];
				$d_rate = $res_product['prodcut_discount_rate'];
				
				$search_div.="</h4>";
				
				$search_div.="<p><span class='price'>Rs $d_rate</span><del>Rs $rate</del></p>
							  </div>";
							  
				$getrs = $res_product['product_rate']-$res_product['prodcut_discount_rate'];
				$getoff = ($getrs/$res_product['product_rate'])*100;
				$r_off = round($getoff,2);
				
				$search_div.="<span class='off'>$r_off% off</span>
							  </div></a>
							  </li>";			  
		} 
	}
	else
	{
			    $search_div.="<p style='text-align:center;padding:20px;'>No result(s) found.</p>";
	}
	
	
	echo json_encode(array("search_div"=>$search_div));
?>