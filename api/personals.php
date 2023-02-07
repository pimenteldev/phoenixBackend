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

    include_once '../class/personals.php';
    include_once '../class/role.php';
    
    include_once '../functions/upload_file.php';

    $database = new Database();
    $db = $database->getConnection();
    
    $method = $_SERVER['REQUEST_METHOD'];
    
    switch ($method) {
        case 'POST':
            if(isset($_REQUEST['method'])){
                $data = json_decode($_REQUEST['personal'],true);

                if($data['personal_document']??$data['personal_name']??$data['personal_alias']??$data['personal_role']??$data['personal_photo']){
                        
                    $personalsInstance = new Personals($db);
                    $personalsInstance->personal_document = $data['personal_document'];
                     
                    $stmtPersonals = $personalsInstance->getSinglePersonal();
                    $personalsCount = $stmtPersonals->rowCount();

                    if($personalsCount === 0 ){
                        $msg["modify"] = false;
                        $msg["message"] = "El Personal No existe.!";
                        
                    }else{

                        if(empty($_FILES["file"]["tmp_name"])){
                            $personal_photo = $_REQUEST["photo_prev"];
                        }else{
                            $url_image = $_REQUEST["photo"];
                            $location = $_REQUEST["location"];
                            $tipo = $_FILES["file"]["type"];
                            $archivo = $_FILES["file"]["tmp_name"];
                            $personal_photo = uploadImage($tipo,$archivo,$url_image,$location);
                            removeImage($_REQUEST['photo_prev'],"personal");
                        }

                        $personalsInstance->personal_alias = $data['personal_alias'];
                        $personalsInstance->personal_name = $data['personal_name'];
                        $personalsInstance->personal_role = $data['personal_role'];
                        $personalsInstance->personal_photo = $personal_photo;
                        $personalsInstance->personal_photo_thumb = "";
                        $personalsInstance->personal_status = $data['personal_status'];
                        
    
                        if($personalsInstance->updatePersonal()){
                            $msg["modify"] = true;
                        } else{
                            $msg["modify"] = false;
                            $msg["message"] = "Error al registrar un Editar Personal";
                        }
                    }
                }else{
                    $msg["modify"] = false;
                    $msg["message"] = "No se han recibido datos";
                }
            
            }else{
                
                if(isset($_REQUEST['personal'])){
                    $data = json_decode($_REQUEST['personal'],true);

                    if($data['personal_document']??$data['personal_name']??$data['personal_alias']??$data['personal_role']??$data['personal_photo']){
                        
                        $personalsInstance = new Personals($db);
                        $personalsInstance->personal_document = $data['personal_document'];
                         
                        $stmtPersonals = $personalsInstance->getSinglePersonal();
                        $personalsCount = $stmtPersonals->rowCount();

                        if($personalsCount === 0 ){
                            $url_image = $_REQUEST["photo"];
                            $location = $_REQUEST["location"];
                            $tipo = $_FILES["file"]["type"];
                            $archivo = $_FILES["file"]["tmp_name"];
                            
                            $personal_photo = uploadImage($tipo,$archivo,$url_image,$location);
                            
                            $personalsInstance->personal_alias = $data['personal_alias'];
                            $personalsInstance->personal_name = $data['personal_name'];
                            $personalsInstance->personal_role = $data['personal_role'];
                            $personalsInstance->personal_photo = $personal_photo;
                            $personalsInstance->personal_photo_thumb = "";
                           
                            if($personalsInstance->createPersonal()){
                                $msg["created"] = true;
                            } else{
                                $msg["created"] = false;
                                $msg["message"] = "Error al registrar un Nuevo Personal";
                            }
                        }else{
                            $msg["created"] = false;
                            $msg["message"] = "El Personal ya existe.!";
                        }
                    }else{
                        $msg["created"] = false;
                        $msg["message"] = "No se han recibido datos";
                    }
                }else{
                    $msg["created"] = false;
                    $msg["message"] = "No se han recibido datos";
                }
            }
            
            print_r(json_encode($msg));
            break;
        case 'GET':

            // STMT Personals
            $personalsInstance = new Personals($db);
            $stmtPersonals = $personalsInstance->getAllPersonals();
            $personalsCount = $stmtPersonals->rowCount();

            // STMT Role
            $roleInstance = new Role($db);
            $stmtRole = $roleInstance->getAllRoles();
            $roleCount = $stmtRole->rowCount();

            $arrBody = array();
                
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

            if($roleCount > 0){
                while ($rowRole = $stmtRole->fetch(PDO::FETCH_ASSOC)){
                    extract($rowRole);
                    $role = array(
                        'role_id'=>$role_id,
                        'role_name'=>$role_name,
                        'role_color'=>$role_color
                    );
                    $arrBody["role"][] = $role;
                }
            }else{
                $arrBody["role"] = [];
            }

            if($personalsCount === 0 && $roleCount === 0){
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
            $personalsInstance = new Personals($db);
            $personalsInstance->personal_document = $_GET['personal_document'];

            $stmtPersonals = $personalsInstance->getSinglePersonal();
            $personalsCount = $stmtPersonals->rowCount();
                    
            if($personalsCount === 0 ){
                $msg["delete"] = false;
            }else{
                if($personalsInstance->removePersonal()){
                    removeImage($_GET['personal_photo'],"personal");
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