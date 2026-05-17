<?php
header('Content-Type: application/json');
require_once 'bims_api.php';

$query = $_GET['q'] ?? '';

if (empty($query)) {
    echo json_encode([]);
    exit;
}

$bims = new BimsApi();
$results = $bims->searchResidents($query);

// Kung error ang result
if (isset($results['error'])) {
    echo json_encode([]);
    exit;
}

echo json_encode($results);