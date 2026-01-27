<?php

header('Content-Type: application/json; charset=utf-8');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once "../config.php";
require_once "../mailer/PHPMailer.php";
require_once "../mailer/SMTP.php";
require_once "../mailer/Exception.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["success" => false, "error" => "Method not allowed"]);
    exit;
}

$report_id = $_POST['id'] ?? null;
if (!$report_id) {
    http_response_code(400);
    echo json_encode(["success" => false, "error" => "Nedostaje ID izvještaja"]);
    exit;
}

$sql = "
SELECT i.*, kc.ime, kc.prezime
FROM izvjestaji i
JOIN kumce kc ON kc.id = i.kumce_id
WHERE i.id = ?
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $report_id);
$stmt->execute();
$report = $stmt->get_result()->fetch_assoc();

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'gsusa26@gmail.com'; 
    $mail->Password = 'sifra';    
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->CharSet = 'UTF-8'; 
    $mail->setFrom('gsusa26@gmail.com', 'OHANA');
    $mail->addAddress('pelivan.petra@gmail.com');

    $mail->Subject = 'Izvještaj za kumče';
    $mail->Body = "
Dijete: {$report['ime']} {$report['prezime']}

{$report['opis']}

Zahvala:
{$report['zahvala']}
";

    $mail->send();
    //echo json_encode(["success" => true]);
    echo json_encode([
    "success" => true,
    "message" => "Mail je uspješno poslan."
    ]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "error" => $mail->ErrorInfo
    ]);
}