<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
header('Content-Type: application/json');

require 'vendor/autoload.php';
require 'config.php';
$app = new Slim\App();

$app->get('/Data_Hp','Data_Hp');
$app->post('/Input_Hp','Input_Hp');
$app->post('/Get_Hp_Edit','Get_Hp_Edit');
$app->post('/Edit_Hp','Edit_Hp');
$app->post('/Delete_Hp','Delete_Hp');
$app->run();

//request semua data yang berada pada tabel hp
function Data_Hp($request, $response){
    $data = $request->getParsedBody();
    //$login=$data['login'];
    //$token=$data['token'];   
    //$systemToken=apiToken($login);   
    try {         
        //if($systemToken == $token){
            $Data_Hp = '';
            $db = getDB();            
            $sql = "SELECT * FROM hp order by id_hp desc";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $Data_Hp = $stmt->fetchAll(PDO::FETCH_OBJ);           
            $db = null;
            if($Data_Hp)
            echo '{"Data_Hp": ' . json_encode($Data_Hp) . '}';
            else
            echo '{"Data_Hp": ""}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}       
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

//POST data hp untuk selanjutnya akan di simpan di tabel hp
function Input_Hp($request, $response){

    $data = $request->getParsedBody();
    $nama_hp=$data['nama_hp'];
    $jenis=$data['jenis'];
    $harga=$data['harga'];
    //$login=$data['login'];
    //$token=$data['token'];   
    //$systemToken=apiToken($login);   
    try {         
        //if($systemToken == $token){
            $db = getDB();            
            $sql = "INSERT INTO hp(nama_hp, jenis, harga) VALUES(:nama_hp ,:jenis, :harga)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("nama_hp", $nama_hp, PDO::PARAM_STR);
            $stmt->bindParam("jenis", $jenis, PDO::PARAM_STR);
            $stmt->bindParam("harga", $harga, PDO::PARAM_STR);
            $stmt->execute();        
            $db = null;
            if($stmt)
            echo '{"Input_Hp": "input success"}';
            else
            echo '{"Input_Hp": "input error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}       
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

//request data yang berada pada tabel hp berdasarkan id_hp
function Get_Hp_Edit($request, $response){
    $data = $request->getParsedBody();
    $id_hp=$data['id_hp'];
    //$login=$data['login'];
    //$token=$data['token'];   
    //$systemToken=apiToken($login);   
    try {         
        //if($systemToken == $token){
      $Get_Hp_Edit = '';
            $db = getDB();            
            $sql = "SELECT * FROM hp WHERE id_hp=:id_hp";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("id_hp", $id_hp, PDO::PARAM_STR);
            $stmt->execute();  
            $Get_Hp_Edit = $stmt->fetchAll(PDO::FETCH_OBJ);          
            $db = null;
            if($Get_Hp_Edit)
            echo '{"Get_Hp_Edit": ' . json_encode($Get_Hp_Edit) . '}';
            else
            echo '{"Get_Hp_Edit": ""}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}       
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

//POST data hp ubah data berdasarkan id_hp
function Edit_Hp($request, $response){
    $data = $request->getParsedBody();
    $id_hp=$data['id_hp'];
    $nama_hp=$data['nama_hp'];
    $jenis=$data['jenis'];
    $harga=$data['harga'];
    //$login=$data['login'];
    //$token=$data['token'];   
    //$systemToken=apiToken($login);   
    try {         
        //if($systemToken == $token){
            $db = getDB();            
            $sql = "UPDATE hp SET nama_hp=:nama_hp, jenis=:jenis, harga=:harga WHERE id_hp=:id_hp";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("id_hp", $id_hp, PDO::PARAM_STR);
            $stmt->bindParam("nama_hp", $nama_hp, PDO::PARAM_STR);
            $stmt->bindParam("jenis", $jenis, PDO::PARAM_STR);
            $stmt->bindParam("harga", $harga, PDO::PARAM_STR);
            $stmt->execute();        
            $db = null;
            if($stmt)
            echo '{"Edit_Hp": "Edit success"}';
            else
            echo '{"Edit_Hp": "Edit error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}       
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

//Untuk menghapus data hp berdasarkan id_hp
function Delete_Hp($request, $response){
    $data = $request->getParsedBody();
    $id_hp=$data['id_hp'];
    //$login=$data['login'];
    //$token=$data['token'];   
    //$systemToken=apiToken($login);   
    try {         
        //if($systemToken == $token){
            $db = getDB();            
            $sql = "DELETE FROM hp WHERE id_hp=:id_hp";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("id_hp", $id_hp, PDO::PARAM_STR);
            $stmt->execute(); 
            $db = null;
            if($stmt)
            echo '{"Delete_Hp": "Delete success"}';
            else
            echo '{"Delete_Hp": "Delete error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}       
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}