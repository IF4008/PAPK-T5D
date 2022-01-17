<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
header('Content-Type: application/json');

require 'vendor/autoload.php';
require 'config.php';
$app = new Slim\App();

$app->get('/Data_User', 'Data_User');
$app->post('/Input_User', 'Input_User');
$app->post('/Get_User_Edit', 'Get_User_Edit');
$app->post('/Edit_User', 'Edit_User');
$app->post('/Delete_User', 'Delete_User');
$app->run();

//request semua data yang berada pada tabel barang
function Data_User($request, $response)
{
    $data = $request->getParsedBody();
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $Data_User = '';
        $db = getDB();
        $sql = "SELECT * FROM user order by id_user desc";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $Data_User = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        if ($Data_User)
            echo '{"Data_User": ' . json_encode($Data_User) . '}';
        else
            echo '{"Data_User": ""}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//POST data barang untuk selanjutnya akan di simpan di tabel barang
function Input_User($request, $response)
{

    $data = $request->getParsedBody();
    $nama = $data['nama'];
    $email = $data['email'];
    $password = $data['password'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "INSERT INTO user(nama, email, password) VALUES(:nama ,:email, :password)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("nama", $nama, PDO::PARAM_STR);
        $stmt->bindParam("email", $email, PDO::PARAM_STR);
        $stmt->bindParam("password", $password, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Input_User": "input success"}';
        else
            echo '{"Input_User": "input error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//request data yang berada pada tabel barang berdasarkan id_barang
function Get_User_Edit($request, $response)
{
    $data = $request->getParsedBody();
    $id_user = $data['id_user'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $Get_User_Edit = '';
        $db = getDB();
        $sql = "SELECT * FROM user WHERE id_user=:id_user";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_user", $id_user, PDO::PARAM_STR);
        $stmt->execute();
        $Get_User_Edit = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        if ($Get_User_Edit)
            echo '{"Get_User_Edit": ' . json_encode($Get_User_Edit) . '}';
        else
            echo '{"Get_User_Edit": ""}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//POST data barang ubah data berdasarkan id_barang
function Edit_User($request, $response)
{
    $data = $request->getParsedBody();
    $id_user = $data['id_user'];
    $nama = $data['nama'];
    $email = $data['email'];
    $password = $data['password'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "UPDATE user SET nama=:nama, email=:email, password=:password WHERE id_user=:id_user";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_user", $id_user, PDO::PARAM_STR);
        $stmt->bindParam("nama", $nama, PDO::PARAM_STR);
        $stmt->bindParam("email", $email, PDO::PARAM_STR);
        $stmt->bindParam("password", $password, PDO::PARAM_STR);
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
function Delete_User($request, $response)
{
    $data = $request->getParsedBody();
    $id_user = $data['id_user'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "DELETE FROM user WHERE id_user=:id_user";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_user", $id_user, PDO::PARAM_STR);
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