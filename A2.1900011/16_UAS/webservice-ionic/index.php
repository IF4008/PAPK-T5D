<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
header('Content-Type: application/json');

require 'vendor/autoload.php';
require 'config.php';
$app = new Slim\App();

$app->get('/Data_Buku', 'Data_Buku');
$app->post('/Input_Buku', 'Input_Buku');
$app->post('/Get_Buku_Edit', 'Get_Buku_Edit');
$app->post('/Edit_Buku', 'Edit_Buku');
$app->post('/Delete_Buku', 'Delete_Buku');
$app->run();

//request semua data yang berada pada tabel Buku
function Data_Buku($request, $response)
{
    $data = $request->getParsedBody();
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $Data_Buku = '';
        $db = getDB();
        $sql = "SELECT * FROM buku order by id_buku desc";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $Data_Buku = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        if ($Data_Buku)
            echo '{"Data_Buku": ' . json_encode($Data_Buku) . '}';
        else
            echo '{"Data_Buku": ""}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//POST data Buku untuk selanjutnya akan di simpan di tabel Buku
function Input_Buku($request, $response)
{

    $data = $request->getParsedBody();
    $nama_buku = $data['nama_buku'];
    $pengarang = $data['pengarang'];
    $stok = $data['stok'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "INSERT INTO buku(nama_buku, pengarang, stok) VALUES(:nama_buku ,:pengarang, :stok)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("nama_buku", $nama_buku, PDO::PARAM_STR);
        $stmt->bindParam("pengarang", $pengarang, PDO::PARAM_STR);
        $stmt->bindParam("stok", $stok, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Input_Buku": "input success"}';
        else
            echo '{"Input_Buku": "input error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//request data yang berada pada tabel Buku berdasarkan id_buku
function Get_Buku_Edit($request, $response)
{
    $data = $request->getParsedBody();
    $id_buku = $data['id_buku'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $Get_Buku_Edit = '';
        $db = getDB();
        $sql = "SELECT * FROM buku WHERE id_buku=:id_buku";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_buku", $id_buku, PDO::PARAM_STR);
        $stmt->execute();
        $Get_Buku_Edit = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        if ($Get_Buku_Edit)
            echo '{"Get_Buku_Edit": ' . json_encode($Get_Buku_Edit) . '}';
        else
            echo '{"Get_Buku_Edit": ""}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//POST data Buku ubah data berdasarkan id_buku
function Edit_Buku($request, $response)
{
    $data = $request->getParsedBody();
    $id_buku = $data['id_buku'];
    $nama_buku = $data['nama_buku'];
    $pengarang = $data['pengarang'];
    $stok = $data['stok'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "UPDATE buku SET nama_buku=:nama_buku, pengarang=:pengarang, stok=:stok WHERE id_buku=:id_buku";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_buku", $id_buku, PDO::PARAM_STR);
        $stmt->bindParam("nama_buku", $nama_buku, PDO::PARAM_STR);
        $stmt->bindParam("pengarang", $pengarang, PDO::PARAM_STR);
        $stmt->bindParam("stok", $stok, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Edit_Buku": "Edit success"}';
        else
            echo '{"Edit_Buku": "Edit error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//Untuk menghapus data Buku berdasarkan id_buku
function Delete_Buku($request, $response)
{
    $data = $request->getParsedBody();
    $id_buku = $data['id_buku'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "DELETE FROM buku WHERE id_buku=:id_buku";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_buku", $id_buku, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Delete_Buku": "Delete success"}';
        else
            echo '{"Delete_Buku": "Delete error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}