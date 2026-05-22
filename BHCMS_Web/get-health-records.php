<?php
header('Content-Type: application/json');
include('pages/dbcon.php');

$apiKey = "bims-secret-key-2024";
/*
if (!isset($_SERVER['HTTP_X_API_KEY']) || $_SERVER['HTTP_X_API_KEY'] !== $apiKey) {
    echo json_encode(["error" => "Invalid API Key"]);
    exit;
}
*/
$bims_resident_id = $_GET['bims_resident_id'] ?? '';

if (empty($bims_resident_id)) {
    echo json_encode(["error" => "Missing BIMS resident ID"]);
    exit;
}

$clientQuery = mysqli_query($con, "
    SELECT * FROM client 
    WHERE bims_resident_id = '$bims_resident_id'
");

$client = mysqli_fetch_assoc($clientQuery);

if (!$client) {
    echo json_encode(["message" => "No health record found"]);
    exit;
}

$client_id = $client['id'];

$data = [
    "client" => $client,
    "immunization" => [],
    "deworming" => [],
    "nutrition" => [],
    "maternal" => [],
    "postpartum" => [],
    "sickchildren" => [],
    "consultation" => []
];

$tables = [
    "immunization" => "immunization",
    "deworming" => "deworming",
    "nutrition" => "nutrition2",
    "maternal" => "maternal",
    "postpartum" => "postpartum",
    "sickchildren" => "sickchildren",
    "consultation" => "consultation"
];

foreach ($tables as $key => $table) {
    $q = mysqli_query($con, " SELECT * FROM $table WHERE patientid='$client_id' ");

if(!$q)
{
    die(
    json_encode([
    "table"=>$table,
    "sql_error"=>mysqli_error($con)
    ]));
}

while($row=mysqli_fetch_assoc($q))
{
   $data[$key][]=$row;
}
}

echo json_encode($data);
?>