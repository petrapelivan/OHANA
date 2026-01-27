<?php
require_once "../config.php";

if (!isset($_SESSION['admin'])) {
    die("Nedozvoljen pristup");
}

$id = $_GET['id'] ?? 0;

$stmt = $conn->prepare("
    SELECT i.*, k.ime, k.prezime
    FROM izvjestaji i
    JOIN kumce k ON i.kumce_id = k.id
    WHERE i.id = ?
");
$stmt->bind_param("i", $id);
$stmt->execute();
$report = $stmt->get_result()->fetch_assoc();

if (!$report) {
    die("Izvještaj ne postoji");
}

$xml = new SimpleXMLElement('<izvjestaj/>');
$xml->addChild('id', $report['id']);
$xml->addChild('dijete', $report['ime'] . " " . $report['prezime']);
$xml->addChild('opis', $report['opis']);
$xml->addChild('skola', $report['skola']);
$xml->addChild('ocjena', $report['ocjena']);
$xml->addChild('zahvala', $report['zahvala']);
$xml->addChild('status', $report['status']);

$client = new SoapClient(null, [
    'location' => 'http://localhost/PHPProjekt/soap/ReportService.php',
    'uri' => 'http://localhost/PHPProjekt/soap'
]);

$response = $client->sendReport($xml->asXML());

echo "<h2>$response</h2>";
echo "<a href='reports.php'>← Povratak</a>";
