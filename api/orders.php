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

    include_once '../class/products.php';
    include_once '../class/categories.php';
    include_once '../class/inventary.php';
    include_once '../class/inventaryCategories.php';
    include_once '../class/inventaryUnits.php';
    include_once '../class/role.php';
    include_once '../class/personals.php';
    include_once '../class/tables.php';
    include_once '../class/settings.php';
    include_once '../class/orders.php';

    $database = new Database();
    $db = $database->getConnection();
    
    $method = $_SERVER['REQUEST_METHOD'];
    
    switch ($method) {
        case 'POST':
            
            if($_REQUEST['functionOrders']==="newOrder"){
                $data = json_decode($_REQUEST['order'],true);

                if($data['list_inventary']??$data['table_id']??$data['personal_document']){
                    // STMT Orders
                    $ordersInstance = new Orders($db);
                    $ordersInstance->order_list_inventary = $data['list_inventary'];
                    $ordersInstance->order_table_id = $data['table_id'];
                    $ordersInstance->order_personal_document = $data['personal_document'];

                    if($ordersInstance->createNewOrder()){
                        $msg["create"] = true;
                        
                        $tablesInstance = new Tables($db);
                        $tablesInstance->table_id = $data['table_id'];
                        $stmtTables = $tablesInstance->getSingleTableById();
                        $tablesCount = $stmtTables->rowCount();

                        if($tablesCount === 1 ){
                            $tablesInstance->updateTableWithNewOrder();
                        }

                    } else {
                        $msg["create"] = false;
                        $msg["message"] = "No se logró Generar el Pedido";
                    }
                    

                }else{
                    $msg["create"] = false;
                    $msg["message"] = "No se han recibido datos";
                }    

            }else if($_REQUEST['functionOrders']==="newFacture"){
                $data = json_decode($_REQUEST['order'],true);
                if($data['list_inventary']??$data['table_id']??$data['personal_document']){
                    if($data['order_id']!==0){
                        // STMT Orders
                        $ordersInstance = new Orders($db);
                        $ordersInstance->order_id = $data['order_id'];

                        $stmtOrders = $ordersInstance->getOrderById();
                        $ordersCount = $stmtOrders->rowCount();

                        if($ordersCount >= 1){
                            $ordersInstance->order_id = $data['order_id'];
                            $ordersInstance->facturationNumber = $data['facturationNumber'];
                            $ordersInstance->controlNumber = $data['control_number'];
                            $ordersInstance->order_list_inventary = $data['list_inventary'];
                            $ordersInstance->client_document = $data['client_document'];
                            $ordersInstance->client_name = $data['client_name'];
                            $ordersInstance->client_address = $data['client_address'];
                            $ordersInstance->client_phone_number = $data['client_phone_number'];
                            $ordersInstance->order_price_dolar = $data['order_price_dolar'];
                            $ordersInstance->order_percent_iva = $data['order_percent_iva'];
                            $ordersInstance->subtotal = $data['subtotal'];
                            $ordersInstance->totalfinal = $data['totalfinal'];
                            

                            if($ordersInstance->updateOrderToFacture()){
                                $msg["create"] = true;

                                //CHANGE STATE OF TABLE
                                $tablesInstance = new Tables($db);
                                $tablesInstance->table_id = $data['table_id'];
                                $stmtTables = $tablesInstance->getSingleTableById();
                                $tablesCount = $stmtTables->rowCount();

                                if($tablesCount === 1 ){
                                    $tablesInstance->updateTableAfterCreateFacture();
                                }
                                //DISCOUNT ITEMS IN INVENTARY
                                $inventaryInstance = new Inventary($db);
                                $inventaryInstance->list_inventary = $data['list_inventary'];
                                $inventaryInstance->discountItemsInFacture();

                            } else {
                                $msg["create"] = false;
                                $msg["message"] = "Error al Actualizar el Pedido";
                            }
                        }else{
                            $msg["create"] = false;
                            $msg["message"] = "Pedido no Existe";  
                        }

                    }else{
                        // STMT Orders
                        $ordersInstance = new Orders($db);
                        $ordersInstance->facturationNumber = $data['facturationNumber'];
                        $ordersInstance->controlNumber = $data['control_number'];
                        $ordersInstance->order_table_id = $data['table_id'];
                        $ordersInstance->order_personal_document = $data['personal_document'];
                        $ordersInstance->order_list_inventary = $data['list_inventary'];
                        $ordersInstance->client_document = $data['client_document'];
                        $ordersInstance->client_name = $data['client_name'];
                        $ordersInstance->client_address = $data['client_address'];
                        $ordersInstance->client_phone_number = $data['client_phone_number'];
                        $ordersInstance->order_price_dolar = $data['order_price_dolar'];
                        $ordersInstance->order_percent_iva = $data['order_percent_iva'];
                        $ordersInstance->subtotal = $data['subtotal'];
                        $ordersInstance->totalfinal = $data['totalfinal'];

                        if($ordersInstance->createNewFacture()){
                            $msg["create"] = true;

                            //CHANGE STATE OF TABLE
                            $tablesInstance = new Tables($db);
                            $tablesInstance->table_id = $data['table_id'];
                            $stmtTables = $tablesInstance->getSingleTableById();
                            $tablesCount = $stmtTables->rowCount();

                            if($tablesCount === 1 ){
                                $tablesInstance->updateTableAfterCreateFacture();
                            }
                            //DISCOUNT ITEMS IN INVENTARY
                            $inventaryInstance = new Inventary($db);
                            $inventaryInstance->list_inventary = $data['list_inventary'];
                            $inventaryInstance->discountItemsInFacture();
                                

                        } else {
                            $msg["create"] = false;
                            $msg["message"] = "Error al crear el Pedido";
                        }
                        
                    }
                }else{
                    $msg["create"] = false;
                    $msg["message"] = "No se han recibido datos";
                } 
            }
            print_r(json_encode($msg));
            break;
        case 'GET':

            // STMT Products
            $productsInstance = new Products($db);
            $stmtProducts = $productsInstance->getAllProducts();
            $productsCount = $stmtProducts->rowCount();

            // STMT Categories
            $categoriesInstance = new Categories($db);
            $stmtCategories = $categoriesInstance->getAllCategories();
            $categoriesCount = $stmtCategories->rowCount();

            // STMT Inventary
            $inventaryInstance = new Inventary($db);
            $stmtItemsInventary = $inventaryInstance->getAllItemsIngredients();
            $itemsInventaryCount = $stmtItemsInventary->rowCount();

            // STMT InventaryCategories
            $inventaryCategoriesInstance = new InventaryCategories($db);
            $stmtInventaryCategories = $inventaryCategoriesInstance->getAllInventaryCategoriesIngredient();
            $itemsInventaryCategoriesCount = $stmtInventaryCategories->rowCount();

            // STMT InventaryUnits
            $inventaryUnitsInstance = new InventaryUnits($db);
            $stmtInventaryUnits = $inventaryUnitsInstance->getAllUnits();
            $itemsInventaryUnitsCount = $stmtInventaryUnits->rowCount();

            // STMT Role
            $roleInstance = new Role($db);
            $stmtRole = $roleInstance->getAllInnkeepers();
            $rolesCount = $stmtRole->rowCount();

            // STMT Personals
            $personalsInstance = new Personals($db);
            $stmtPersonals = $personalsInstance->getAllPersonalsInnkeeper();
            $personalsCount = $stmtPersonals->rowCount();

            // STMT Tables
            $tablesInstance = new Tables($db);
            $stmtTables = $tablesInstance->getAllTables();
            $tablesCount = $stmtTables->rowCount();

            // STMT Settings
            $settingsInstance = new Settings($db);
            $stmtSettings = $settingsInstance->getAllSettings();
            $settingsCount = $stmtSettings->rowCount();

            // STMT Orders
            $ordersInstance = new Orders($db);
            $stmtOrders = $ordersInstance->getAllOrders();
            $ordersCount = $stmtOrders->rowCount();

            $arrBody = array();

            if($productsCount > 0){
                while ($rowProduct = $stmtProducts->fetch(PDO::FETCH_ASSOC)){
                    extract($rowProduct);
                    $product = array(
                        'product_id'=>$product_id,
                        'product_name'=>$product_name,
                        'product_description'=>$product_description,
                        'product_base_price'=>$product_base_price,
                        'product_category'=>$product_category,
                        'product_items'=> $product_items,
                        'product_photo'=>$product_photo,
                        'product_photo_thumb'=>$product_photo_thumb,
                        'product_status'=>$product_status
                    );

                    $arrBody["products"][] = $product;
                }
            }else{
                $arrBody["products"] = [];
            }

            if($categoriesCount > 0){
                while ($rowCategory = $stmtCategories->fetch(PDO::FETCH_ASSOC)){
                    extract($rowCategory);
                    $category = array(
                        'category_id'=>$category_id,
                        'category_name'=>$category_name,
                        'category_color'=>$category_color
                    );                        

                    $arrBody["categories"][] = $category;
                }
            }else{
                $arrBody["categories"] = [];
            }

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

            if($rolesCount > 0){
                while ($rowRole = $stmtRole->fetch(PDO::FETCH_ASSOC)){
                    extract($rowRole);
                    $role = array(
                        'role_id'=>$role_id,
                        'role_name'=>$role_name,
                        'role_color'=>$role_color,
                        'role_seller'=>$role_seller
                    );
                    $arrBody["role"][] = $role;
                }
            }else{
                $arrBody["role"] = [];
            }

            if($personalsCount > 0){
                while ($rowPersonal = $stmtPersonals->fetch(PDO::FETCH_ASSOC)){
                    extract($rowPersonal);
                    $personal = array(
                        'personal_document'=>$personal_document,
                        'personal_alias'=>$personal_alias,
                        'personal_name'=>$personal_name,
                        'personal_role'=>$personal_role,
                        'personal_photo'=>$personal_photo,
                        'personal_photo_thumb'=>$personal_photo_thumb,
                        'personal_status'=>$personal_status,
                    );
                    $arrBody["personal"][] = $personal;
                }
            }else{
                $arrBody["personal"] = [];
            }

            if($tablesCount > 0){
                while ($rowTable = $stmtTables->fetch(PDO::FETCH_ASSOC)){
                    extract($rowTable);
                    $table = array(
                        'table_id'=>$table_id,
                        'table_name'=>$table_name,
                        'table_status'=>$table_status,
                        'table_active'=>$table_active
                    );
                    
                    $arrBody["mesas"][] = $table;
                }
            }else{
                $arrBody["mesas"] = [];
            }

            if($settingsCount > 0){
                while ($rowSetting = $stmtSettings->fetch(PDO::FETCH_ASSOC)){
                    extract($rowSetting);

                    $stmtOrdersFactures = $ordersInstance->getFacturationOrder();
                    $facturesCount = $stmtOrdersFactures->rowCount();

                    $setting = array(
                        'price_dollar'=>$price_dollar,
                        'percent_iva'=>$percent_iva,
                        'count_items_inventary'=>$count_items_inventary,
                        'num_control'=>$num_control,
                        'num_last_facture'=>$facturesCount,
                        'facturation_initial'=>$facturation_initial
                    );
                    
                    $arrBody["settings"][] = $setting;
                }
            }else{
                $arrBody["settings"] = [];
            }

            if($ordersCount > 0){
                while ($rowOrder = $stmtOrders->fetch(PDO::FETCH_ASSOC)){
                    extract($rowOrder);
                    $order = array(
                        'order_id'=>$order_id,
                        'order_table_id'=>$order_table_id,
                        'order_personal_document'=>$order_personal_document,
                        'order_list_inventary'=>$order_list_inventary,
                        'order_create'=>$order_create,
                        'order_status'=> $order_status
                    );
                    $arrBody["orders"][] = $order;
                }
            }else{
                $arrBody["orders"] = [];
            }


            if($productsCount === 0 && $categoriesCount === 0 && $itemsInventaryCount === 0 && $itemsInventaryCategoriesCount === 0 && $itemsInventaryUnitsCount === 0 && $rolesCount == 0 && $tablesCount === 0 && $settingsCount === 0 && $ordersCount === 0){
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
            if($data['list_inventary']??$data['order_id']){
                // STMT Orders
                $ordersInstance = new Orders($db);
                $ordersInstance->order_id = $data['order_id'];

                $stmtOrders = $ordersInstance->getOrderById();
                $ordersCount = $stmtOrders->rowCount();

                if($ordersCount >= 1){
                    $ordersInstance->order_list_inventary = $data['list_inventary'];
                    
                    if($ordersInstance->updateOrder()){
                        $msg["modify"] = true;
                    } else {
                        $msg["modify"] = false;
                        $msg["message"] = "Error al Actualizar el Pedido";
                    }
                }else{
                    $msg["modify"] = false;
                    $msg["message"] = "Pedido no Existe";  
                }
            }else{
                $msg["modify"] = false;
                $msg["message"] = "No se han recibido datos";
            }   
            print_r(json_encode($msg));
            break;

        case 'DELETE':
            print_r(json_encode("DELETE"));
            break;

        default:
            print_r(json_encode("Method no válido"));
            break;
    }

?>