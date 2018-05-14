<?php
ini_set('error_reporing', E_ALL);
ini_set('display_errors', 1);
require_once 'reports.php';

$reports = new Reports();
$reports->connectDB();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['method'] == 'post'){
        $host = htmlspecialchars(trim($_POST['host']));
        $code = (int)htmlspecialchars(trim($_POST['code']));
        $message = htmlspecialchars(trim($_POST['message']));
        $newReports = Reports::newEmptyInstance();
        $newReports->setHost($host);
        $newReports->setCode($code);
        $newReports->setMessage($message);
        $newReports->connectDB();
        $newReports->save();
//        header('Content-type: application/json');
//        $jsonData = json_encode($newReports->toArray());
//        die();

    } elseif ($_POST['method'] == 'put'){
        $id = htmlspecialchars(trim($_POST['id']));
        $host = htmlspecialchars(trim($_POST['host']));
        $code = (int)htmlspecialchars(trim($_POST['code']));
        $message = htmlspecialchars(trim($_POST['message']));
        $upReports = Reports::newEmptyInstance();
        $upReports->setId($id);
        $upReports->setHost($host);
        $upReports->setCode($code);
        $upReports->setMessage($message);
        $upReports->connectDB();
        $upReports->save();
//        header('Content-type: application/json');
//        $jsonData = json_encode($upReports->toArray());
//        die();

    } elseif ($_POST['method'] == 'delete'){
        $idForDelete = (int) $_POST['id'];
        $reports->delete($idForDelete);
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET"){
    if ($_GET['method'] == 'get'){
        $reports = $reports->findIndex($_GET['id']);
    }
}

?>