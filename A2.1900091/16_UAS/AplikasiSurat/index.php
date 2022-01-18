<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
header('Content-Type: application/json');

require 'vendor/autoload.php';
require 'config.php';
$app = new Slim\App();

$app->get('/Data_Surat','Data_Surat');
$app->post('/Input_Surat','Input_Surat');
$app->post('/Get_Edit_Surat','Get_Edit_Surat');
$app->post('/Edit_Surat','Edit_Surat');
$app->post('/Delete_Surat','Delete_Surat');
$app->run();

function Data_Surat($request, $response){
    $data = $request->getParsedBody();
    try {         
            $Data_Surat = '';
            $db = getDB();            
            $sql = "SELECT * FROM surat order by id_surat desc";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $Data_Surat = $stmt->fetchAll(PDO::FETCH_OBJ);           
            $db = null;
            if($Data_Surat)
            echo '{"Data_Surat": ' . json_encode($Data_Surat) . '}';
            else
            echo '{"Data_Surat": ""}';     
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function Input_Surat($request, $response){

    $data = $request->getParsedBody();
    $nomor_surat=$data['nomor_surat'];
    $jenis=$data['jenis_surat'];
    $isi=$data['isi_surat'];
    try {         
            $db = getDB();            
            $sql = "INSERT INTO surat(nomor_surat, jenis_surat, isi_surat) VALUES(:nama_surat ,:jenis_surat, :isi_surat)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("nama_surat", $nomor_surat, PDO::PARAM_STR);
            $stmt->bindParam("jenis_surat", $jenis, PDO::PARAM_STR);
            $stmt->bindParam("isi_surat", $isi, PDO::PARAM_STR);
            $stmt->execute();        
            $db = null;
            if($stmt)
            echo '{"Input_Surat": "input success"}';
            else
            echo '{"Input_Surat": "input error"}';
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function Get_Edit_Surat($request, $response){
    $data = $request->getParsedBody();
    $id_surat=$data['id_surat']; 
    try {         
      $Get_Edit_Surat = '';
            $db = getDB();            
            $sql = "SELECT * FROM surat WHERE id_surat=:id_surat";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("id_surat", $id_surat, PDO::PARAM_STR);
            $stmt->execute();  
            $Get_Edit_Surat = $stmt->fetchAll(PDO::FETCH_OBJ);          
            $db = null;
            if($Get_Edit_Surat)
            echo '{"Get_Edit_Surat": ' . json_encode($Get_Edit_Surat) . '}';
            else
            echo '{"Get_Edit-Surat": ""}';    
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function Edit_Surat($request, $response){
    $data = $request->getParsedBody();
    $id_surat=$data['id_surat']; 
    $nomor_surat=$data['nomor_surat'];
    $jenis=$data['jenis_surat'];
    $isi=$data['isi_surat'];
    try {         
            $db = getDB();            
            $sql = "UPDATE surat SET nomor_surat=:nomor_surat, jenis_surat=:jenis_surat, isi_surat=:isi_surat WHERE id_surat=:id_surat";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("id_surat", $id_surat, PDO::PARAM_STR);
            $stmt->bindParam("nomor_surat", $nomor_surat, PDO::PARAM_STR);
            $stmt->bindParam("jenis_surat", $jenis, PDO::PARAM_STR);
            $stmt->bindParam("isi_surat", $isi, PDO::PARAM_STR);
            $stmt->execute();        
            $db = null;
            if($stmt)
            echo '{"Edit_Surat": "Edit success"}';
            else
            echo '{"Edit_Surat": "Edit error"}';
    
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function Delete_Surat($request, $response){
    $data = $request->getParsedBody();
    $id_surat=$data['id_surat'];
   
    try {         
            $db = getDB();            
            $sql = "DELETE FROM surat WHERE id_surat=:id_surat";
            $stmt = $db->prepare($sql);
            $stmt->bindParam("id_surat", $id_surat, PDO::PARAM_STR);
            $stmt->execute(); 
            $db = null;
            if($stmt)
            echo '{"Delete_Surat": "Delete success"}';
            else
            echo '{"Delete_Surat": "Delete error"}'; 
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}