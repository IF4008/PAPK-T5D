<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
header('Content-Type: application/json');

require 'vendor/autoload.php';
require 'config.php';
$app = new Slim\App();

$app->get('/Data_Matakuliah', 'Data_Matakuliah');
$app->post('/Input_Matakuliah', 'Input_Matakuliah');
$app->post('/Get_Matakuliah_Edit', 'Get_Matakuliah_Edit');
$app->post('/Edit_Matakuliah', 'Edit_Matakuliah');
$app->post('/Delete_Matakuliah', 'Delete_Matakuliah');
$app->run();

//request semua data yang berada pada tabel matakuliah
function Data_Matakuliah($request, $response)
{
    $data = $request->getParsedBody();
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $Data_Matakuliah = '';
        $db = getDB();
        $sql = "SELECT * FROM matakuliah order by id_matakuliah desc";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $Data_Matakuliah = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        if ($Data_Matakuliah)
            echo '{"Data_Matakuliah": ' . json_encode($Data_Matakuliah) . '}';
        else
            echo '{"Data_Matakuliah": ""}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//POST data matakuliah untuk selanjutnya akan di simpan di tabel matakuliah
function Input_Matakuliah($request, $response)
{

    $data = $request->getParsedBody();
    $kode_matakuliah= $data['kode_matakuliah'];
    $nama_matakuliah = $data['nama_matakuliah'];
    $sks = $data['sks'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "INSERT INTO matakuliah(kode_matakuliah, nama_matakuliah, sks) VALUES(:kode_matakuliah ,:nama_matakuliah, :sks)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("kode_matakuliah", $kode_matakuliah, PDO::PARAM_STR);
        $stmt->bindParam("nama_matakuliah", $nama_matakuliah, PDO::PARAM_STR);
        $stmt->bindParam("sks", $sks, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Input_Matakuliah": "input success"}';
        else
            echo '{"Input_Matakuliah": "input error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//request data yang berada pada tabel matakuliah berdasarkan id_matakuliah
function Get_Matakuliah_Edit($request, $response)
{
    $data = $request->getParsedBody();
    $id_matakuliah = $data['id_matakuliah'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $Get_Matakuliah_Edit = '';
        $db = getDB();
        $sql = "SELECT * FROM matakuliah WHERE id_matakuliah=:id_matakuliah";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_matakuliah", $id_matakuliah, PDO::PARAM_STR);
        $stmt->execute();
        $Get_Matakuliah_Edit = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        if ($Get_Matakuliah_Edit)
            echo '{"Get_Matakuliah_Edit": ' . json_encode($Get_Matakuliah_Edit) . '}';
        else
            echo '{"Get_Matakuliah_Edit": ""}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//POST data matakuliah ubah data berdasarkan id_matakuliah
function Edit_Matakuliah($request, $response)
{
    $data = $request->getParsedBody();
    $id_matakuliah = $data['id_matakuliah'];
    $kode_matakuliah = $data['kode_matakuliah'];
    $nama_matakuliah = $data['nama_matakuliah'];
    $sks = $data['sks'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "UPDATE matakuliah SET kode_matakuliah=:kode_matakuliah, nama_matakuliah=:nama_matakuliah, sks=:sks WHERE id_matakuliah=:id_matakuliah";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_matakuliah", $id_matakuliah, PDO::PARAM_STR);
        $stmt->bindParam("kode_matakuliah", $kode_matakuliah, PDO::PARAM_STR);
        $stmt->bindParam("nama_matakuliah", $nama_matakuliah, PDO::PARAM_STR);
        $stmt->bindParam("sks", $sks, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Edit_Matakuliah": "Edit success"}';
        else
            echo '{"Edit_Matakuliah": "Edit error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//Untuk menghapus data matakuliah berdasarkan id_matakuliah
function Delete_Matakuliah($request, $response)
{
    $data = $request->getParsedBody();
    $id_matakuliah = $data['id_matakuliah'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "DELETE FROM matakuliah WHERE id_matakuliah=:id_matakuliah";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_matakuliah", $id_matakuliah, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Delete_Matakuliah": "Delete success"}';
        else
            echo '{"Delete_Matakuliah": "Delete error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}