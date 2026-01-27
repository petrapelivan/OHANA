<?php
require_once "../config.php";

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$report_id = $_GET['id'];

$ch = curl_init("http://localhost/PHPProjekt/api/send-report-mail.php");

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
    'id' => $report_id
]));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$data = json_decode($response, true);

if ($data && isset($data['success']) && $data['success']) {
    $_SESSION['success'] = $data['message'];
} else {
    $_SESSION['error'] = $data['error'] ?? 'Greška pri slanju maila';
}

curl_close($ch);

header("Location: reports.php");
exit;
?>