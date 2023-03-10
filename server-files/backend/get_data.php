<?php
include 'env.php';

try {
    //$conn = new PDO('mysql:host=proyecto-tfg.atic.green;dbname=proyecto-tfg',$user,$password);
    $conn = new PDO('mysql:host=localhost;dbname=proyecto-tfg',$user,$password);

} catch (PDOException $exception) {
    die($exception->getMessage());
}

$sql = "SELECT `factura`.`id`, cabecera, fecha_creacion, `client`.`name` AS client FROM factura, client WHERE `estado` = 'a' AND `factura`.`id_client` = `client`.`id`;";
$st = $conn->query($sql);

if ($st) {
    $rs = $st->fetchAll(PDO::FETCH_FUNC, fn($id, $cabecera, $fecha_creacion, $client) => [$id, $cabecera, $fecha_creacion, $client] );
    echo json_encode([
        'data' => $rs,
    ]);
} else {
    var_dump($conn->errorInfo());
    die;
}