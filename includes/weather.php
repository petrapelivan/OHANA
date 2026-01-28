<?php
$url = "https://api.open-meteo.com/v1/forecast?latitude=-10.6833&longitude=35.65&current_weather=true";

$response = file_get_contents($url);

if ($response === false) {
    echo "Greška pri dohvaćanju podataka s API-ja.";
    exit;
}

$data = json_decode($response, true);

if (!isset($data['current_weather'])) {
    echo "API nije vratio podatke o trenutnom vremenu.";
    exit;
}

$temp = $data['current_weather']['temperature'];
$time = $data['current_weather']['time'];

echo "<div class='weather'>";
echo "<h3>Trenutna temperatura (Songea, TZ)</h3>";
echo "<p><strong>{$temp}°C</strong></p>";
echo "<p>Vrijeme: {$time}</p>";
echo "</div>";
?>
