<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
header('Content-Type: application/json');

require 'vendor/autoload.php';
require 'config.php';
$app = new Slim\App();

$app->get('/Data_pinjaman', 'Data_pinjaman');
$app->post('/Input_pinjaman', 'Input_pinjaman');
$app->post('/Get_pinjaman_Edit', 'Get_pinjaman_Edit');
$app->post('/Edit_pinjaman', 'Edit_pinjaman');
$app->post('/Delete_pinjaman', 'Delete_pinjaman');
$app->run();

//request semua data yang berada pada tabel pinjaman
function Data_pinjaman($request, $response)
{
    $data = $request->getParsedBody();
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $Data_pinjaman = '';
        $db = getDB();
        $sql = "SELECT * FROM pinjaman order by id_pinjaman desc";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $Data_pinjaman = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        if ($Data_pinjaman)
            echo '{"Data_pinjaman": ' . json_encode($Data_pinjaman) . '}';
        else
            echo '{"Data_pinjaman": ""}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//POST data pinjaman untuk selanjutnya akan di simpan di tabel pinjaman
function Input_pinjaman($request, $response)
{

    $data = $request->getParsedBody();
    $nama_pinjaman = $data['nama_pinjaman'];
    $jumlah = $data['jumlah'];
    $waktu = $data['waktu'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "INSERT INTO pinjaman(nama_pinjaman, jumlah, waktu) VALUES(:nama_pinjaman ,:jumlah, :waktu)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("nama_pinjaman", $nama_pinjaman, PDO::PARAM_STR);
        $stmt->bindParam("jumlah", $jumlah, PDO::PARAM_STR);
        $stmt->bindParam("waktu", $waktu, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Input_pinjaman": "input success"}';
        else
            echo '{"Input_pinjaman": "input error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//request data yang berada pada tabel pinjaman berdasarkan id_pinjaman
function Get_pinjaman_Edit($request, $response)
{
    $data = $request->getParsedBody();
    $id_pinjaman = $data['id_pinjaman'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $Get_pinjaman_Edit = '';
        $db = getDB();
        $sql = "SELECT * FROM pinjaman WHERE id_pinjaman=:id_pinjaman";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_pinjaman", $id_pinjaman, PDO::PARAM_STR);
        $stmt->execute();
        $Get_pinjaman_Edit = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        if ($Get_pinjaman_Edit)
            echo '{"Get_pinjaman_Edit": ' . json_encode($Get_pinjaman_Edit) . '}';
        else
            echo '{"Get_pinjaman_Edit": ""}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//POST data pinjaman ubah data berdasarkan id_pinjaman
function Edit_pinjaman($request, $response)
{
    $data = $request->getParsedBody();
    $id_pinjaman = $data['id_pinjaman'];
    $nama_pinjaman = $data['nama_pinjaman'];
    $jumlah = $data['jumlah'];
    $waktu = $data['waktu'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "UPDATE pinjaman SET nama_pinjaman=:nama_pinjaman, jumlah=:jumlah, waktu=:waktu WHERE id_pinjaman=:id_pinjaman";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_pinjaman", $id_pinjaman, PDO::PARAM_STR);
        $stmt->bindParam("nama_pinjaman", $nama_pinjaman, PDO::PARAM_STR);
        $stmt->bindParam("jumlah", $jumlah, PDO::PARAM_STR);
        $stmt->bindParam("waktu", $waktu, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Edit_pinjaman": "Edit success"}';
        else
            echo '{"Edit_pinjaman": "Edit error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

//Untuk menghapus data pinjaman berdasarkan id_pinjaman
function Delete_pinjaman($request, $response)
{
    $data = $request->getParsedBody();
    $id_pinjaman = $data['id_pinjaman'];
    //$login=$data['login'];
    //$token=$data['token'];
    //$systemToken=apiToken($login);
    try {
        //if($systemToken == $token){
        $db = getDB();
        $sql = "DELETE FROM pinjaman WHERE id_pinjaman=:id_pinjaman";
        $stmt = $db->prepare($sql);
        $stmt->bindParam("id_pinjaman", $id_pinjaman, PDO::PARAM_STR);
        $stmt->execute();
        $db = null;
        if ($stmt)
            echo '{"Delete_pinjaman": "Delete success"}';
        else
            echo '{"Delete_pinjaman": "Delete error"}';
        //} else{
        //    echo '{"error":{"text":"No access"}}';
        //}
    } catch (PDOException $e) {
        echo '{"error":{"text":' . $e->getMessage() . '}}';
    }
}