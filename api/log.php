<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if (isset($_SESSION['user'])) {
    http_response_code(202);
    print_r(json_encode("Necesitas ser un Usuario Verificado para Acceder a esta API"));
    die();
}

include_once '../config/database.php';
include_once '../class/users.php';


$database = new Database();
$db = $database->getConnection();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {

    case 'POST':

        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        $item = new User($db);

        $item->user_id = isset($data["user_id"]) ? $data["user_id"] : die();
        $item->user_psw = isset($data["user_psw"]) ? md5($data["user_psw"]) : die();

        $stmt = $item->login();
        $itemCount = $stmt->rowCount();

        if ($itemCount > 0) {
            http_response_code(200);
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            $user_arr = array(
                "user_id" =>  $dataRow['user_id'],
                "user_name" => $dataRow['user_name'],
                "user_photo" => $dataRow['user_photo'],
                "user_rol" => $dataRow['user_rol']
            );
            print_r(json_encode($user_arr, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        } else {
            http_response_code(202);
            print_r(json_encode([]));
        }
        break;

    default:
        print_r(json_encode("Method no válido"));
        break;
}
