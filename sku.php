<?php
require_once "functions.php";

if (!isset($_REQUEST['sku'])) {
    $sku = null;
} else {
    $sku = $_REQUEST['sku'];
}
$lic_key = '';
$data = [];
if (!isset($sku)) {
    json_response(['error' => 'SKU not exist'], 200);
} else {
    $lic_key = str_replace(PHP_EOL, '', GetLicKey($sku, directory));
    if ($lic_key != false) {
        $data[] = ['sku' => $sku, 'key' => $lic_key];
        json_response($data, 200);
    } else {
        json_response(['error' => 'SKU not exist'], 200);
    }
}