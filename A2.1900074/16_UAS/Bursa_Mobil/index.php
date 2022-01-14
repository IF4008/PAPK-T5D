<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
header('Content-Type: application/json');

require 'vendor/autoload.php';
require 'config.php';
$app = new Slim\App();

$app->get('/Data_Mobil', 'Data_Mobil');
$app->post('/Input_Mobil', 'Input_Mobil');
$app->post('/Get_Mobil_Edit', 'Get_Mobil_Edit');
$app->post('/Edit_Mobil', 'Edit_Mobil');
$app->post('/Delete_Mobil', 'Delete_Mobil');
$app->run();

//request semua data yang berada pada tabel mobil
function Data_Mobil($request, $response)
{
    $data = $request->getParsedBody();
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $Data_Mobil = '';
        $db = getDB();
        $sql = "SELECT * FROM mobil order by id_mobil desc";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $Data_Mobil = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        if ($Data_Mobil)
            echo '{"Data_Mobil": ' . json_encode($Data_Mobil) . '}';
        else
            echo '{"Data_Mobil": ""}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//POST data barang untuk selanjutnya akan di simpan di tabel mobil
function Input_Mobil($request, $response)
{

    $data = $request->getParsedBody();
    $nama_mobil = $data['nama_mobil'];
    $merk_mobil = $data['merk_mobil'];
    $jenis_mobil = $data['jenis_mobil'];
    $harga = $data['harga'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "INSERT INTO mobil(nama_mobil, merk_mobil, jenis_mobil, harga) VALUES(:nama_mobil , :merk_mobil, :jenis_mobil, :harga)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("nama_mobil", $nama_mobil, PDO::PARAM_STR);
        $stmt->bindParam("merk_mobil", $merk_mobil, PDO::PARAM_STR);
        $stmt->bindParam("jenis_mobil", $jenis_mobil, PDO::PARAM_STR);
        $stmt->bindParam("harga", $harga, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Input_Mobil": "input success"}';
        else
            echo '{"Input_Mobil": "input error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//request data yang berada pada tabel barang berdasarkan id_mobil
function Get_Mobil_Edit($request, $response)
{
    $data = $request->getParsedBody();
    $id_mobil = $data['id_mobil'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $Get_Mobil_Edit = '';
        $db = getDB();
        $sql = "SELECT * FROM mobil WHERE id_mobil=:id_mobil";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_mobil", $id_mobil, PDO::PARAM_STR);
        $stmt->execute();
        $Get_Mobil_Edit = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        if ($Get_Mobil_Edit)
            echo '{"Get_Mobil_Edit": ' . json_encode($Get_Mobil_Edit) . '}';
        else
            echo '{"Get_Mobil_Edit": ""}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//POST data barang ubah data berdasarkan id_mobil
function Edit_Mobil($request, $response)
{
    $data = $request->getParsedBody();
    $id_mobil = $data['id_mobil'];
    $nama_mobil = $data['nama_mobil'];
    $merk_mobil = $data['merk_mobil'];
    $jenis_mobil = $data['jenis_mobil'];
    $harga = $data['harga'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "UPDATE mobil SET nama_mobil=:nama_mobil, merk_mobil=:merk_mobil, jenis_mobil=:jenis_mobil, harga=:harga WHERE id_mobil=:id_mobil";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_mobil", $id_mobil, PDO::PARAM_STR);
        $stmt->bindParam("nama_mobil", $nama_mobil, PDO::PARAM_STR);
        $stmt->bindParam("merk_mobil", $merk_mobil, PDO::PARAM_STR);
        $stmt->bindParam("jenis_mobil", $jenis_mobil, PDO::PARAM_STR);
        $stmt->bindParam("harga", $harga, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Edit_Mobil": "Edit success"}';
        else
            echo '{"Edit_Mobil": "Edit error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//Untuk menghapus data barang berdasarkan id_mobil
function Delete_Mobil($request, $response)
{
    $data = $request->getParsedBody();
    $id_mobil = $data['id_mobil'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "DELETE FROM mobil WHERE id_mobil=:id_mobil";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_mobil", $id_mobil, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Delete_Mobil": "Delete success"}';
        else
            echo '{"Delete_Mobil": "Delete error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}