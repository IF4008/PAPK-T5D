<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
header('Content-Type: application/json');

require 'vendor/autoload.php';
require 'config.php';
$app = new Slim\App();

$app->get('/Data_Karyawan', 'Data_Karyawan');
$app->post('/Input_Karyawan', 'Input_Karyawan');
$app->post('/Get_Karyawan_Edit', 'Get_Karyawan_Edit');
$app->post('/Edit_Karyawan', 'Edit_Karyawan');
$app->post('/Delete_Karyawan', 'Delete_Karyawan');
$app->run();

//request semua data yang berada pada tabel Karyawan
function Data_Karyawan($request, $response)
{
    $data = $request->getParsedBody();
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $Data_Karyawan = '';
        $db = getDB();
        $sql = "SELECT * FROM karyawan order by id_karyawan desc";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $Data_Karyawan = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        if ($Data_Karyawan)
            echo '{"Data_Karyawan": ' . json_encode($Data_Karyawan) . '}';
        else
            echo '{"Data_Karyawan": ""}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//POST data Karyawan untuk selanjutnya akan di simpan di tabel Karyawan
function Input_Karyawan($request, $response)
{

    $data = $request->getParsedBody();
    $nama_karyawan = $data['nama_karyawan'];
    $jabatan = $data['jabatan'];
    $gaji_pokok = $data['gaji_pokok'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "INSERT INTO karyawan(nama_karyawan, jabatan, gaji_pokok) VALUES(:nama_karyawan ,:jabatan, :gaji_pokok)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("nama_karyawan", $nama_karyawan, PDO::PARAM_STR);
        $stmt->bindParam("jabatan", $jabatan, PDO::PARAM_STR);
        $stmt->bindParam("gaji_pokok", $gaji_pokok, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Input_Karyawan": "input success"}';
        else
            echo '{"Input_Karyawan": "input error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//request data yang berada pada tabel Karyawan berdasarkan id_karyawan
function Get_Karyawan_Edit($request, $response)
{
    $data = $request->getParsedBody();
    $id_karyawan = $data['id_karyawan'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $Get_Karyawan_Edit = '';
        $db = getDB();
        $sql = "SELECT * FROM karyawan WHERE id_karyawan=:id_karyawan";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_karyawan", $id_karyawan, PDO::PARAM_STR);
        $stmt->execute();
        $Get_Karyawan_Edit = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        if ($Get_Karyawan_Edit)
            echo '{"Get_Karyawan_Edit": ' . json_encode($Get_Karyawan_Edit) . '}';
        else
            echo '{"Get_Karyawan_Edit": ""}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//POST data Karyawan ubah data berdasarkan id_karyawan
function Edit_Karyawan($request, $response)
{
    $data = $request->getParsedBody();
    $id_karyawan = $data['id_karyawan'];
    $nama_karyawan = $data['nama_karyawan'];
    $jabatan = $data['jabatan'];
    $gaji_pokok = $data['gaji_pokok'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "UPDATE karyawan SET nama_karyawan=:nama_karyawan, jabatan=:jabatan, gaji_pokok=:gaji_pokok WHERE id_karyawan=:id_karyawan";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_karyawan", $id_karyawan, PDO::PARAM_STR);
        $stmt->bindParam("nama_karyawan", $nama_karyawan, PDO::PARAM_STR);
        $stmt->bindParam("jabatan", $jabatan, PDO::PARAM_STR);
        $stmt->bindParam("gaji_pokok", $gaji_pokok, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Edit_Karyawan": "Edit success"}';
        else
            echo '{"Edit_Karyawan": "Edit error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//Untuk menghapus data Karyawan berdasarkan id_karyawan
function Delete_Karyawan($request, $response)
{
    $data = $request->getParsedBody();
    $id_karyawan = $data['id_karyawan'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "DELETE FROM karyawan WHERE id_karyawan=:id_karyawan";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_karyawan", $id_karyawan, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Delete_Karyawan": "Delete success"}';
        else
            echo '{"Delete_Karyawan": "Delete error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}