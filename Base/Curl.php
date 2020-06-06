<?php


namespace cy322666\Base;


class Curl
{
    public static function request($url, $array) {
        $curl = curl_init(); #Сохраняем дескриптор сеанса cURL
        #Устанавливаем необходимые опции для сеанса cURL
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_URL, 'https://online.bizon365.ru/api/v1'.$url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

        if ($array != false) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($array));
            curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
        }
        var_dump(ROOT.'/Cookies/bizon.txt');
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_COOKIEFILE, ROOT.'/Cookies/bizon.txt');
        curl_setopt($curl, CURLOPT_COOKIEJAR, ROOT.'/Cookies/bizon.txt');

        $out = curl_exec($curl); #Инициируем запрос к API и сохраняем ответ в переменную
        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        curl_close($curl);

        if($code != 200 AND $code != 401) {//401 no auth
            return false;
        } else {
            $Response = json_decode($out, true);
            return $Response;
        }
    }
}