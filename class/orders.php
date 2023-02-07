<?php
class Orders
{
    // Connection
    private $conn;
    // Table
    private $db_table = "orders";
    private $db_table_innerTables = "tables";
    private $db_table_innerPersonals = "personals";
    // Columns
    public $order_id;
    public $facturationNumber;
    public $controlNumber;
    public $order_table_id;
    public $order_personal_document;
    public $order_list_inventary;
    public $order_create;
    public $order_done;
    public $order_status;
    public $client_document;
    public $client_name;
    public $client_address;
    public $client_phone_number;
    public $order_price_dolar;
    public $order_percent_iva;
    public $subtotal;
    public $totalfinal;
    public $today;
    public $month;

    public $initial_day;
    public $final_day;
    public $num_facture;
    public $keyword;

    // Db connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllOrders()
    {
        $sqlQuery = "SELECT
                        order_id, 
                        order_table_id, 
                        order_personal_document, 
                        order_list_inventary,
                        order_create,
                        order_status
                        FROM
                        " . $this->db_table . " AS o 
                        INNER JOIN 
                        " . $this->db_table_innerTables . " AS t 
                        INNER JOIN 
                        " . $this->db_table_innerPersonals . " AS p 
                        ON o.order_status=0 
                        AND t.table_id = o.order_table_id 
                        AND p.personal_document=o.order_personal_document ";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    public function getAllFacturesLastSevenDays()
    {

        $today = date('Y-m-d 23:59:59');
        $today_rest_7_days = date("Y-m-d 23:59:59", strtotime($today . " - 7 days"));
        $sqlQuery = "SELECT
                        order_id, 
                        order_table_id, 
                        order_personal_document, 
                        order_list_inventary,
                        order_create,
                        order_done,
                        order_status,
                        order_price_dolar
                        FROM
                        " . $this->db_table . "
                        WHERE 
                        order_status=1 
                        AND 
                        order_done 
                        BETWEEN  
                        :today_rest_7_days 
                        AND 
                        :today";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(":today_rest_7_days", $today_rest_7_days);
        $stmt->bindParam(":today", $today);

        $stmt->execute();
        return $stmt;
    }

    public function getAllFacturesLastFiveMonths()
    {

        $today_internal = date('Y-m');
        $after_month = date("Y-m", strtotime($today_internal . " + 1 month"));

        $arrOrders = array();
        for ($i = 0; $i < 5; $i++) {

            $after_month_format = date("n-Y", strtotime($after_month . " - 1 month"));
            if ($i === 0) {

                $today = date('Y-m-31');
                $month = date("Y-m-01");
                $sqlQuery = "SELECT
                            order_id, 
                            order_table_id, 
                            order_personal_document, 
                            order_list_inventary,
                            order_create,
                            order_done,
                            order_status,
                            order_price_dolar,
                            totalfinal
                            FROM
                            " . $this->db_table . "
                            WHERE 
                            order_status=1 
                            AND 
                            order_done 
                            BETWEEN  
                            :month
                            AND 
                            :today
                            GROUP BY order_done ASC";

                $stmt = $this->conn->prepare($sqlQuery);
                $stmt->bindParam(":month", $month);
                $stmt->bindParam(":today", $today);
            } else {
                $sqlQuery = "SELECT
                            order_id, 
                            order_table_id, 
                            order_personal_document, 
                            order_list_inventary,
                            order_create,
                            order_done,
                            order_status,
                            order_price_dolar,
                            totalfinal
                            FROM
                            " . $this->db_table . "
                            WHERE 
                            order_status=1 
                            AND 
                            order_done 
                            BETWEEN  
                            :today_internal
                            AND 
                            :after_month 
                            GROUP BY order_done ASC";

                $stmt = $this->conn->prepare($sqlQuery);
                $stmt->bindParam(":after_month", $after_month);
                $stmt->bindParam(":today_internal", $today_internal);
            }

            $stmt->execute();

            $arrOrders[$after_month_format] = array();
            $total = 0;
            $price_dolar = 0;
            $totalrows = 0;
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $total += $totalfinal;
                $price_dolar = $order_price_dolar;
                $totalrows++;
            }

            $arrOrders[$after_month_format]["ventas_facturadas"] = $totalrows;
            $arrOrders[$after_month_format]["mes"] = intval(date("n", strtotime($after_month)));
            if ($total >= 1) {
                $arrOrders[$after_month_format]["total"] = $total / $price_dolar;
            } else {
                $arrOrders[$after_month_format]["total"] = 0;
            }


            $today_internal = date("Y-m-d", strtotime($today_internal . " - 1 months"));
            $after_month = date("Y-m-d", strtotime($after_month . " - 1 months"));
        }

        return $arrOrders;
    }

    public function getAllFacturesLastMonthPerInnkeeper()
    {


        $arrOrders = array();

        $today = date('Y-m-31');
        $month = date("Y-m-01");
        $sqlQuery = "SELECT
                            order_id, 
                            order_table_id, 
                            order_personal_document, 
                            order_list_inventary,
                            order_create,
                            order_done,
                            order_status,
                            order_price_dolar,
                            sum(totalfinal) AS total,
			                count(order_personal_document) AS countMesonero,
                            p.personal_name AS personal_name,
                            p.personal_document AS personal_document,
                            t.table_name AS table_name 
                        FROM
                            " . $this->db_table . " AS o
                            INNER JOIN personals AS p 
                            INNER JOIN tables AS t 
                            ON o.order_personal_document=p.personal_document 
                            AND o.order_table_id=t.table_id 
                            AND order_status=1
                            AND order_done BETWEEN  
                            :month
                            AND 
                            :today
                            GROUP BY order_personal_document";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(":month", $month);
        $stmt->bindParam(":today", $today);

        $stmt->execute();


        $total = 0;
        $price_dolar = 0;
        $totalrows = 0;
        $personal_name = "";
        $personal_document = "";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $totalrows++;
            $arrOrders[$personal_document] = array();
            $arrOrders[$personal_document]["ventasPorMesonero"] = $countMesonero;
            $arrOrders[$personal_document]["total"] = $total / $order_price_dolar;
            $arrOrders[$personal_document]["document"] = $personal_document;
            $arrOrders[$personal_document]["name"] = $personal_name;
        }

        return $arrOrders;
    }

    public function getOrderById()
    {
        $sqlQuery = "SELECT order_id FROM
                        " . $this->db_table . "
                        WHERE
                        order_id = :order_id ";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(":order_id", $this->order_id);

        $stmt->execute();
        return $stmt;
    }

    public function getFacturationOrder()
    {
        $sqlQuery = "SELECT
                        order_id
                        FROM
                        " . $this->db_table . "
                        WHERE
                        order_status=1";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

    public function createNewOrder()
    {
        $today = date('Y/m/d H:i:s');
        $sqlQuery = "INSERT INTO 
                        " . $this->db_table . " (
                        order_table_id, 
                        order_personal_document,
                        order_list_inventary,
                        order_create )
                        VALUES (
                        :order_table_id, 
                        :order_personal_document, 
                        :order_list_inventary,
                        :order_create)";

        $stmt = $this->conn->prepare($sqlQuery);

        $stmt->bindParam(":order_table_id", $this->order_table_id);
        $stmt->bindParam(":order_personal_document", $this->order_personal_document);
        $stmt->bindParam(":order_list_inventary", $this->order_list_inventary);
        $stmt->bindParam(":order_create", $today);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function updateOrder()
    {
        $today = date('Y/m/d H:i:s');
        $sqlQuery = "UPDATE
                        " . $this->db_table . "
                        SET
                        order_list_inventary = :order_list_inventary,
                        order_create = :order_create
                        WHERE 
                        order_id = :order_id ";

        $stmt = $this->conn->prepare($sqlQuery);

        $stmt->bindParam(":order_id", $this->order_id);
        $stmt->bindParam(":order_list_inventary", $this->order_list_inventary);
        $stmt->bindParam(":order_create", $today);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function updateOrderToFacture()
    {
        $today = date('Y/m/d H:i:s');
        $sqlQuery = "UPDATE
                        " . $this->db_table . "
                        SET
                        facturationNumber = :facturationNumber,
                        controlNumber = :controlNumber,
                        order_list_inventary = :order_list_inventary,
                        order_done = :order_done,
                        order_status = 1,
                        client_document = :client_document,
                        client_name = :client_name,
                        client_address = :client_address,
                        client_phone_number = :client_phone_number,
                        order_price_dolar = :order_price_dolar,
                        order_percent_iva = :order_percent_iva,
                        subtotal = :subtotal, 
                        totalfinal = :totalfinal
                        WHERE 
                        order_id = :order_id ";

        $stmt = $this->conn->prepare($sqlQuery);

        $stmt->bindParam(":order_id", $this->order_id);
        $stmt->bindParam(":facturationNumber", $this->facturationNumber);
        $stmt->bindParam(":controlNumber", $this->controlNumber);
        $stmt->bindParam(":order_list_inventary", $this->order_list_inventary);
        $stmt->bindParam(":order_done", $today);
        $stmt->bindParam(":client_document", $this->client_document);
        $stmt->bindParam(":client_name", $this->client_name);
        $stmt->bindParam(":client_address", $this->client_address);
        $stmt->bindParam(":client_phone_number", $this->client_phone_number);
        $stmt->bindParam(":order_price_dolar", $this->order_price_dolar);
        $stmt->bindParam(":order_percent_iva", $this->order_percent_iva);
        $stmt->bindParam(":subtotal", $this->subtotal);
        $stmt->bindParam(":totalfinal", $this->totalfinal);


        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function createNewFacture()
    {
        $today = date('Y/m/d H:i:s');
        $sqlQuery = "INSERT INTO 
                        " . $this->db_table . " (
                        facturationNumber, 
                        controlNumber, 
                        order_table_id, 
                        order_personal_document, 
                        order_list_inventary, 
                        order_create, 
                        order_done, 
                        order_status, 
                        client_document, 
                        client_name, 
                        client_address, 
                        client_phone_number,
                        order_price_dolar, 
                        order_percent_iva, 
                        subtotal, 
                        totalfinal)
                        VALUES (
                        :facturationNumber, 
                        :controlNumber,
                        :order_table_id, 
                        :order_personal_document,
                        :order_list_inventary,
                        :order_create, 
                        :order_done, 
                        '1',
                        :client_document,
                        :client_name, 
                        :client_address, 
                        :client_phone_number,
                        :order_price_dolar,
                        :order_percent_iva,
                        :subtotal, 
                        :totalfinal)";

        $stmt = $this->conn->prepare($sqlQuery);

        $stmt->bindParam(":facturationNumber", $this->facturationNumber);
        $stmt->bindParam(":controlNumber", $this->controlNumber);
        $stmt->bindParam(":order_table_id", $this->order_table_id);
        $stmt->bindParam(":order_personal_document", $this->order_personal_document);
        $stmt->bindParam(":order_list_inventary", $this->order_list_inventary);
        $stmt->bindParam(":order_create", $today);
        $stmt->bindParam(":order_done", $today);
        $stmt->bindParam(":client_document", $this->client_document);
        $stmt->bindParam(":client_name", $this->client_name);
        $stmt->bindParam(":client_address", $this->client_address);
        $stmt->bindParam(":client_phone_number", $this->client_phone_number);
        $stmt->bindParam(":order_price_dolar", $this->order_price_dolar);
        $stmt->bindParam(":order_percent_iva", $this->order_percent_iva);
        $stmt->bindParam(":subtotal", $this->subtotal);
        $stmt->bindParam(":totalfinal", $this->totalfinal);


        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function searchFactures()
    {
        $arrOrders = array();
        $initial = $this->initial_day;
        $final = $this->final_day;
        $num_facture = $this->num_facture;
        $keyword = $this->keyword;

        if ($num_facture !== "" && $num_facture !== null) {
            $sqlQuery = "SELECT
                            order_id, 
                            facturationNumber, 
                            controlNumber, 
                            order_table_id, 
                            t.table_name AS order_table_name, 
                            order_personal_document, 
                            p.personal_name AS order_personal_name, 
                            order_list_inventary, 
                            order_create, 
                            order_done, 
                            order_status, 
                            client_document, 
                            client_name, 
                            client_address, 
                            client_phone_number, 
                            order_price_dolar, 
                            order_percent_iva, 
                            subtotal, 
                            totalfinal 
                            FROM
                            " . $this->db_table . " AS o
                            INNER JOIN 
                            " . $this->db_table_innerPersonals . " AS p 
                            INNER JOIN 
                            " . $this->db_table_innerTables . " AS t 
                            ON 
                            o.order_personal_document=p.personal_document 
                            AND
                            o.order_table_id=t.table_id 
                            AND 
                            o.order_status=1 
                            AND 
                            o.facturationNumber = :facturationNumber";

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(":facturationNumber", $num_facture);
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $order = array(
                    'order_id' => $order_id,
                    'facturationNumber' => $facturationNumber,
                    'controlNumber' => $controlNumber,
                    'order_table_id' => $order_table_id,
                    'order_table_name' => $order_table_name,
                    'order_personal_document' => $order_personal_document,
                    'order_personal_name' => $order_personal_name,
                    'order_list_inventary' => json_decode($order_list_inventary),
                    'order_create' => $order_create,
                    'order_done' => date('d-m-Y / H:i:s', strtotime($order_done)),
                    'order_hour' => intval(date('G', strtotime($order_done))),
                    'order_day' => intval(date('w', strtotime($order_done))),
                    'order_status' => $order_status,
                    'client_document' => $client_document,
                    'client_name' => $client_name,
                    'client_address' => $client_address,
                    'client_phone_number' => $client_phone_number,
                    'order_price_dolar' => $order_price_dolar,
                    'order_percent_iva' => $order_percent_iva,
                    'subtotal' => $subtotal,
                    'totalfinal' => $totalfinal
                );
                $arrOrders["orders"][] = $order;
            }

            return $arrOrders;
        }

        if ($initial === $final && $initial !== "" && $final !== "" && $num_facture === "" && $keyword === "") {

            $sqlQuery = "SELECT 
                                    order_id, 
                                    facturationNumber, 
                                    controlNumber, 
                                    order_table_id, 
                                    t.table_name AS order_table_name, 
                                    order_personal_document, 
                                    p.personal_name AS order_personal_name, 
                                    order_list_inventary, 
                                    order_create, 
                                    order_done, 
                                    order_status, 
                                    client_document, 
                                    client_name, 
                                    client_address, 
                                    client_phone_number, 
                                    order_price_dolar, 
                                    order_percent_iva, 
                                    subtotal, 
                                    totalfinal  
                                    FROM 
                                    " . $this->db_table . " AS o
                                    INNER JOIN 
                                    " . $this->db_table_innerPersonals . " AS p 
                                    INNER JOIN 
                                    " . $this->db_table_innerTables . " AS t 
                                    ON 
                                    o.order_personal_document=p.personal_document 
                                    AND 
                                    o.order_table_id=t.table_id 
                                    AND order_status=1 
                                    AND order_done LIKE :initial";

            $stmt = $this->conn->prepare($sqlQuery);
            $initialSearch = $initial . "%";
            $stmt->bindParam(":initial", $initialSearch);
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $order = array(
                    'order_id' => $order_id,
                    'facturationNumber' => $facturationNumber,
                    'controlNumber' => $controlNumber,
                    'order_table_id' => $order_table_id,
                    'order_table_name' => $order_table_name,
                    'order_personal_document' => $order_personal_document,
                    'order_personal_name' => $order_personal_name,
                    'order_list_inventary' => json_decode($order_list_inventary),
                    'order_create' => $order_create,
                    'order_done' => date('d-m-Y / H:i:s', strtotime($order_done)),
                    'order_hour' => intval(date('G', strtotime($order_done))),
                    'order_day' => intval(date('w', strtotime($order_done))),
                    'order_status' => $order_status,
                    'client_document' => $client_document,
                    'client_name' => $client_name,
                    'client_address' => $client_address,
                    'client_phone_number' => $client_phone_number,
                    'order_price_dolar' => $order_price_dolar,
                    'order_percent_iva' => $order_percent_iva,
                    'subtotal' => $subtotal,
                    'totalfinal' => $totalfinal
                );
                $arrOrders["orders"][] = $order;
            }

            return $arrOrders;
        }

        if ($initial !== "" && $final !== "" && $num_facture === "" && $keyword === "") {

            $final_day_format = date('Y-m-d', strtotime($final . " + 1 days"));

            $sqlQuery = "SELECT 
                                order_id, 
                                facturationNumber, 
                                controlNumber, 
                                order_table_id, 
                                t.table_name AS order_table_name, 
                                order_personal_document, 
                                p.personal_name AS order_personal_name, 
                                order_list_inventary, 
                                order_create, 
                                order_done, 
                                order_status, 
                                client_document, 
                                client_name, 
                                client_address, 
                                client_phone_number, 
                                order_price_dolar, 
                                order_percent_iva, 
                                subtotal, 
                                totalfinal 
                                FROM " . $this->db_table . " AS o
                                INNER JOIN " . $this->db_table_innerPersonals . " AS p 
                                INNER JOIN " . $this->db_table_innerTables . " AS t 
                                ON o.order_personal_document=p.personal_document 
                                AND o.order_table_id=t.table_id 
                                AND order_status=1 
                                AND order_done BETWEEN :initial AND :final";

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(":initial", $initial);
            $stmt->bindParam(":final", $final_day_format);
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $order = array(
                    'order_id' => $order_id,
                    'facturationNumber' => $facturationNumber,
                    'controlNumber' => $controlNumber,
                    'order_table_id' => $order_table_id,
                    'order_table_name' => $order_table_name,
                    'order_personal_document' => $order_personal_document,
                    'order_personal_name' => $order_personal_name,
                    'order_list_inventary' => json_decode($order_list_inventary),
                    'order_create' => $order_create,
                    'order_done' => date('d-m-Y / H:i:s', strtotime($order_done)),
                    'order_hour' => intval(date('G', strtotime($order_done))),
                    'order_day' => intval(date('w', strtotime($order_done))),
                    'order_status' => $order_status,
                    'client_document' => $client_document,
                    'client_name' => $client_name,
                    'client_address' => $client_address,
                    'client_phone_number' => $client_phone_number,
                    'order_price_dolar' => $order_price_dolar,
                    'order_percent_iva' => $order_percent_iva,
                    'subtotal' => $subtotal,
                    'totalfinal' => $totalfinal
                );
                $arrOrders["orders"][] = $order;
            }

            return $arrOrders;
        }

        if ($keyword !== "" && $initial === "" && $final === "" && $num_facture === "") {
            $sqlQuery = "SELECT 
                    order_id, 
                    facturationNumber, 
                    controlNumber, 
                    order_table_id, 
                    t.table_name AS order_table_name, 
                    order_personal_document, 
                    p.personal_name AS order_personal_name, 
                    order_list_inventary, 
                    order_create, 
                    order_done, 
                    order_status, 
                    client_document, 
                    client_name, 
                    client_address, 
                    client_phone_number, 
                    order_price_dolar, 
                    order_percent_iva, 
                    subtotal, 
                    totalfinal  
                    FROM " . $this->db_table . " AS o
                    INNER JOIN " . $this->db_table_innerPersonals . " AS p 
                    INNER JOIN " . $this->db_table_innerTables . " AS t  
                    ON o.order_personal_document=p.personal_document AND o.order_table_id=t.table_id AND order_status=1 AND p.personal_name LIKE :keyword 
                    OR o.order_personal_document=p.personal_document AND o.order_table_id=t.table_id AND order_status=1 AND t.table_name LIKE :keyword 
                    OR o.order_personal_document=p.personal_document AND o.order_table_id=t.table_id AND order_status=1 AND o.order_personal_document LIKE :keyword
                    OR o.order_personal_document=p.personal_document AND o.order_table_id=t.table_id AND order_status=1 AND o.order_personal_document LIKE :keyword
                    OR o.order_personal_document=p.personal_document AND o.order_table_id=t.table_id AND order_status=1 AND o.client_document LIKE :keyword
                    OR o.order_personal_document=p.personal_document AND o.order_table_id=t.table_id AND order_status=1 AND o.client_name LIKE :keyword
                    OR o.order_personal_document=p.personal_document AND o.order_table_id=t.table_id AND order_status=1 AND o.client_address LIKE :keyword
                    OR o.order_personal_document=p.personal_document AND o.order_table_id=t.table_id AND order_status=1 AND o.client_phone_number LIKE :keyword
                    ";

            $keywordSearch = "%" . $keyword . "%";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(":keyword", $keywordSearch);
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $order = array(
                    'order_id' => $order_id,
                    'facturationNumber' => $facturationNumber,
                    'controlNumber' => $controlNumber,
                    'order_table_id' => $order_table_id,
                    'order_table_name' => $order_table_name,
                    'order_personal_document' => $order_personal_document,
                    'order_personal_name' => $order_personal_name,
                    'order_list_inventary' => json_decode($order_list_inventary),
                    'order_create' => $order_create,
                    'order_done' => date('d-m-Y / H:i:s', strtotime($order_done)),
                    'order_hour' => intval(date('G', strtotime($order_done))),
                    'order_day' => intval(date('w', strtotime($order_done))),
                    'order_status' => $order_status,
                    'client_document' => $client_document,
                    'client_name' => $client_name,
                    'client_address' => $client_address,
                    'client_phone_number' => $client_phone_number,
                    'order_price_dolar' => $order_price_dolar,
                    'order_percent_iva' => $order_percent_iva,
                    'subtotal' => $subtotal,
                    'totalfinal' => $totalfinal
                );
                $arrOrders["orders"][] = $order;
            }
            return $arrOrders;
        }
    }
}
