<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
header('Content-Type: application/json');

require 'vendor/autoload.php';
require 'config.php';
$app = new Slim\App();

$app->get('/Data_Menu', 'Data_Menu');
$app->post('/Input_Menu', 'Input_Menu');
$app->post('/Get_Menu_Edit', 'Get_Menu_Edit');
$app->post('/Edit_Menu', 'Edit_Menu');
$app->post('/Delete_Menu', 'Delete_Menu');
$app->run();

//request semua data yang berada pada tabel menu
function Data_Menu($request, $response)
{
    $data = $request->getParsedBody();
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $Data_Menu = '';
        $db = getDB();
        $sql = "SELECT * FROM menu order by id_menu desc";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $Data_Menu = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        if ($Data_Menu)
            echo '{"Data_Menu": ' . json_encode($Data_Menu) . '}';
        else
            echo '{"Data_Menu": ""}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//POST data menu untuk selanjutnya akan di simpan di tabel menu
function Input_Menu($request, $response)
{

    $data = $request->getParsedBody();
    $nama_menu = $data['nama_menu'];
    $qty = $data['qty'];
    $harga = $data['harga'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "INSERT INTO menu(nama_menu, qty, harga) VALUES(:nama_menu ,:qty, :harga)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("nama_menu", $nama_menu, PDO::PARAM_STR);
        $stmt->bindParam("qty", $qty, PDO::PARAM_STR);
        $stmt->bindParam("harga", $harga, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Input_Menu": "input success"}';
        else
            echo '{"Input_Menu": "input error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//request data yang berada pada tabel menu berdasarkan id_menu
function Get_Menu_Edit($request, $response)
{
    $data = $request->getParsedBody();
    $id_menu = $data['id_menu'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $Get_Menu_Edit = '';
        $db = getDB();
        $sql = "SELECT * FROM menu WHERE id_menu=:id_menu";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_menu", $id_menu, PDO::PARAM_STR);
        $stmt->execute();
        $Get_Menu_Edit = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        if ($Get_Menu_Edit)
            echo '{"Get_Menu_Edit": ' . json_encode($Get_Menu_Edit) . '}';
        else
            echo '{"Get_Menu_Edit": ""}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//POST data menu ubah data berdasarkan id_menu
function Edit_Menu($request, $response)
{
    $data = $request->getParsedBody();
    $id_menu = $data['id_menu'];
    $nama_menu = $data['nama_menu'];
    $qty = $data['qty'];
    $harga = $data['harga'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "UPDATE menu SET nama_menu=:nama_menu, qty=:qty, harga=:harga WHERE id_menu=:id_menu";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_menu", $id_menu, PDO::PARAM_STR);
        $stmt->bindParam("nama_menu", $nama_menu, PDO::PARAM_STR);
        $stmt->bindParam("qty", $qty, PDO::PARAM_STR);
        $stmt->bindParam("harga", $harga, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Edit_Menu": "Edit success"}';
        else
            echo '{"Edit_Menu": "Edit error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//Untuk menghapus data menu berdasarkan id_menu
function Delete_Menu($request, $response)
{
    $data = $request->getParsedBody();
    $id_menu = $data['id_menu'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "DELETE FROM menu WHERE id_menu=:id_menu";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_menu", $id_menu, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Delete_Menu": "Delete success"}';
        else
            echo '{"Delete_Menu": "Delete error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}
