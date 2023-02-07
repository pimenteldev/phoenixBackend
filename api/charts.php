<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    
    if (isset($_SESSION['user_id'])) {
        http_response_code(202);
        print_r(json_encode("Necesitas ser un Usuario Verificado para Acceder a esta API"));
        die();
    } 

    include_once '../class/orders.php';

    $database = new Database();
    $db = $database->getConnection();
    
    $method = $_SERVER['REQUEST_METHOD'];
    
    switch ($method) {
        case 'POST':
            break;
        case 'GET':

            
            if($_GET['functions']==="chartsbars"){
                // STMT Orders
                $ordersInstance = new Orders($db);
                $stmtOrders = $ordersInstance->getAllFacturesLastSevenDays();
                $ordersCount = $stmtOrders->rowCount();

                $arrBody = array();

                if($ordersCount > 0){
                    while ($rowOrder = $stmtOrders->fetch(PDO::FETCH_ASSOC)){
                        extract($rowOrder);
                        $order = array(
                            'order_id'=>$order_id,
                            'order_table_id'=>$order_table_id,
                            'order_personal_document'=>$order_personal_document,
                            'order_list_inventary'=>$order_list_inventary,
                            'order_create'=>$order_create,
                            'order_done'=>$order_done,
                            'order_status'=> $order_status,
                            'order_price_dolar'=> $order_price_dolar
                        );
                        $arrBody["orders"][] = $order;
                    }
                }else{
                    $arrBody["orders"] = [];
                }

                if($ordersCount === 0 ){
                    http_response_code(202);
                    print_r(json_encode([]));
                }else{
                    http_response_code(200);
                    print_r(json_encode($arrBody, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES));
                }
            }
            
            if($_GET['functions']==="chartsDoughnut"){
                $ordersInstance = new Orders($db);
                $arrOrders = $ordersInstance->getAllFacturesLastFiveMonths();
                if($arrOrders!==null){
                    http_response_code(200);
                    print_r(json_encode($arrOrders, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES));
                }else{
                    http_response_code(200);
                    print_r(json_encode([], JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES));
                }
            }

            if($_GET['functions']==="chartsPolar"){
                $ordersInstance = new Orders($db);
                $arrOrders = $ordersInstance->getAllFacturesLastMonthPerInnkeeper();
                if($arrOrders!==null){
                    http_response_code(200);
                    print_r(json_encode($arrOrders, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES));
                }else{
                    http_response_code(200);
                    print_r(json_encode([], JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES));
                }
            }
            
            
            break;

        case 'PUT':

            
            break;

        case 'DELETE':
            break;

        default:
            print_r(json_encode("Method no válido"));
            break;
    }

?>