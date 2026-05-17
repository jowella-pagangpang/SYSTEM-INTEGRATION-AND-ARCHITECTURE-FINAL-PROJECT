<?php
require_once 'bims_api.php';

$bims = new BimsApi();

// Test get all residents
$residents = $bims->getAllResidents();

echo "<pre>";
print_r($residents);
echo "</pre>";