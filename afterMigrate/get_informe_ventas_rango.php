<?php
	require_once('./conexion.php');
	header('Content-Type: application/json; charset=utf-8');
	header('Access-Control-Allow-Origin: *');
  	header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
  	header('Access-Control-Allow-Headers: Content-Type,x-prototype-version,x-requested-with');

  	$json = file_get_contents('php://input');
	$data = json_decode($json,true);
	

  	
  	$registros = [];

  	if(file_get_contents('php://input')===""){
  		print_r (json_encode([], JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
  	}else{
  		$initial_day = $data["initial_day"];
		$final_day = $data["final_day"];
  		$initial_day_format = date('Y-m-d' , strtotime($initial_day));
  		$final_day_format = date('Y-m-d' , strtotime($final_day));
  		if($initial_day_format === $final_day_format){
	  		getDataDay($initial_day, $conexion, $registros);
	  	}else if($initial_day_format < $final_day_format){
	  		$final_day_format_mas_1_day = date('Y-m-d' , strtotime($final_day_format." + 1 days"));
	  		getData($initial_day, $final_day_format_mas_1_day, $conexion, $registros);
	  	}else{
	  		$initial_day_format_mas_1_day = date('Y-m-d' , strtotime($initial_day_format." + 1 days"));
	  		getData($final_day, $initial_day_format_mas_1_day, $conexion, $registros);
	  	}
  	}
  	
  	
  	function getDataDay($today, $conexion, $registros) {
        
    	// CONSULTA DE LA CANTIDAD DE FACTURAS DURANTE UN DIA
    	$consulta = "SELECT order_id, facturationNumber, controlNumber, order_table_id, t.table_name, order_personal_document, p.personal_name, order_list_inventary, order_create, order_done, order_status, client_document, client_name, client_address, client_phone_number, order_price_dolar, order_percent_iva, subtotal, totalfinal FROM orders AS o INNER JOIN personals AS p INNER JOIN tables AS t ON o.order_personal_document=p.personal_document AND o.order_table_id=t.table_id AND order_status=1 AND order_done LIKE '".$today."%'";

    	$pre = mysqli_prepare($conexion, $consulta); 
			mysqli_stmt_execute($pre);
			mysqli_stmt_bind_result($pre, $order_id, $facturationNumber, $controlNumber, $order_table_id, $order_table_name, $order_personal_document, $order_personal_name, $order_list_inventary, $order_create, $order_done, $order_status, $client_document, $client_name, $client_address, $client_phone_number, $order_price_dolar, $order_percent_iva, $subtotal, $totalfinal);

			while(mysqli_stmt_fetch($pre)) {
				$registros["orders"][] = array(
					'order_id'=>$order_id,
					'facturationNumber'=>$facturationNumber, 
					'controlNumber'=>$controlNumber, 
					'order_table_id'=>$order_table_id, 
					'order_table_name'=>$order_table_name, 
					'order_personal_document'=>$order_personal_document,
					'order_personal_name'=>$order_personal_name, 
					'order_list_inventary'=>json_decode($order_list_inventary), 
					'order_create'=>$order_create, 
					'order_done'=> date('d-m-Y / H:i:s', strtotime($order_done)),
					'order_hour'=> intval(date('G', strtotime($order_done))), 
					'order_status'=>$order_status, 
					'client_document'=>$client_document, 
					'client_name'=>$client_name, 
					'client_address'=>$client_address, 
					'client_phone_number'=>$client_phone_number, 
					'order_price_dolar'=>$order_price_dolar, 
					'order_percent_iva'=>$order_percent_iva, 
					'subtotal'=>$subtotal, 
					'totalfinal'=>$totalfinal
				);
			}

			$sql = "SELECT item_id, item_name, item_category, item_uni_metric, item_count, item_create, item_status, ic.category_name, ic.category_color, iu.unit_name FROM inventary AS i INNER JOIN inventary_categories AS ic INNER JOIN inventary_units AS iu ON i.item_uni_metric=iu.unit_id AND i.item_category=ic.category_id AND ic.category_ingredient=1 ORDER BY item_category ASC";
			$pre = mysqli_prepare($conexion, $sql);
			mysqli_stmt_execute($pre);
			mysqli_stmt_bind_result($pre,$item_id,$item_name,$item_category,$item_uni_metric,$item_count,$item_create,$item_status, $item_category_name, $item_category_color, $item_unit_name);

			while(mysqli_stmt_fetch($pre)) {
				$registros["items"][] = array('item_id'=>$item_id,'item_name'=>$item_name,'item_category'=>$item_category,'item_uni_metric'=>$item_uni_metric,'item_count'=>$item_count,'item_create'=>$item_create,'item_status'=>$item_status,'item_category_name'=>$item_category_name,'item_category_color'=>$item_category_color,'item_unit_name'=>$item_unit_name);
			}
		    	
    	print_r (json_encode($registros, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
  	}

  	function getData($initial, $final, $conexion, $registros) {
        
    	// CONSULTA DE LA CANTIDAD DE FACTURAS DURANTE UN DIA
    	$consulta = "SELECT order_id, facturationNumber, controlNumber, order_table_id, t.table_name, order_personal_document, p.personal_name, order_list_inventary, order_create, order_done, order_status, client_document, client_name, client_address, client_phone_number, order_price_dolar, order_percent_iva, subtotal, totalfinal FROM orders AS o INNER JOIN personals AS p INNER JOIN tables AS t ON o.order_personal_document=p.personal_document AND o.order_table_id=t.table_id AND order_status=1 AND order_done 
			BETWEEN '$initial' AND '$final'";

    	$pre = mysqli_prepare($conexion, $consulta); 
			mysqli_stmt_execute($pre);
			mysqli_stmt_bind_result($pre, $order_id, $facturationNumber, $controlNumber, $order_table_id, $order_table_name, $order_personal_document, $order_personal_name, $order_list_inventary, $order_create, $order_done, $order_status, $client_document, $client_name, $client_address, $client_phone_number, $order_price_dolar, $order_percent_iva, $subtotal, $totalfinal);

			while(mysqli_stmt_fetch($pre)) {
				$registros["orders"][] = array(
					'order_id'=>$order_id,
					'facturationNumber'=>$facturationNumber, 
					'controlNumber'=>$controlNumber,
					'order_table_id'=>$order_table_id, 
					'order_table_name'=>$order_table_name, 
					'order_personal_document'=>$order_personal_document,
					'order_personal_name'=>$order_personal_name, 
					'order_list_inventary'=>json_decode($order_list_inventary), 
					'order_create'=>$order_create, 
					'order_done'=> date('d-m-Y / H:i:s', strtotime($order_done)),
					'order_hour'=> intval(date('G', strtotime($order_done))),
					'order_day'=> intval(date('w', strtotime($order_done))),  
					'order_status'=>$order_status, 
					'client_document'=>$client_document, 
					'client_name'=>$client_name, 
					'client_address'=>$client_address, 
					'client_phone_number'=>$client_phone_number, 
					'order_price_dolar'=>$order_price_dolar, 
					'order_percent_iva'=>$order_percent_iva, 
					'subtotal'=>$subtotal, 
					'totalfinal'=>$totalfinal
				);
			}
			
			$sql = "SELECT item_id, item_name, item_category, item_uni_metric, item_count, item_create, item_status, ic.category_name, ic.category_color, iu.unit_name FROM inventary AS i INNER JOIN inventary_categories AS ic INNER JOIN inventary_units AS iu ON i.item_uni_metric=iu.unit_id AND i.item_category=ic.category_id AND ic.category_ingredient=1 ORDER BY item_category ASC";
			$pre = mysqli_prepare($conexion, $sql);
			mysqli_stmt_execute($pre);
			mysqli_stmt_bind_result($pre,$item_id,$item_name,$item_category,$item_uni_metric,$item_count,$item_create,$item_status, $item_category_name, $item_category_color, $item_unit_name);

			while(mysqli_stmt_fetch($pre)) {
				$registros["items"][] = array('item_id'=>$item_id,'item_name'=>$item_name,'item_category'=>$item_category,'item_uni_metric'=>$item_uni_metric,'item_count'=>$item_count,'item_create'=>$item_create,'item_status'=>$item_status,'item_category_name'=>$item_category_name,'item_category_color'=>$item_category_color,'item_unit_name'=>$item_unit_name);
			}
		    	
    	print_r (json_encode($registros, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
  	}

  	

mysqli_close($conexion);

?>