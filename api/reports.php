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
            if(file_get_contents('php://input')===""){
                print_r (json_encode([], JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
            }else{
                
                $json = file_get_contents('php://input');
  		        $data = json_decode($json,true);

                $arrOrders = array();

                $ordersInstance = new Orders($db);
                
                if($data["initial_day"]!==null || $data["initial_day"]!== ""){
                    $ordersInstance->initial_day = $data["initial_day"];
                }

                if($data["final_day"]!==null || $data["final_day"]!== ""){
                    $ordersInstance->final_day = $data["final_day"];
                }

                if($data["num_facture"]!==null || $data["num_facture"]!== ""){
                    $ordersInstance->num_facture = $data["num_facture"];
                }

                if($data["keyword"]!==null || $data["keyword"]!== ""){
                    $ordersInstance->keyword = $data["keyword"];
                }
                
                $arrOrders = $ordersInstance->searchFactures();
                

                if($arrOrders!==null){
                    http_response_code(200);
                    print_r(json_encode($arrOrders, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES));
                }else{
                    http_response_code(200);
                    print_r(json_encode([], JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES));
                }


            }
            break;
        case 'GET':
            if(file_get_contents('php://input')===""){
                print_r (json_encode([], JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
            }else{
                print_r (json_encode([], JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
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