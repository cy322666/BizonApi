<?php


namespace cy322666\BizonApi\Collections;

use cy322666\Base\Curl as Curl;
//use cy322666\BizonApi\Bizon;

class Webinars
{
    private $webinars = [];//list
    private $webinarsCount;

    public function getWebinars($skip, $limit) {
        $webinars = Curl::request("/webinars/reports/getlist?skip=$skip&limit=$limit", '');
        if(isset($webinars['list'])) {
            $this->setWebinarsCount($webinars['count']);
            if($this->webinarsCount > $limit) {
                for ($i = 0, $response = []; $i < $webinars['count'] % $limit; $i++, $skip =+ $limit) {
                    $webinars = Curl::request("/webinars/reports/getlist?skip=$skip&limit=$limit", '');
                    $webinars = array_merge($response, $webinars);
                }
            }
            $this->webinars = $webinars['list'];
        }
    }

    public function getNewWebinars($lastWebinar, $countWebinar) {
        $countNewWebinars = $countWebinar - $lastWebinar;
        if($countNewWebinars > 0) {
            for ($i = 0; $i < $countNewWebinars; $i++) {
                $NewVebinars[] = $this->webinars[$i];
            }
            return $NewVebinars;
        } else {
            return false;
        }
    }

    public function getCountWebinars() {
        return $this->webinarsCount;
    }

    private function setWebinarsCount($count) {
        $this->webinarsCount = $count;
    }

    public function setNumberWebinar($fileName) {
        file_put_contents($fileName, $this->webinarsCount);
    }

    public function getNumberWebinars($fileName) {
        return intval(file_get_contents($fileName));
    }




}