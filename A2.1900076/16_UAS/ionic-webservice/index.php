<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
header('Content-Type: application/json');

require 'vendor/autoload.php';
require 'config.php';
$app = new Slim\App();

$app->get('/Data_Absensi', 'Data_Absensi');
$app->post('/Input_Absensi', 'Input_Absensi');
$app->post('/Get_Absensi_Edit', 'Get_Absensi_Edit');
$app->post('/Edit_Absensi', 'Edit_Absensi');
$app->post('/Delete_Absensi', 'Delete_Absensi');
$app->run();

//request semua data yang berada pada tabel Absensi
function Data_Absensi($request, $response)
{
    $data = $request->getParsedBody();
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $Data_Absensi = '';
        $db = getDB();
        $sql = "SELECT * FROM absensi order by id_mhs desc";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $Data_Absensi = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        if ($Data_Absensi)
            echo '{"Data_Absensi": ' . json_encode($Data_Absensi) . '}';
        else
            echo '{"Data_Absensi": ""}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//POST data Absensi untuk selanjutnya akan di simpan di tabel Absensi
function Input_Absensi($request, $response)
{

    $data = $request->getParsedBody();
    $tgl = $data['tgl'];
    $nama = $data['nama'];
    $kelas = $data['kelas'];
    $keterangan = $data['keterangan'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "INSERT INTO absensi (tgl, nama, kelas, keterangan) VALUES(:tgl, :nama ,:kelas, :keterangan)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("tgl", $tgl, PDO::PARAM_STR);
        $stmt->bindParam("nama", $nama, PDO::PARAM_STR);
        $stmt->bindParam("kelas", $kelas, PDO::PARAM_STR);
        $stmt->bindParam("keterangan", $keterangan, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Input_Absensi": "input success"}';
        else
            echo '{"Input_Absensi": "input error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//request data yang berada pada tabel Absensi berdasarkan id_Mahasiswa
function Get_Absensi_Edit($request, $response)
{
    $data = $request->getParsedBody();
    $id_mhs = $data['id_mhs'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $Get_Absensi_Edit = '';
        $db = getDB();
        $sql = "SELECT * FROM absensi WHERE id_mhs=:id_mhs";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_mhs", $id_mhs, PDO::PARAM_STR);
        $stmt->execute();
        $Get_Absensi_Edit = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        if ($Get_Absensi_Edit)
            echo '{"Get_Absensi_Edit": ' . json_encode($Get_Absensi_Edit) . '}';
        else
            echo '{"Get_Absensi_Edit": ""}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//POST data absensi ubah data berdasarkan id_mhs
function Edit_Absensi($request, $response)
{
    $data = $request->getParsedBody();
    $id_mhs = $data['id_mhs'];
    $tgl = $data['tgl'];
    $nama = $data['nama'];
    $kelas = $data['kelas'];
    $keterangan = $data['keterangan'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "UPDATE absensi SET tgl=:tgl, nama=:nama, kelas=:kelas, keterangan=:keterangan WHERE id_mhs=:id_mhs";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_mhs", $id_mhs, PDO::PARAM_STR);
        $stmt->bindParam("tgl", $tgl, PDO::PARAM_STR);
        $stmt->bindParam("nama", $nama, PDO::PARAM_STR);
        $stmt->bindParam("kelas", $kelas, PDO::PARAM_STR);
        $stmt->bindParam("keterangan", $keterangan, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Edit_Absensi": "Edit success"}';
        else
            echo '{"Edit_Absensi": "Edit error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//Untuk menghapus data absensi berdasarkan id_mhs
function Delete_Absensi($request, $response)
{
    $data = $request->getParsedBody();
    $id_mhs = $data['id_mhs'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "DELETE FROM absensi WHERE id_mhs=:id_mhs";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_mhs", $id_mhs, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Delete_Absensi": "Delete success"}';
        else
            echo '{"Delete_Absensi": "Delete error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}