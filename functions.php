<?php

require_once "config.php";
function json_response($data = null, $httpStatus = 200)
{
    header("Content-Type: application/json");
    $json = json_encode($data);
    if ($json === false) {
        // Проверка на пустую строку (которая является недействительным JSON)
        $json = json_encode(["jsonError" => json_last_error_msg()]);
        if ($json === false) {
            // Этого не должно быть, но мна всякий случай проверим еще раз:
            $json = '{"jsonError":"unknown"}';
        }
    }
    echo $json;
}
function GetLicKey($sku, $dir)
{
    $filename = __DIR__ . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . $sku . '.txt';
    if (file_exists($filename) === true) {
        $array = file($filename);
        $last = array_pop($array);
        $file = file($filename);
        array_pop($file); //Удаление последней записи
        $str = implode('', $file); //собираем строку для возврата в файл
        file_put_contents($filename, $str);
        return $last;
    } else {
        return false;
    }
}
