<?php

function formatDate($date, $format = 'Y-m-d')
{
    return date($format, strtotime($date));
}

function limitDatetimeOTP($time)
{
    return date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' ' . $time . ' minutes'));
}

function convertToAscii($data, $kode)
{
    $ascii = '';
    for ($i = 0; $i < strlen($data); $i++) {
        $kalkulasi = 0;
        foreach ($kode as $key => $kodena) {
            if ($key % 2 == 0) {
                $kalkulasi -= $kodena; // edit konfersinya
            } else {
                $kalkulasi += $kodena; // edit konfersinya
            }
        }
        $ascii .= ord($data[$i]) + $kalkulasi . ' ';
    }
    return trim($ascii);
}

function convertFromAscii($ascii, $kode)
{
    $chars = explode(' ', $ascii);
    $data = '';
    foreach ($chars as $char) {
        if (!empty($char)) {
            $kalkulasi = 0;
            foreach ($kode as $key => $kodena) {
                if ($key % 2 == 0) {
                    $kalkulasi -= $kodena; // edit konfersinya
                } else {
                    $kalkulasi += $kodena; // edit konfersinya
                }
            }
            $data .= chr($char - $kalkulasi);
        }
    }
    return $data;
}

function convertToOpensll($data, $kode)
{
    $key = 'superbwx';
    $encrypted = openssl_encrypt($data, 'AES-256-CBC', $key, 0, $kode);
    return base64_encode($encrypted);
}

function convertFromOpensll($data, $kode)
{
    $key = 'superbwx';
    $data = base64_decode($data);
    return openssl_decrypt($data, 'AES-256-CBC', $key, 0, $kode);
}

function generatekriptor()
{
    $randomBytes = random_bytes(16);
    $randnum = rand(100, 9999);
    return [
        'randomBytes' => $randomBytes,
        'randnum' => $randnum,
        'kriptorone' => convertToOpensll($randnum, $randomBytes),
        'kriptortwo' => bin2hex($randomBytes),
    ];
}

function enkripsina($data, $randnum, $randomBytes)
{
    $DataToAscii = convertToAscii($data, str_split($randnum));
    return convertToOpensll($DataToAscii, $randomBytes);
}

function dekripsina($data, $kriptorone, $kriptortwo)
{
    $kriptortwo = hex2bin($kriptortwo);
    $kriptorone = str_split(convertFromOpensll($kriptorone, $kriptortwo));
    $fromOpenssl = convertFromOpensll($data, $kriptortwo);
    $fromAscii = convertFromAscii($fromOpenssl, $kriptorone);
    return $fromAscii;
}
