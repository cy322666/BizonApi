<?php


namespace cy322666\BizonApi\Models;


class Viewer
{
    private $attributes = [
        'phone' => '',
        'username' => '',
        'url' => '',
        'ip' => '',
        'useragent' => '',
        'referer' => '',
        'roomid' => '',
        'chatUserId' => '',
        'city' => '',
        'country' => '',
        'region' => '',
        'created' => '',
        'view' => '',
        'viewTill' => '',
        'webinarId' => '',
        'messages_num' => '',
        'finished' => ''
    ];

    /*
     * clickBanner — кликал ли по баннеру
clickFile — кликал ли по кнопке
vizitForm — открывал ли зритель форму оформления заказа
newOrder — номер оформленного заказа или ноль
orderDetails — название товара в оформленном заказе
utm_source, utm_medium, utm_campaign, utm_term, utm_content — стандартные utm-метки
uid — идентификатор подписчика (присутствует, если удалось сопоставить зрителя с подписчиком)
    partner
     */

    public function setPhone($phone) {
        $this->attributes['phone'] = $phone;
    }
    public function setUsername($username) {
        $this->attributes['username'] = $username;
    }
    public function setReferer($referer) {
        $this->attributes['referer'] = $referer;
    }
    public function setCity($city) {
        $this->attributes['city'] = $city;
    }
    public function setRegion($region) {
        $this->attributes['region'] = $region;
    }
    public function setCreated($created) {
        $this->attributes['created'] = $created;
    }
    public function setView($view) {
        //преобразование
        $this->attributes['phone'] = $view;
    }
    public function setViewTill($viewTill) {
        //преобразование
        $this->attributes['viewTill'] = $viewTill;
    }
    public function setMessagesNum($messagesNum) {
        $this->attributes['messages_num'] = $messagesNum;
    }
    public function setFinished($finished) {
        $this->attributes['finished'] = $finished;
    }

}