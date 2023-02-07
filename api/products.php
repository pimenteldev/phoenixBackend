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

    include_once '../functions/upload_file.php';

    $database = new Database();
    $db = $database->getConnection();
    
    $method = $_SERVER['REQUEST_METHOD'];
    
    switch ($method) {
        case 'POST':

            $product = new Products($db);
            if(isset($_REQUEST['method'])){

                $data = json_decode($_REQUEST['product'],true);
                $product_photo=null;

                if($data['product_id']??$data['product_name']??$data['product_description']??$data['product_base_price']??$data['product_category']??$data['product_items']??$data['product_status']){

                    $product->product_id = $data['product_id'];
                    $product->product_name = $data['product_name'];
                    $product->product_description = $data['product_description'];
                    $product->product_base_price = $data['product_base_price'];
                    $product->product_category = $data['product_category'];
                    $product->product_items = $data['product_items'];
                    $product->product_status = $data['product_status'];
                    
                    $stmtProducts = $product->getSingleProductById();
                    $productsCount = $stmtProducts->rowCount();

                    if($productsCount === 0 ){
                        $msg["modify"] = false;
                        $msg["message"] = "El Producto no existe";
                    }else{
                        if(empty($_FILES["file"]["tmp_name"])){
                            $product_photo = $_REQUEST["photo_prev"];
                        }else{
                            $url_image = $_REQUEST["photo"];
                            $location = $_REQUEST["location"];
                            $tipo = $_FILES["file"]["type"];
                            $archivo = $_FILES["file"]["tmp_name"];
                            $product_photo = uploadImage($tipo,$archivo,$url_image,$location);
                            removeImage($_REQUEST['photo_prev'],"productos");
                        }
                        $product->product_photo = $product_photo;
                        $product->product_photo_thumb = "";
                        
    
                        if($product->updateProduct()){
                            $msg["modify"] = true;
                        } else{
                            $msg["modify"] = false;
                            $msg["message"] = "Error al registrar un Editar Producto";
                        }
                    }
                }else{
                    $msg["modify"] = false;
                    $msg["message"] = "No se han recibido datos";
                }
                print_r(json_encode($msg));
            }else{
                if(isset($_REQUEST['product'])){
                    $data = json_decode($_REQUEST['product'],true);

                    if($data['product_id']??$data['product_name']??$data['product_description']??$data['product_base_price']??$data['product_category']??$data['product_items']){

                        $product->product_id = $data['product_id'];
                        $product->product_name = $data['product_name'];
                        $product->product_description = $data['product_description'];
                        $product->product_base_price = $data['product_base_price'];
                        $product->product_category = $data['product_category'];
                        $product->product_items = $data['product_items'];

                        $stmtProducts = $product->getSingleProductByIDAndName();
                        $productsCount = $stmtProducts->rowCount();

                        if($productsCount === 0 ){
                            $url_image = $_REQUEST["photo"];
                            $location = $_REQUEST["location"];
                            $tipo = $_FILES["file"]["type"];
                            $archivo = $_FILES["file"]["tmp_name"];

                            $product_photo = uploadImage($tipo,$archivo,$url_image,$location);
                            $product->product_photo = $product_photo;
                            $product->product_photo_thumb = "";

                            if($product->createProduct()){
                                $msg["created"] = true;
                            } else{
                                $msg["created"] = false;
                                $msg["message"] = "Error al registrar un Nuevo Producto";
                            }
                        }else{
                            $msg["created"] = false;
                            $msg["message"] = "El Producto ya existe.!";
                        }
                    }else{
                        $msg["created"] = false;
                        $msg["message"] = "No se han recibido datos";
                    }
                }else{
                    $msg["created"] = false;
                    $msg["message"] = "No se han recibido datos";
                }
                print_r(json_encode($msg));
            }
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

            if($productsCount === 0 && $categoriesCount === 0 && $itemsInventaryCount === 0 && $itemsInventaryCategoriesCount === 0 && $itemsInventaryUnitsCount === 0){
                http_response_code(202);
                print_r(json_encode([]));
            }else{
                http_response_code(200);
                print_r(json_encode($arrBody, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES));
            }
            break;

        case 'PUT':
            print_r(json_encode("PUT"));
            break;

        case 'DELETE':
            $product = new Products($db);
            $product->product_id = $_GET['product_id'];

            $stmtProducts = $product->getSingleProductById();
            $productsCount = $stmtProducts->rowCount();

            if($productsCount === 0 ){
                $msg["delete"] = false;
                $msg["message"] = "El Producto no existe";
            }else{
                if($product->removeProduct()){
                    removeImage($_GET['product_photo'],"productos");
                    $msg["delete"] = true;
                } else{
                    $msg["delete"] = false;
                    $msg["message"] = "El Producto pudo Eliminarse";
                }
            }
            print_r(json_encode($msg));
            break;

        default:
            print_r(json_encode("Method no válido"));
            break;
    }

?>