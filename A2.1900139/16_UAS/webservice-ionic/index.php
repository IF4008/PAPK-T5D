<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
header('Content-Type: application/json');

require 'vendor/autoload.php';
require 'config.php';
$app = new Slim\App();

$app->get('/Data_apotek', 'Data_apotek');
$app->post('/Input_apotek', 'Input_apotek');
$app->post('/Get_apotek_Edit', 'Get_apotek_Edit');
$app->post('/Edit_apotek', 'Edit_apotek');
$app->post('/Delete_apotek', 'Delete_apotek');
$app->run();

//request semua data yang berada pada tabel apotek
function Data_apotek($request, $response)
{
    $data = $request->getParsedBody();
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $Data_apotek = '';
        $db = getDB();
        $sql = "SELECT * FROM apotek order by id_apotek desc";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $Data_apotek = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        if ($Data_apotek)
            echo '{"Data_apotek": ' . json_encode($Data_apotek) . '}';
        else
            echo '{"Data_apotek": ""}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//POST data apotek untuk selanjutnya akan di simpan di tabel apotek
function Input_apotek($request, $response)
{

    $data = $request->getParsedBody();
    $nama_apotek = $data['nama_apotek'];
    $jumlah = $data['jumlah'];
    $harga = $data['harga'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "INSERT INTO apotek(nama_apotek, jumlah, harga) VALUES(:nama_apotek ,:jumlah, :harga)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("nama_apotek", $nama_apotek, PDO::PARAM_STR);
        $stmt->bindParam("jumlah", $jumlah, PDO::PARAM_STR);
        $stmt->bindParam("harga", $harga, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Input_apotek": "input success"}';
        else
            echo '{"Input_apotek": "input error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//request data yang berada pada tabel apotek berdasarkan id_apotek
function Get_apotek_Edit($request, $response)
{
    $data = $request->getParsedBody();
    $id_apotek = $data['id_apotek'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $Get_apotek_Edit = '';
        $db = getDB();
        $sql = "SELECT * FROM apotek WHERE id_apotek=:id_apotek";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_apotek", $id_apotek, PDO::PARAM_STR);
        $stmt->execute();
        $Get_apotek_Edit = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        if ($Get_apotek_Edit)
            echo '{"Get_apotek_Edit": ' . json_encode($Get_apotek_Edit) . '}';
        else
            echo '{"Get_apotek_Edit": ""}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//POST data apotek ubah data berdasarkan id_apotek
function Edit_apotek($request, $response)
{
    $data = $request->getParsedBody();
    $id_apotek = $data['id_apotek'];
    $nama_apotek = $data['nama_apotek'];
    $jumlah = $data['jumlah'];
    $harga = $data['harga'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "UPDATE apotek SET nama_apotek=:nama_apotek, jumlah=:jumlah, harga=:harga WHERE id_apotek=:id_apotek";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_apotek", $id_apotek, PDO::PARAM_STR);
        $stmt->bindParam("nama_apotek", $nama_apotek, PDO::PARAM_STR);
        $stmt->bindParam("jumlah", $jumlah, PDO::PARAM_STR);
        $stmt->bindParam("harga", $harga, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Edit_apotek": "Edit success"}';
        else
            echo '{"Edit_apotek": "Edit error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//Untuk menghapus data apotek berdasarkan id_apotek
function Delete_apotek($request, $response)
{
    $data = $request->getParsedBody();
    $id_apotek = $data['id_apotek'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "DELETE FROM apotek WHERE id_apotek=:id_apotek";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_apotek", $id_apotek, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Delete_apotek": "Delete success"}';
        else
            echo '{"Delete_apotek": "Delete error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}