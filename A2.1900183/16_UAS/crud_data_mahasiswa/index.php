<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
header('Content-Type: application/json');

require 'vendor/autoload.php';
require 'config.php';
$app = new Slim\App();

$app->get('/Data_Mahasiswa', 'Data_Mahasiswa');
$app->post('/Input_Mahasiswa', 'Input_Mahasiswa');
$app->post('/Get_Mahasiswa_Edit', 'Get_Mahasiswa_Edit');
$app->post('/Edit_Mahasiswa', 'Edit_Mahasiswa');
$app->post('/Delete_Mahasiswa', 'Delete_Mahasiswa');
$app->run();

//request semua data yang berada pada tabel barang
function Data_Mahasiswa($request, $response)
{
    $data = $request->getParsedBody();
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $Data_User = '';
        $db = getDB();
        $sql = "SELECT * FROM mahasiswa order by id_mahasiswa desc";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $Data_Mahasiswa = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        if ($Data_Mahasiswa)
            echo '{"Data_Mahasiswa": ' . json_encode($Data_Mahasiswa) . '}';
        else
            echo '{"Data_Mahasiswa": ""}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//POST data barang untuk selanjutnya akan di simpan di tabel 
function Input_Mahasiswa($request, $response)
{

    $data = $request->getParsedBody();
    $nim = $data['nim'];
    $nama = $data['nama'];
    $jurusan = $data['jurusan'];
    $alamat = $data['alamat'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "INSERT INTO mahasiswa(nim, nama, jurusan, alamat) VALUES(:nim ,:nama, :jurusan , :alamat)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("nim", $nim, PDO::PARAM_STR);
        $stmt->bindParam("nama", $nama, PDO::PARAM_STR);
        $stmt->bindParam("jurusan", $jurusan, PDO::PARAM_STR);
        $stmt->bindParam("alamat", $alamat, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Input_Mahasiswa": "input success"}';
        else
            echo '{"Input_Mahasiswa": "input error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//request data yang berada pada tabel barang berdasarkan id_barang
function Get_Mahasiswa_Edit($request, $response)
{
    $data = $request->getParsedBody();
    $id_mahasiswa = $data['id_mahasiswa'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $Get_Mahasiswa_Edit = '';
        $db = getDB();
        $sql = "SELECT * FROM mahasiswa WHERE id_mahasiswa=:id_mahasiswa";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_mahasiswa", $id_mahasiswa, PDO::PARAM_STR);
        $stmt->execute();
        $Get_Mahasiswa_Edit = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        if ($Get_Mahasiswa_Edit)
            echo '{"Get_Mahasiswa_Edit": ' . json_encode($Get_Mahasiswa_Edit) . '}';
        else
            echo '{"Get_Mahasiswa_Edit": ""}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//POST data barang ubah data berdasarkan id_barang
function Edit_Mahasiswa($request, $response)
{
    $data = $request->getParsedBody();
    $id_mahasiswa = $data['id_mahasiswa'];
    $nim = $data['nim'];
    $nama = $data['nama'];
    $jurusan = $data['jurusan'];
    $alamat = $data['alamat'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "UPDATE mahasiswa SET nim=:nim, nama=:nama, jurusan=:jurusan, alamat=:alamat WHERE id_mahasiswa=:id_mahasiswa";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_mahasiswa", $id_mahasiswa, PDO::PARAM_STR);
        $stmt->bindParam("nim", $nim, PDO::PARAM_STR);
        $stmt->bindParam("nama", $nama, PDO::PARAM_STR);
        $stmt->bindParam("jurusan", $jurusan, PDO::PARAM_STR);
        $stmt->bindParam("alamat", $alamat, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Edit_Mahasiswa": "Edit success"}';
        else
            echo '{"Edit_Mahasiswa": "Edit error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//Untuk menghapus data barang berdasarkan id
function Delete_Mahasiswa($request, $response)
{
    $data = $request->getParsedBody();
    $id_mahasiswa = $data['id_mahasiswa'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "DELETE FROM mahasiswa WHERE id_mahasiswa=:id_mahasiswa";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_mahasiswa", $id_mahasiswa, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Delete_Mahasiswa": "Delete success"}';
        else
            echo '{"Delete_Mahasiswa": "Delete error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}