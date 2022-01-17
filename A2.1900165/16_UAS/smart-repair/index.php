<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
header('Content-Type: application/json');

require 'vendor/autoload.php';
require 'config.php';
$app = new Slim\App();

$app->get('/Data_Pelanggan','Data_Pelanggan');
$app->post('/Input_Pelanggan','Input_Pelanggan');
$app->post('/Get_Pelanggan_Edit','Get_Pelanggan_Edit');
$app->post('/Edit_Pelanggan','Edit_Pelanggan');
$app->post('/Delete_Pelanggan','Delete_Pelanggan');
$app->run();

//request semua data yang berada pada tabel pelanggan
function Data_Pelanggan($request, $response){
    $data = $request->getParsedBody();
    //$login=$data['login'];
    //$token=$data['token'];   
    //$systemToken=apiToken($login);
    try {         
        //if($systemToken == $token){
            $Data_Pelanggan = '';
            $db = getDB();            
            $sql = "SELECT * FROM pelanggan order by id_pelanggan desc";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $Data_Pelanggan = $stmt->fetchAll(PDO::FETCH_OBJ);           
            $db = null;
            if($Data_Pelanggan)
            echo '{"Data_Pelanggan": ' . json_encode($Data_Pelanggan) . '}';
            else
            echo '{"Data_Pelanggan": ""}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}       
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

//POST data pelanggan untuk selanjutnya akan di simpan di tabel pelanggan
function Input_Pelanggan($request, $response){

    $data = $request->getParsedBody();
    $nama_pelanggan=$data['nama_pelanggan'];
    $perbaikan=$data['perbaikan'];
    $harga_service=$data['harga_service'];
    //$login=$data['login'];
    //$token=$data['token'];   
    //$systemToken=apiToken($login);   
    try {         
        //if($systemToken == $token){
            $db = getDB();            
            $sql = "INSERT INTO pelanggan(nama_pelanggan, perbaikan, harga_service) VALUES(:nama_pelanggan ,:perbaikan, :harga_service)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("nama_pelanggan", $nama_pelanggan, PDO::PARAM_STR);
            $stmt->bindParam("perbaikan", $perbaikan, PDO::PARAM_STR);
            $stmt->bindParam("harga_service", $harga_service, PDO::PARAM_STR);
            $stmt->execute();        
            $db = null;
            if($stmt)
            echo '{"Input_Pelanggan": "input success"}';
            else
            echo '{"Input_Pelanggan": "input error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}       
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

//request data yang berada pada tabel pelanggan berdasarkan id_pelanggan
function Get_Pelanggan_Edit($request, $response){
    $data = $request->getParsedBody();
    $id_pelanggan=$data['id_pelanggan'];
    //$login=$data['login'];
    //$token=$data['token'];   
    //$systemToken=apiToken($login);   
    try {         
        //if($systemToken == $token){
      $Get_Pelanggan_Edit = '';
            $db = getDB();            
            $sql = "SELECT * FROM pelanggan WHERE id_pelanggan=:id_pelanggan";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("id_pelanggan", $id_pelanggan, PDO::PARAM_STR);
            $stmt->execute();  
            $Get_Pelanggan_Edit = $stmt->fetchAll(PDO::FETCH_OBJ);          
            $db = null;
            if($Get_Pelanggan_Edit)
            echo '{"Get_Pelanggan_Edit": ' . json_encode($Get_Pelanggan_Edit) . '}';
            else
            echo '{"Get_Pelanggan_Edit": ""}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}       
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

//POST data pelanggan ubah data berdasarkan id_pelanggan
function Edit_Pelanggan($request, $response){
    $data = $request->getParsedBody();
    $id_pelanggan=$data['id_pelanggan'];
    $nama_pelanggan=$data['nama_pelanggan'];
    $perbaikan=$data['perbaikan'];
    $harga_service=$data['harga_service'];
    //$login=$data['login'];
    //$token=$data['token'];   
    //$systemToken=apiToken($login);   
    try {         
        //if($systemToken == $token){
            $db = getDB();            
            $sql = "UPDATE pelanggan SET nama_pelanggan=:nama_pelanggan, perbaikan=:perbaikan, harga_service=:harga_service WHERE id_pelanggan=:id_pelanggan";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("id_pelanggan", $id_pelanggan, PDO::PARAM_STR);
            $stmt->bindParam("nama_pelanggan", $nama_pelanggan, PDO::PARAM_STR);
            $stmt->bindParam("perbaikan", $perbaikan, PDO::PARAM_STR);
            $stmt->bindParam("harga_service", $harga_service, PDO::PARAM_STR);
            $stmt->execute();        
            $db = null;
            if($stmt)
            echo '{"Edit_Pelanggan": "Edit success"}';
            else
            echo '{"Edit_Pelanggan": "Edit error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}       
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

//Untuk menghapus data pelanggan berdasarkan id_pelanggan
function Delete_Pelanggan($request, $response){
    $data = $request->getParsedBody();
    $id_pelanggan=$data['id_pelanggan'];
    //$login=$data['login'];
    //$token=$data['token'];   
    //$systemToken=apiToken($login);   
    try {         
        //if($systemToken == $token){
            $db = getDB();            
            $sql = "DELETE FROM pelanggan WHERE id_pelanggan=:id_pelanggan";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("id_pelanggan", $id_pelanggan, PDO::PARAM_STR);
            $stmt->execute(); 
            $db = null;
            if($stmt)
            echo '{"Delete_Pelanggan": "Delete success"}';
            else
            echo '{"Delete_Pelanggan": "Delete error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}       
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}