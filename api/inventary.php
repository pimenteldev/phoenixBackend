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

    include_once '../class/inventary.php';
    include_once '../class/inventaryCategories.php';
    include_once '../class/inventaryUnits.php';
    include_once '../class/inventaryOperations.php';
    include_once '../class/settings.php';

    $database = new Database();
    $db = $database->getConnection();
    
    $method = $_SERVER['REQUEST_METHOD'];
    
    switch ($method) {
        case 'POST':
            if(!isset($_REQUEST['method'])){

                $json = file_get_contents('php://input');
                $data = json_decode($json, true);

                if($data['item_name']??$data['item_category']??$data['item_uni_metric']){
                    
                    $inventaryInstance = new Inventary($db);
                    $inventaryInstance->item_name = $data['item_name'];
                    $stmtInventary = $inventaryInstance->getSingleInventaryItemByName();
                    $itemsInventaryCount = $stmtInventary->rowCount();
                    
                    if($itemsInventaryCount === 0 ){
                        $inventaryInstance->item_category = $data['item_category'];
                        $inventaryInstance->item_uni_metric = $data['item_uni_metric'];
                        if($inventaryInstance->createItemInInventary()){
                            $msg["created"] = true;
                        } else {
                            $msg["created"] = false;
                            $msg["message"] = "Error al registrar un Nuevo Producto en Inventario";
                        }
                    }else{
                        $msg["created"] = false;
                        $msg["message"] = "Esta Producto ya existe.!";
                    }
                
                
                }else{
                    $msg["created"] = false;
                    $msg["message"] = "No se han recibido datos";
                }
            }else{
                $data = json_decode($_REQUEST['operation'],true);
                if($data['operation_type']??$data['operation_item_id']??$data['operation_category']??$data['operation_unit']??$data['operation_count']){
                    
                    $inventaryInstance = new Inventary($db);
                    $inventaryInstance->item_id = $data['operation_item_id'];
                    $stmtInventary = $inventaryInstance->getSingleInventaryItemById();
                    $itemsInventaryCount = $stmtInventary->rowCount();

                    if($itemsInventaryCount === 0 ){
                        $msg["operation"] = false;
                        $msg["message"] = "El producto no Existe.!";
                    }else{
                        
                        $operationsArr = array();
                        $operationsArr["operation"] = array();
                        while ($row = $stmtInventary->fetch(PDO::FETCH_ASSOC)){
                            extract($row);
                            $operation = array(
                                "item_id" => $item_id,
                                "item_count" => $item_count
                            );
                
                            array_push($operationsArr["operation"], $operation);
                        }

                        $count_base = $operationsArr["operation"][0]["item_count"];
                        
                        $count_operation = 0;
                        $operation_type = intval($data['operation_type']);
                        if($operation_type===1){
                            $count_operation = $count_base + floatval($data['operation_count']);
                        }else{
                            $count_operation = $count_base - floatval($data['operation_count']);
                        }

                        $inventaryInstance->item_count = $count_operation;

                        if($inventaryInstance->updateCountItemInInventary()){
                            $msg["operation"] = true;

                            $operationsInstance = new InventaryOperations($db);
                            $operationsInstance->operation_type = $data['operation_type'];
                            $operationsInstance->operation_item_id = $data['operation_item_id'];
                            $operationsInstance->operation_category = $data['operation_category'];
                            $operationsInstance->operation_unit = $data['operation_unit'];
                            $operationsInstance->operation_count = $data['operation_count'];

                            $operationsInstance->createInventaryOperation();
                        } else {
                            $msg["operation"] = false;
                            $msg["message"] = "Error al realizar operación en Inventario";
                        }
                    }

                }else{
                    $msg["operation"] = false;
                    $msg["message"] = "No se han recibido datos";
                }   
            }
            print_r(json_encode($msg));
            break;
        case 'GET':

            // STMT Inventary
            $inventaryInstance = new Inventary($db);
            $stmtItemsInventary = $inventaryInstance->getAllItemsIngredients();
            $itemsInventaryCount = $stmtItemsInventary->rowCount();

            // STMT InventaryCategories
            $inventaryCategoriesInstance = new InventaryCategories($db);
            $stmtInventaryCategories = $inventaryCategoriesInstance->getAllInventaryCategories();
            $itemsInventaryCategoriesCount = $stmtInventaryCategories->rowCount();

            // STMT InventaryUnits
            $inventaryUnitsInstance = new InventaryUnits($db);
            $stmtInventaryUnits = $inventaryUnitsInstance->getAllUnits();
            $itemsInventaryUnitsCount = $stmtInventaryUnits->rowCount();

            // STMT Settings
            $settingsInstance = new Settings($db);
            $stmtSettings = $settingsInstance->getAllSettings();
            $settingsCount = $stmtSettings->rowCount();

            $arrBody = array();
                
            if($itemsInventaryCount > 0){
                while ($rowInventary = $stmtItemsInventary->fetch(PDO::FETCH_ASSOC)){
                    extract($rowInventary);
                    $item = array(
                        'item_id'=>$item_id,
                        'item_name'=>$item_name,
                        'item_category'=>$item_category,
                        'item_uni_metric'=>$item_uni_metric,
                        'item_count'=>$item_count,
                        'item_create'=>$item_create,
                        'item_status'=>$item_status
                    );
                                
                    $arrBody["items"][] = $item;
                }
            }else{
                $arrBody["items"] = [];
            }

            if($itemsInventaryCategoriesCount > 0){
                while ($rowInventaryCategory = $stmtInventaryCategories->fetch(PDO::FETCH_ASSOC)){
                    extract($rowInventaryCategory);
                    $category = array(
                        'category_id'=>$category_id,
                        'category_name'=>$category_name,
                        'category_color'=>$category_color,
                        'category_ingredient'=>$category_ingredient
                    );
                                
                    $arrBody["items_categories"][] = $category;
                }
            }else{
                $arrBody["items_categories"] = [];
            }

            if($itemsInventaryUnitsCount > 0){
                while ($rowInventaryUnit = $stmtInventaryUnits->fetch(PDO::FETCH_ASSOC)){
                    extract($rowInventaryUnit);
                    $unit = array(
                        'unit_id'=>$unit_id,
                        'unit_name'=>$unit_name,
                        'unit_type'=>$unit_type
                    );

                    $arrBody["units"][] = $unit;
                }
            }else{
                $arrBody["units"] = [];
            }

            if($settingsCount > 0){
                while ($rowSetting = $stmtSettings->fetch(PDO::FETCH_ASSOC)){
                    extract($rowSetting);

                    $setting = array(
                        'count_items_inventary'=>$count_items_inventary,
                    );
                    
                    $arrBody["settings"][] = $setting;
                }
            }else{
                $arrBody["settings"] = [];
            }

            if($itemsInventaryCount === 0 || $itemsInventaryCategoriesCount === 0 || $itemsInventaryUnitsCount === 0 || $settingsCount === 0){
                http_response_code(202);
                print_r(json_encode([]));
            }else{
                http_response_code(200);
                print_r(json_encode($arrBody, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES));
            }
            break;

        case 'PUT':
            
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);

            if($data['item_id']??$data['item_name']??$data['item_category']??$data['item_uni_metric']??$data['item_status']){

                $inventaryInstance = new Inventary($db);
                $inventaryInstance->item_id = $data['item_id'];
                $stmtInventary = $inventaryInstance->getSingleInventaryItemById();
                $itemsInventaryCount = $stmtInventary->rowCount();
                    

                if($itemsInventaryCount === 0 ){
                    $msg["modify"] = false;
                    $msg["message"] = "El producto no Existe.!";
                }else{
                    $inventaryInstance->item_name = $data['item_name'];
                    $inventaryInstance->item_category = $data['item_category'];
                    $inventaryInstance->item_uni_metric = $data['item_uni_metric'];
                    $inventaryInstance->item_status = $data['item_status'];

                    if($inventaryInstance->updateItemInInventary()){
                        $msg["modify"] = true;
                    } else {
                        $msg["modify"] = false;
                        $msg["message"] = "Error al Modificar el Producto";
                    }
                }
            }else{
                $msg["modify"] = false;
                $msg["message"] = "No se han recibido datos";
            }
            print_r(json_encode($msg));
            break;

        case 'DELETE':
            $inventaryInstance = new Inventary($db);
            $inventaryInstance->item_id = $_GET['item_id'];

            $stmtInventary = $inventaryInstance->getSingleInventaryItemById();
            $itemsInventaryCount = $stmtInventary->rowCount();
                    
            if($itemsInventaryCount === 0 ){
                $msg["delete"] = false;
            }else{
                if($inventaryInstance->removeItemInInventary()){
                    $msg["delete"] = true;
                } else{
                    $msg["delete"] = false;
                }
            }
            print_r(json_encode($msg));
            break;

        default:
            print_r(json_encode("Method no válido"));
            break;
    }
