<?php
header("Content-Type: application/json");

$API_BASE = "https://localhost:44315/api";
$API_KEY = "bims-secret-key-2024";

$q = isset($_GET['q']) ? $_GET['q'] : "";

if($q == ""){
  echo json_encode([]);
  exit();
}

$ch = curl_init($API_BASE . "/Residents/search?q=" . urlencode($q));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
  "X-API-KEY: $API_KEY",
  "Content-Type: application/json"
]);

$response = curl_exec($ch);
$error = curl_error($ch);
curl_close($ch);

if($error || !$response){
  echo json_encode([]);
  exit();
}

echo $response;
?>