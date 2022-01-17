<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
header('Content-Type: application/json');

require 'vendor/autoload.php';
require 'config.php';
$app = new Slim\App();

$app->get('/Data_cafe', 'Data_cafe');
$app->post('/Input_cafe', 'Input_cafe');
$app->post('/Get_cafe_Edit', 'Get_cafe_Edit');
$app->post('/Edit_cafe', 'Edit_cafe');
$app->post('/Delete_cafe', 'Delete_cafe');
$app->run();

//request semua data yang berada pada tabel cafe
function Data_cafe($request, $response)
{
    $data = $request->getParsedBody();
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $Data_cafe = '';
        $db = getDB();
        $sql = "SELECT * FROM cafe order by id_pesanan desc";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $Data_cafe = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        if ($Data_cafe)
            echo '{"Data_cafe": ' . json_encode($Data_cafe) . '}';
        else
            echo '{"Data_cafe": ""}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//POST data cafe untuk selanjutnya akan di simpan di tabel cafe
function Input_cafe($request, $response)
{

    $data = $request->getParsedBody();
    $nama_pesanan = $data['nama_pesanan'];
    $jumlah = $data['jumlah'];
    $harga = $data['harga'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "INSERT INTO cafe(nama_pesanan, jumlah, harga) VALUES(:nama_pesanan ,:jumlah, :harga)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("nama_pesanan", $nama_pesanan, PDO::PARAM_STR);
        $stmt->bindParam("jumlah", $jumlah, PDO::PARAM_STR);
        $stmt->bindParam("harga", $harga, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Input_cafe": "input success"}';
        else
            echo '{"Input_cafe": "input error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//request data yang berada pada tabel cafe berdasarkan id_pesanan
function Get_cafe_Edit($request, $response)
{
    $data = $request->getParsedBody();
    $id_pesanan = $data['id_pesanan'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $Get_cafe_Edit = '';
        $db = getDB();
        $sql = "SELECT * FROM cafe WHERE id_pesanan=:id_pesanan";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_pesanan", $id_pesanan, PDO::PARAM_STR);
        $stmt->execute();
        $Get_cafe_Edit = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        if ($Get_cafe_Edit)
            echo '{"Get_cafe_Edit": ' . json_encode($Get_cafe_Edit) . '}';
        else
            echo '{"Get_cafe_Edit": ""}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//POST data cafe ubah data berdasarkan id_pesanan
function Edit_cafe($request, $response)
{
    $data = $request->getParsedBody();
    $id_pesanan = $data['id_pesanan'];
    $nama_pesanan = $data['nama_pesanan'];
    $jumlah = $data['jumlah'];
    $harga = $data['harga'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "UPDATE cafe SET nama_pesanan=:nama_pesanan, jumlah=:jumlah, harga=:harga WHERE id_pesanan=:id_pesanan";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_pesanan", $id_pesanan, PDO::PARAM_STR);
        $stmt->bindParam("nama_pesanan", $nama_pesanan, PDO::PARAM_STR);
        $stmt->bindParam("jumlah", $jumlah, PDO::PARAM_STR);
        $stmt->bindParam("harga", $harga, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Edit_cafe": "Edit success"}';
        else
            echo '{"Edit_cafe": "Edit error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//Untuk menghapus data cafe berdasarkan id_pesanan
function Delete_cafe($request, $response)
{
    $data = $request->getParsedBody();
    $id_pesanan = $data['id_pesanan'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "DELETE FROM cafe WHERE id_pesanan=:id_pesanan";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_pesanan", $id_pesanan, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Delete_cafe": "Delete success"}';
        else
            echo '{"Delete_cafe": "Delete error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}