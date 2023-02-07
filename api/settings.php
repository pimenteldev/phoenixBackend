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

    include_once '../class/settings.php';

    $database = new Database();
    $db = $database->getConnection();
    
    $method = $_SERVER['REQUEST_METHOD'];
    
    switch ($method) {
        case 'POST':
            if($_REQUEST['functions']==="dolar"){
                $data = json_decode($_REQUEST['settings'],true);

                // STMT Settings
                $settingsInstance = new Settings($db);
                $settingsInstance->id = $data['id'];
                $settingsInstance->price_dollar = $data['price_dollar'];

                if($settingsInstance->updateDolar()){
                    $msg["modify"] = true;
                } else {
                    $msg["modify"] = false;
                    $msg["message"] = "Error al Modificar settings";
                }

            }
            
            if($_REQUEST['functions']==="iva"){
                $data = json_decode($_REQUEST['settings'],true);

                // STMT Settings
                $settingsInstance = new Settings($db);
                $settingsInstance->id = $data['id'];
                $settingsInstance->percent_iva = $data['percent_iva'];

                if($settingsInstance->updateIva()){
                    $msg["modify"] = true;
                } else {
                    $msg["modify"] = false;
                    $msg["message"] = "Error al Modificar settings";
                }
                
            }
            
            if($_REQUEST['functions']==="count"){
                $data = json_decode($_REQUEST['settings'],true);

                // STMT Settings
                $settingsInstance = new Settings($db);
                $settingsInstance->id = $data['id'];
                $settingsInstance->count_items_inventary = $data['count_items_inventary'];

                if($settingsInstance->updateCountItemsInventary()){
                    $msg["modify"] = true;
                } else {
                    $msg["modify"] = false;
                    $msg["message"] = "Error al Modificar settings";
                }

            }
            print_r(json_encode($msg));
            break;
        case 'GET':

            // STMT Settings
            $settingsInstance = new Settings($db);
            $stmtSettings = $settingsInstance->getAllSettings();
            $settingsCount = $stmtSettings->rowCount();

            $arrBody = array();
                
            if($settingsCount > 0){
                while ($rowSetting = $stmtSettings->fetch(PDO::FETCH_ASSOC)){
                    extract($rowSetting);
                    $setting = array(
                        'id'=>$id,
                        'price_dollar'=>$price_dollar,
                        'percent_iva'=>$percent_iva,
                        'count_items_inventary'=>$count_items_inventary,
                        'num_control'=>$num_control,
                        'facturation_initial'=>$facturation_initial
                    );
                    
                    $arrBody["settings"][] = $setting;
                }
            }else{
                $arrBody["settings"] = [];
            }

            if($settingsCount === 0){
                http_response_code(202);
                print_r(json_encode([]));
            }else{
                http_response_code(200);
                print_r(json_encode($arrBody, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES));
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