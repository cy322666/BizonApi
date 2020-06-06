<?php
namespace cy322666\BizonApi;

use cy322666\BizonApi\Collections\Webinars;
use cy322666\amoCRM\Models\Webinar;
use cy322666\Base\Curl as Curl;

class Bizon
{
    private $pathCookie;
    public $auth = false;
    public $webinars;
    public $webinar;

    function __construct() {
        $this->client = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/525.13 (KHTML, like Gecko) Chrome/0.A.B.C Safari/525.13';
        //$this->pathCookie = __DIR__;

        $this->webinars = new Webinars;
        //$this->webinar = new Webinar;
    }



    //Авторизует, получает куки
    public function auth($access) {
        $Response = Curl::request("/auth/login", [
            'username' => $access['username'],
            'password' => $access['password']
        ]);
        if($Response != false) {
            $this->auth = true;
        }
    }



    public function createTextNote($viewer) {
        $vebinarInfo = explode(',', $this->vebinarName);
        $this->note = [
            "Информация о вебинаре",
            '----------------------',
            ' - Название : '.$vebinarInfo[0],
            ' - '.ucfirst(trim($vebinarInfo[1])),
            ' - '.ucfirst(trim($vebinarInfo[2])),
            ' - '.ucfirst(trim($vebinarInfo[3])),
            ' - Тип вебинара :'.$vebinarInfo[4],
            ' - ID комнаты : '.$viewer['roomid'],
            " ",
            "Информация о зрителе",
            '----------------------',
            ' - Ник : '.$viewer['username'],
            ' - Телефон : '.$viewer['phone'],
            ' - Почта : '.$viewer['email'],
            ' - Город : '.$viewer['city'],
            ' - ID партнера : '.$viewer['partner'],
            ' - Откуда пришел : '.$viewer['referer'],
            ' - Когда зашел : '.date("Y-m-d H:i:s", ($viewer['view'] / 1000)),
            ' - Когда вышел : '.date("Y-m-d H:i:s", ($viewer['viewTill'] / 1000)),
            ' - Присутствовал до конца : '.$viewer['finished'],
            ' - Кликал по банеру : '.$viewer['clickBanner'],
            ' - Кликал по кнопке : '.$viewer['clickFile'],
            ' - Открывал форму заказа : '.$viewer['vizitForm'],
            " ",
            "Информация о заказе",
            '----------------------',
            ' - ID заказа : '.$viewer['newOrder'],
            ' - Описание заказа : '.$viewer['orderDetails'],
            " ",
            "UTM метки",
            '----------------------',
            ' = utm_source : '.$viewer['utm_source'],
            ' = utm_medium : '.$viewer['utm_medium'],
            ' = utm_campaign : '.$viewer['utm_campaign'],
            ' = utm_term : '.$viewer['utm_term'],
            ' = utm_content : '.$viewer['utm_content']
        ];
        $this->note = implode("\n", $this->note);
    }

    public function getTag($start, $finish) {
        $time = $finish - $start;
        $time = round($time / 60);

        if($time < 30) {
            return 'Холодный';
        } elseif ($time < 50 AND $time > 30 ) {
            return 'Теплый';
        } else {
            return 'Горячий';
        }
    }
}

/*
 * {
"skip":0,
"limit":20,
"rooms":{
},
"count":1,
"list":[
{
"_id":"5e93361d03a59180b5fec046",
"name":"49139:test_room",
"text":"Вебинар [BizonStream] 49139/49139:test_room, начало: 12.04.2020 18:38, длительность: 0 минут, участников: 2, использовались Бизон.Трансляции",
"type":"LiveWebinars",
"nerrors":0,
"count1":2,
"count2":0,
"data":"{"minutes":0,"roomid":"49139:test_room","group":"49139","start":1586705935263,"stat":2}",
"webinarId":"49139:test_room*2020-04-12T18:38:55",
"mode":"bs",
"created":"2020-04-12T15:39:09.218Z"
}
]
}
 */

/*
 * ОТЧЕТ ПО ВЕБИНАРУ
 *
 * {
"orders":{
},
"report":{
"_id":"5e93360fa266c18723d1eb4a",
"group":"49139",
"roomid":"49139:test_room",
"webinarId":"49139:test_room*2020-04-12T18:38:55",



"report":""rJ-TH2x_I":{
"_id":"5e9335bfa266c18723d1e93c",
"playVideo":0,
"username":"Victor",
"url":"https://online.bizon365.ru/room/49139/test_room",
"ip":"37.146.60.78",
"useragent":"Linux, Firefox 74.0",
"referer":"",
"cu1":"",
"p1":"",
"p2":"",
"p3":"",
"roomid":"49139:test_room",
"chatUserId":"rJ-TH2x_I",
"city":"Краснодар",
"country":"RU",
"region":"Краснодарский край",
"tz":"",
"created":"2020-04-12T15:37:35.676Z",
"__v":0,
"view":1586705917850,
"viewTill":1586705917850,
"webinarId":"49139:test_room*2020-04-12T18:38:55",
"messages_num":0,
"finished":true
}


"messages":"{"By3RFiguI":[],"rJ-TH2x_I":[]}",
"messagesTS":"{"By3RFiguI":[],"rJ-TH2x_I":[]}",
"ver":2,
"created":"2020-04-12T15:38:55.400Z",
"__v":0
},
"room_title":"test_room"
}
 */

/*
 * USER в отчете
 *
 *     [BkaTsne_L] => Array
(
    [_id] => 5e933befa266c18723d2656c
    [playVideo] => 0
    [email] => test@mail.ru
    [phone] => +79996272955
    [username] => IVAN
    [url] => https://online.bizon365.ru/room/49139/1231425443
    [ip] => 37.146.60.78
    [useragent] => Linux, Firefox 74.0
    [referer] =>
    [cu1] =>
    [p1] =>
    [p2] =>
    [p3] =>
    [roomid] => 49139:1231425443
    [chatUserId] => BkaTsne_L
    [city] => Краснодар
    [country] => RU
    [region] => Краснодарский край
    [tz] =>
    [created] => 2020-04-12T16:03:59.615Z
    [__v] => 0
    [webinarId] => 49139:1231425443*2020-04-12T18:58:45
    [view] => 1586707396326
    [viewTill] => 1586707396326
    [messages_num] => 0
    [
 */


