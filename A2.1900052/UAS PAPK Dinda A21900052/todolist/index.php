<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
header('Content-Type: application/json');

require 'vendor/autoload.php';
require 'config.php';
$app = new Slim\App();

$app->get('/Data_List','Data_List');
$app->post('/Input_List','Input_List');
$app->post('/Get_List_Edit','Get_List_Edit');
$app->post('/Edit_List','Edit_List');
$app->post('/Delete_List','Delete_List');
$app->run();

function Data_List($request, $response){
    $data = $request->getParsedBody();
    try {         
            $Data_List = '';
            $db = getDB();            
            $sql = "SELECT * FROM tbl_list order by list_id desc";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $Data_List = $stmt->fetchAll(PDO::FETCH_OBJ);           
            $db = null;
            if($Data_List)
            echo '{"Data_List": ' . json_encode($Data_List) . '}';
            else
            echo '{"Data_List": ""}';
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

//POST data barang untuk selanjutnya akan di simpan di tabel barang
function Input_List($request, $response){

    $data = $request->getParsedBody();
    $list_judul=$data['list_judul'];
    $list_ket=$data['list_ket'];
    $list_deadline=$data['list_deadline'];  
    try {         
            $db = getDB();            
            $sql = "INSERT INTO tbl_list(list_judul, list_ket, list_deadline) VALUES(:list_judul ,:list_ket, :list_deadline)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("list_judul", $list_judul, PDO::PARAM_STR);
            $stmt->bindParam("list_ket", $list_ket, PDO::PARAM_STR);
            $stmt->bindParam("list_deadline", $list_deadline, PDO::PARAM_STR);
            $stmt->execute();        
            $db = null;
            if($stmt)
            echo '{"Input_List": "input success"}';
            else
            echo '{"Input_List": "input error"}';
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function Get_List_Edit($request, $response){
    $data = $request->getParsedBody();
    $list_id=$data['list_id'];
    //$login=$data['login'];
    //$token=$data['token'];   
    //$systemToken=apiToken($login);   
    try {         
        //if($systemToken == $token){
      $Get_List_Edit = '';
            $db = getDB();            
            $sql = "SELECT * FROM tbl_list WHERE list_id=:list_id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("list_id", $list_id, PDO::PARAM_STR);
            $stmt->execute();  
            $Get_List_Edit = $stmt->fetchAll(PDO::FETCH_OBJ);          
            $db = null;
            if($Get_List_Edit)
            echo '{"Get_List_Edit": ' . json_encode($Get_List_Edit) . '}';
            else
            echo '{"Get_List_Edit": ""}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}       
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

//POST data barang ubah data berdasarkan id_barang
function Edit_List($request, $response){
    $data = $request->getParsedBody();
    $list_id=$data['list_id'];
    $list_judul=$data['list_judul'];
    $list_ket=$data['list_ket'];
    $list_deadline=$data['list_deadline'];
    //$login=$data['login'];
    //$token=$data['token'];   
    //$systemToken=apiToken($login);   
    try {         
        //if($systemToken == $token){
            $db = getDB();            
            $sql = "UPDATE tbl_list SET list_judul=:list_judul, list_ket=:list_ket, list_deadline=:list_deadline WHERE list_id=:list_id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("list_id", $list_id, PDO::PARAM_STR);
            $stmt->bindParam("list_judul", $list_judul, PDO::PARAM_STR);
            $stmt->bindParam("list_ket", $list_ket, PDO::PARAM_STR);
            $stmt->bindParam("list_deadline", $list_deadline, PDO::PARAM_STR);
            $stmt->execute();        
            $db = null;
            if($stmt)
            echo '{"Edit_List": "Edit success"}';
            else
            echo '{"Edit_List": "Edit error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}       
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function Delete_List($request, $response){
    $data = $request->getParsedBody();
    $list_id=$data['list_id'];
    try {         
            $db = getDB();            
            $sql = "DELETE FROM tbl_list WHERE list_id=:list_id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("list_id", $list_id, PDO::PARAM_STR);
            $stmt->execute(); 
            $db = null;
            if($stmt)
            echo '{"Delete_List": "Delete success"}';
            else
            echo '{"Delete_List": "Delete error"}';
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}