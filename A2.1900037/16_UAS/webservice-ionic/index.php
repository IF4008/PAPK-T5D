<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
header('Content-Type: application/json');

require 'vendor/autoload.php';
require 'config.php';
$app = new Slim\App();

$app->get('/Data_Barang', 'Data_Barang');
$app->post('/Input_Barang', 'Input_Barang');
$app->post('/Get_Barang_Edit', 'Get_Barang_Edit');
$app->post('/Edit_Barang', 'Edit_Barang');
$app->post('/Delete_Barang', 'Delete_Barang');
$app->run();

//request semua data yang berada pada tabel barang
function Data_Barang($request, $response)
{
    $data = $request->getParsedBody();
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $Data_Barang = '';
        $db = getDB();
        $sql = "SELECT * FROM barang order by kode_barang desc";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $Data_Barang = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        if ($Data_Barang)
            echo '{"Data_Barang": ' . json_encode($Data_Barang) . '}';
        else
            echo '{"Data_Barang": ""}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//POST data barang untuk selanjutnya akan di simpan di tabel barang
function Input_Barang($request, $response)
{

    $data = $request->getParsedBody();
    $nama_barang = $data['nama_barang'];
    $kemasan = $data['kemasan'];
    $harga_beli = $data['harga_beli'];
    $harga_jual = $data['harga_jual'];
    $stok_akhir = $data['stok_akhir'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "INSERT INTO barang(nama_barang, kemasan, harga_beli, harga_jual, stok) VALUES(:nama_barang ,:kemasan, :harga_beli, :harga_jual, :stok_akhir)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("nama_barang", $nama_barang, PDO::PARAM_STR);
        $stmt->bindParam("kemasan", $kemasan, PDO::PARAM_STR);
        $stmt->bindParam("harga_beli", $harga_beli, PDO::PARAM_STR);
        $stmt->bindParam("harga_jual", $harga_jual, PDO::PARAM_STR);
        $stmt->bindParam("stok_akhir", $stok_akhir, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Input_Barang": "input success"}';
        else
            echo '{"Input_Barang": "input error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//request data yang berada pada tabel barang berdasarkan kode_barang
function Get_Barang_Edit($request, $response)
{
    $data = $request->getParsedBody();
    $kode_barang = $data['kode_barang'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $Get_Barang_Edit = '';
        $db = getDB();
        $sql = "SELECT * FROM barang WHERE kode_barang=:kode_barang";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("kode_barang", $kode_barang, PDO::PARAM_STR);
        $stmt->execute();
        $Get_Barang_Edit = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        if ($Get_Barang_Edit)
            echo '{"Get_Barang_Edit": ' . json_encode($Get_Barang_Edit) . '}';
        else
            echo '{"Get_Barang_Edit": ""}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//POST data barang ubah data berdasarkan id_barang
function Edit_Barang($request, $response)
{
    $data = $request->getParsedBody();
    $kode_barang = $data['kode_barang'];
    $nama_barang = $data['nama_barang'];
    $kemasan = $data['kemasan'];
    $harga_beli = $data['harga_beli'];
    $harga_jual = $data['harga_jual'];
    $stok_akhir = $data['stok_akhir'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "UPDATE barang SET nama_barang=:nama_barang, kemasan=:kemasan, harga_beli=:harga_beli, harga_jual=:harga_jual, stok_akhir=:stok_akhir WHERE kode_barang=:kode_barang";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("kode_barang", $kode_barang, PDO::PARAM_STR);
        $stmt->bindParam("nama_barang", $nama_barang, PDO::PARAM_STR);
        $stmt->bindParam("kemasan", $kemasan, PDO::PARAM_STR);
        $stmt->bindParam("harga_beli", $harga_beli, PDO::PARAM_STR);
        $stmt->bindParam("harga_jual", $harga_jual, PDO::PARAM_STR);
        $stmt->bindParam("stok_akhir", $stok_akhir, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Edit_Barang": "Edit success"}';
        else
            echo '{"Edit_Barang": "Edit error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//Untuk menghapus data barang berdasarkan id_barang
function Delete_Barang($request, $response)
{
    $data = $request->getParsedBody();
    $kode_barang = $data['kode_barang'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "DELETE FROM barang WHERE kode_barang=:kode_barang";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("kode_barang", $kode_barang, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Delete_Barang": "Delete success"}';
        else
            echo '{"Delete_Barang": "Delete error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}