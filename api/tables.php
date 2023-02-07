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

    include_once '../class/tables.php';

    $database = new Database();
    $db = $database->getConnection();
    
    $method = $_SERVER['REQUEST_METHOD'];
    
    switch ($method) {
        case 'POST':
            
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);

            if($data['table_name']??$data['table_status']){
                
                $tablesInstance = new Tables($db);
                $tablesInstance->table_name = $data['table_name'];
                $tablesInstance->table_status = $data['table_status'];

                $stmtTables = $tablesInstance->getSingleTableByName();
                $tablesCount = $stmtTables->rowCount();
                   
                if($tablesCount === 0 ){
                    if($tablesInstance->createTable()){
                        $msg["created"] = true;
                    } else {
                        $msg["created"] = false;
                        $msg["message"] = "Error al registrar una Nueva Mesa";
                    }
                }else{
                    $msg["created"] = false;
                    $msg["message"] = "Esta Mesa ya existe.!";
                }
                
                
            }else{
                $msg["created"] = false;
                $msg["message"] = "No se han recibido datos";
            }
            print_r(json_encode($msg));
            break;
        case 'GET':

            // STMT Tables
            $tablesInstance = new Tables($db);
            $stmtTables = $tablesInstance->getAllTables();
            $tablesCount = $stmtTables->rowCount();

            $arrBody = array();
                
            if($tablesCount > 0){
                while ($rowTable = $stmtTables->fetch(PDO::FETCH_ASSOC)){
                    extract($rowTable);
                    $table = array(
                        'table_id'=>$table_id,
                        'table_name'=>$table_name,
                        'table_status'=>$table_status,
                        'table_active'=>$table_active
                    );
                    
                    $arrBody[] = $table;
                }
            }else{
                $arrBody = [];
            }

            if($tablesCount === 0){
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

            if($data['table_id']??$data['table_name']??$data['table_status']){

                $tablesInstance = new Tables($db);
                $tablesInstance->table_id = $data['table_id'];
                $tablesInstance->table_name = $data['table_name'];
                $tablesInstance->table_status = $data['table_status'];

                $stmtTables = $tablesInstance->getSingleTableById();
                $tablesCount = $stmtTables->rowCount();
                    
                if($tablesCount === 0 ){
                    $msg["modify"] = false;
                    $msg["message"] = "La Mesa no existe";
                }else{
                    if($tablesInstance->updateTable()){
                        $msg["modify"] = true;
                    } else {
                        $msg["modify"] = false;
                        $msg["message"] = "Error al registrar una Nueva Mesa";
                    }
                }
            }else{
                $msg["modify"] = false;
                $msg["message"] = "No se han recibido datos";
            }
            print_r(json_encode($msg));
            break;

        case 'DELETE':
            $tablesInstance = new Tables($db);
            $tablesInstance->table_id = $_GET['table_id'];

            $stmtTables = $tablesInstance->getSingleTableById();
            $tablesCount = $stmtTables->rowCount();
                    
            if($tablesCount === 0 ){
                $msg["delete"] = false;
            }else{
                if($tablesInstance->removeTable()){
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

?>