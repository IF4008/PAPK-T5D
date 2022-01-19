<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
header('Content-Type: application/json');

require 'vendor/autoload.php';
require 'config.php';
$app = new Slim\App();

$app->get('/Data_becak', 'Data_becak');
$app->post('/Input_becak', 'Input_becak');
$app->post('/Get_becak_Edit', 'Get_becak_Edit');
$app->post('/Edit_becak', 'Edit_becak');
$app->post('/Delete_becak', 'Delete_becak');
$app->run();

//request semua data yang berada pada tabel becak
function Data_becak($request, $response)
{
    $data = $request->getParsedBody();
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $Data_becak = '';
        $db = getDB();
        $sql = "SELECT * FROM becak order by id_becak desc";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $Data_becak = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        if ($Data_becak)
            echo '{"Data_becak": ' . json_encode($Data_becak) . '}';
        else
            echo '{"Data_becak": ""}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//POST data becak untuk selanjutnya akan di simpan di tabel becak
function Input_becak($request, $response)
{

    $data = $request->getParsedBody();
    $nama_becak = $data['nama_becak'];
    $jumlah = $data['jumlah'];
    $harga = $data['harga'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "INSERT INTO becak(nama_becak, jumlah, harga) VALUES(:nama_becak ,:jumlah, :harga)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("nama_becak", $nama_becak, PDO::PARAM_STR);
        $stmt->bindParam("jumlah", $jumlah, PDO::PARAM_STR);
        $stmt->bindParam("harga", $harga, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Input_becak": "input success"}';
        else
            echo '{"Input_becak": "input error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//request data yang berada pada tabel becak berdasarkan id_becak
function Get_becak_Edit($request, $response)
{
    $data = $request->getParsedBody();
    $id_becak = $data['id_becak'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $Get_becak_Edit = '';
        $db = getDB();
        $sql = "SELECT * FROM becak WHERE id_becak=:id_becak";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_becak", $id_becak, PDO::PARAM_STR);
        $stmt->execute();
        $Get_becak_Edit = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        if ($Get_becak_Edit)
            echo '{"Get_becak_Edit": ' . json_encode($Get_becak_Edit) . '}';
        else
            echo '{"Get_becak_Edit": ""}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//POST data becak ubah data berdasarkan id_becak
function Edit_becak($request, $response)
{
    $data = $request->getParsedBody();
    $id_becak = $data['id_becak'];
    $nama_becak = $data['nama_becak'];
    $jumlah = $data['jumlah'];
    $harga = $data['harga'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "UPDATE becak SET nama_becak=:nama_becak, jumlah=:jumlah, harga=:harga WHERE id_becak=:id_becak";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_becak", $id_becak, PDO::PARAM_STR);
        $stmt->bindParam("nama_becak", $nama_becak, PDO::PARAM_STR);
        $stmt->bindParam("jumlah", $jumlah, PDO::PARAM_STR);
        $stmt->bindParam("harga", $harga, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Edit_becak": "Edit success"}';
        else
            echo '{"Edit_becak": "Edit error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//Untuk menghapus data becak berdasarkan id_becak
function Delete_becak($request, $response)
{
    $data = $request->getParsedBody();
    $id_becak = $data['id_becak'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "DELETE FROM becak WHERE id_becak=:id_becak";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_becak", $id_becak, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Delete_becak": "Delete success"}';
        else
            echo '{"Delete_becak": "Delete error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}