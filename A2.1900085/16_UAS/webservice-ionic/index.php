<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
header('Content-Type: application/json');

require 'vendor/autoload.php';
require 'config.php';
$app = new Slim\App();

$app->get('/Data_Tanah', 'Data_Tanah');
$app->post('/Input_Tanah', 'Input_Tanah');
$app->post('/Get_Tanah_Edit', 'Get_Tanah_Edit');
$app->post('/Edit_Tanah', 'Edit_Tanah');
$app->post('/Delete_Tanah', 'Delete_Tanah');
$app->run();

//request semua data yang berada pada tabel tanah
function Data_Tanah($request, $response)
{
    $data = $request->getParsedBody();
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $Data_Tanah = '';
        $db = getDB();
        $sql = "SELECT * FROM tanah order by id_tanah desc";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $Data_Tanah = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        if ($Data_Tanah)
            echo '{"Data_Tanah": ' . json_encode($Data_Tanah) . '}';
        else
            echo '{"Data_Tanah": ""}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//POST data tanah untuk selanjutnya akan di simpan di tabel tanah
function Input_Tanah($request, $response)
{

    $data = $request->getParsedBody();
    $nama_tanah = $data['nama_tanah'];
    $lokasi = $data['lokasi'];
    $harga = $data['harga'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "INSERT INTO tanah(nama_tanah, lokasi, harga) VALUES(:nama_tanah ,:lokasi, :harga)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("nama_tanah", $nama_tanah, PDO::PARAM_STR);
        $stmt->bindParam("lokasi", $lokasi, PDO::PARAM_STR);
        $stmt->bindParam("harga", $harga, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Input_tanah": "input success"}';
        else
            echo '{"Input_tanah": "input error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//request data yang berada pada tabel tanah berdasarkan id_tanah
function Get_Tanah_Edit($request, $response)
{
    $data = $request->getParsedBody();
    $id_tanah = $data['id_tanah'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $Get_Tanah_Edit = '';
        $db = getDB();
        $sql = "SELECT * FROM tanah WHERE id_tanah=:id_tanah";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_tanah", $id_tanah, PDO::PARAM_STR);
        $stmt->execute();
        $Get_Tanah_Edit = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        if ($Get_Tanah_Edit)
            echo '{"Get_Tanah_Edit": ' . json_encode($Get_Tanah_Edit) . '}';
        else
            echo '{"Get_Tanah_Edit": ""}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//POST data tanah ubah data berdasarkan id_tanah
function Edit_Tanah($request, $response)
{
    $data = $request->getParsedBody();
    $id_tanah = $data['id_tanah'];
    $nama_tanah = $data['nama_tanah'];
    $lokasi = $data['lokasi'];
    $harga = $data['harga'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "UPDATE tanah SET nama_tanah=:nama_tanah, lokasi=:lokasi, harga=:harga WHERE id_tanah=:id_tanah";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_tanah", $id_tanah, PDO::PARAM_STR);
        $stmt->bindParam("nama_tanah", $nama_tanah, PDO::PARAM_STR);
        $stmt->bindParam("lokasi", $lokasi, PDO::PARAM_STR);
        $stmt->bindParam("harga", $harga, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Edit_Tanah": "Edit success"}';
        else
            echo '{"Edit_Tanah": "Edit error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//Untuk menghapus data tanah berdasarkan id_tanah
function Delete_Tanah($request, $response)
{
    $data = $request->getParsedBody();
    $id_tanah = $data['id_tanah'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "DELETE FROM tanah WHERE id_tanah=:id_tanah";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_tanah", $id_tanah, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Delete_Tanah": "Delete success"}';
        else
            echo '{"Delete_Tanah": "Delete error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}