<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
header('Content-Type: application/json');

require 'vendor/autoload.php';
require 'config.php';
$app = new Slim\App();

$app->get('/Data_Nilai','Data_Nilai');
$app->post('/Input_Nilai','Input_Nilai');
$app->post('/Get_Nilai_Edit','Get_Nilai_Edit');
$app->post('/Edit_Nilai','Edit_Nilai');
$app->post('/Delete_Nilai','Delete_Nilai');
$app->run();

function Data_Nilai($request, $response){
    $data= $request->getParsedBody();
    try{
        $Data_Nilai='';
        $db=getDB();
        $sql="SELECT * FROM nilai order by id_nilai desc";
        $stmt=$db->prepare($sql);
        $stmt->execute();
        $Data_Nilai=$stmt->fetchAll(PDO::FETCH_OBJ);
        $db=null;
        if($Data_Nilai)
        echo '{"Data_Nilai": ' . json_encode($Data_Nilai) .'}';
        else
        echo '{"Data_Nilai": }';
    }catch(PDOException $ex){
        echo '{"error":{"text":' . $ex->getMessage().'}}';
    }
}

function Input_Nilai($request,$response){
    $data=$request->getParsedBody();
    $nama_siswa=$data['nama_siswa'];
    $nama_mapel=$data['nama_mapel'];
    $nilai=$data['nilai_mapel'];
    try {
        $db=getDB();
        $sql="INSERT INTO nilai(nama_siswa,nama_mapel,nilai_mapel) VALUES(:nama_siswa, :nama_mapel,:nilai_mapel)";
        $stmt=$db->prepare($sql);
        $stmt->bindParam("nama_siswa",$nama_siswa,PDO::PARAM_STR);
        $stmt->bindParam("nama_mapel",$nama_mapel,PDO::PARAM_STR);
        $stmt->bindParam("nilai_mapel",$nilai,PDO::PARAM_STR);
        $stmt->execute();
        $db=null;
        if($stmt)
        echo '{"Input_Nilai":"Input Success"}';
        else
        echo '{"Input_Nilai":"Input error"}';
    } catch (PDOException $ex) {
        echo '{"error":{"text":' . $ex->getMessage().'}}';
    }
}
function Get_Nilai_Edit($request, $response){
    $data = $request->getParsedBody();
    $id_nilai=$data['id_nilai'];
    try {
        $Get_Nilai_Edit='';
        $db=getDB();
        $sql="SELECT * FROM nilai WHERE id_nilai=:id_nilai";
        $stmt=$db->prepare($sql);
        $stmt->bindParam("id_nilai",$id_nilai,PDO::PARAM_STR);
        $stmt->execute();
        $Get_Nilai_Edit=$stmt->fetchAll(PDO::FETCH_OBJ);
        $db=null;
        if($Get_Nilai_Edit)
        echo '{"Get_Nilai_Edit":' .json_encode($Get_Nilai_Edit).'}';
        else
        echo '{"Get_Nilai_Edit" : ""}';
    } catch (PDOException $ex) {
        echo '{"error":{"text":' . $ex->getMessage().'}}';
    }
}
function Edit_Nilai($request,$response){
    $data=$request->getParsedBody();
    $id_nilai=$data['id_nilai'];
    $nama_siswa=$data['nama_siswa'];
    $nama_mapel=$data['nama_mapel'];
    $nilai_mapel=$data['nilai_mapel'];

    try{
        $db=getDB();
        $sql ="UPDATE nilai SET nama_siswa=:nama_siswa, nama_mapel=:nama_mapel,nilai_mapel=:nilai_mapel where id_nilai=:id_nilai";
        $stmt=$db->prepare($sql);
        $stmt->bindParam("id_nilai",$id_nilai,PDO::PARAM_STR);
        $stmt->bindParam("nama_siswa",$nama_siswa,PDO::PARAM_STR);
        $stmt->bindParam("nama_mapel",$nama_mapel,PDO::PARAM_STR);
        $stmt->bindParam("nilai_mapel",$nilai_mapel,PDO::PARAM_STR);
        $stmt->execute();
        $db=null;
        if ($stmt) {
            echo '{"Edit_Nilai": "Edit Berhasil"}';
            
        }else
        echo '{"Edit_Nilai": "Edit gagal"}';
    }catch(PDOException $ex){
        echo '{"error":{"text":' . $ex->getMessage().'}}';
    }
}
function Delete_Nilai($request,$response){
    $data=$request->getParsedBody();
    $id_nilai=$data['id_nilai'];
    try {
        $db= getDB();
        $sql = "DELETE FROM nilai WHERE id_nilai=:id_nilai";
        $stmt=$db->prepare($sql);
        $stmt->bindParam("id_nilai",$id_nilai, PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt) {
            echo '{"Delete_Nilai": "Delete Berhasil"}';
            
        }else
        echo '{"Delete_Nilai": "Delete gagal"}';
    } catch (PDOException $ex) {
        echo '{"error":{"text":' . $ex->getMessage().'}}';
    }
}