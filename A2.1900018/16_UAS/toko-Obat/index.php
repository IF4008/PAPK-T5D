<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
header('Content-Type: application/json');

require 'vendor/autoload.php';
require 'config.php';
$app = new Slim\App();

$app->get('/Data_Obat', 'Data_Obat');
$app->post('/Input_Obat', 'Input_Obat');
$app->post('/Get_Obat_Edit', 'Get_Obat_Edit');
$app->post('/Edit_Obat', 'Edit_Obat');
$app->post('/Delete_Obat', 'Delete_Obat');
$app->run();

//request semua data yang berada pada tabel Obat
function Data_Obat($request, $response)
{
    $data = $request->getParsedBody();
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $Data_Obat = '';
        $db = getDB();
        $sql = "SELECT * FROM obat order by id_obat desc";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $Data_Obat = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        if ($Data_Obat)
            echo '{"Data_Obat": ' . json_encode($Data_Obat) . '}';
        else
            echo '{"Data_Obat": ""}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//POST data barang untuk selanjutnya akan di simpan di tabel mobil
function Input_Obat($request, $response)
{

    $data = $request->getParsedBody();
    $nama = $data['nama'];
    $bentuk = $data['bentuk'];
    $konsumsi = $data['konsumsi'];
    $harga = $data['harga'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "INSERT INTO obat(nama, bentuk, konsumsi, harga) VALUES(:nama , :bentuk, :konsumsi, :harga)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("nama", $nama, PDO::PARAM_STR);
        $stmt->bindParam("bentuk", $bentuk, PDO::PARAM_STR);
        $stmt->bindParam("konsumsi", $konsumsi, PDO::PARAM_STR);
        $stmt->bindParam("harga", $harga, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Input_Obat": "input success"}';
        else
            echo '{"Input_Obat": "input error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//request data yang berada pada tabel barang berdasarkan id_obat
function Get_Obat_Edit($request, $response)
{
    $data = $request->getParsedBody();
    $id_obat = $data['id_obat'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $Get_Obat_Edit = '';
        $db = getDB();
        $sql = "SELECT * FROM obat WHERE id_obat=:id_obat";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_obat", $id_obat, PDO::PARAM_STR);
        $stmt->execute();
        $Get_Obat_Edit = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        if ($Get_Obat_Edit)
            echo '{"Get_Obat_Edit": ' . json_encode($Get_Obat_Edit) . '}';
        else
            echo '{"Get_Obat_Edit": ""}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//POST data barang ubah data berdasarkan id_Obat
function Edit_Obat($request, $response)
{
    $data = $request->getParsedBody();
    $id_obat = $data['id_obat'];
    $nama = $data['nama'];
    $bentuk = $data['bentuk'];
    $konsumsi = $data['konsumsi'];
    $harga = $data['harga'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "UPDATE obat SET nama=:nama, bentuk=:bentuk, konsumsi=:konsumsi, harga=:harga WHERE id_obat=:id_obat";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_obat", $id_obat, PDO::PARAM_STR);
        $stmt->bindParam("nama", $nama, PDO::PARAM_STR);
        $stmt->bindParam("bentuk", $bentuk, PDO::PARAM_STR);
        $stmt->bindParam("konsumsi", $konsumsi, PDO::PARAM_STR);
        $stmt->bindParam("harga", $harga, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Edit_Obat": "Edit success"}';
        else
            echo '{"Edit_Obat": "Edit error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//Untuk menghapus data barang berdasarkan id_mobil
function Delete_Obat($request, $response)
{
    $data = $request->getParsedBody();
    $id_obat = $data['id_obat'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "DELETE FROM obat WHERE id_obat=:id_obat";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_obat", $id_obat, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Delete_Obat": "Delete success"}';
        else
            echo '{"Delete_Obat": "Delete error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}