<?php

define('ROOT', __DIR__);

require_once 'Collections/Webinars.php';
require_once 'Base/Curl.php';
require_once 'Core/Bizon.php';
require_once 'Models/Webinar.php';
require_once 'Models/Viewer.php';
require_once 'Collections/Viewers.php';

$bizon = new cy322666\BizonApi\Bizon();

$bizon->auth([
    'username' => '',
    'password' => ''
]);

if($bizon->auth) {
    $bizon->webinars->getWebinars(0, 100);

    $numberWebinar = $bizon->webinars->getNumberWebinars('number.txt');
    $countWebinars = $bizon->webinars->getCountWebinars();
    $newWebinars = $bizon->webinars->getNewWebinars($numberWebinar, $countWebinars);

    if($newWebinars != false) {
        foreach ($newWebinars as $newWebinar) {
            $webinar = new \cy322666\BizonApi\Models\Webinar();
            $webinar->setId($newWebinar['_id']);
            $webinar->setWebinarId($newWebinar['webinarId']);
            $webinar->setName($newWebinar['name']);
            $webinar->setText($newWebinar['text']);
            $webinar->setCount1($newWebinar['count1']);
            $webinar->setCount2($newWebinar['count2']);
            $webinar->setCreated($newWebinar['created']);
            $webinar->setType($newWebinar['type']);

            if($webinar->getCount1() > 0) {
                $webinar->getViewers($webinar->getWebinarId(), 0, 1000);
                $viewers = $webinar->viewers->getList();
                //var_dump($viewers);
                if($viewers) {
                    foreach ($viewers as $visitor) {
                        var_dump($visitor);
                        $viewer = new \cy322666\BizonApi\Models\Viewer();

                    }
                }
            } else {
                echo '0 посетителей';
            }
            var_dump($webinar);
            echo '=====';
            exit;
        }
    }

//    //$bizon->webinars->setNumberWebinars('number.txt');
    //var_dump($bizon);
}

