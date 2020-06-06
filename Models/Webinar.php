<?php


namespace cy322666\BizonApi\Models;

use cy322666\Base\Curl as Curl;
use cy322666\BizonApi\Collections\Viewers;

class Webinar
{

    private $attributes = [
        '_id' => '',
        'name' => '',
        'text' => '',
        'count1' => '',//участники
        'count2' => '',//продолжительность веба
        'created' => '',
        'webinarId' => '',
        'type' => ''
    ];

    public function __construct()
    {
        $this->viewers = new Viewers();
    }

    public function getViewers($webinarId, $skip, $limit) {
        $viewers = Curl::request("/webinars/reports/getviewers?webinarId=$webinarId&skip=$skip&limit=$limit", '');
        if(isset($viewers['viewers'])) {
            if($this->attributes['count1'] > $limit) {
                for ($i = 0, $response = []; $i < $this->attributes['count1'] % $limit; $i++, $skip =+ $limit) {
                    $viewers = Curl::request("/webinars/reports/getviewers?webinarId=$webinarId&skip=$skip&limit=$limit", '');
                    $viewers = array_merge($response, $viewers);
                }
            }
            $this->viewers->setList($viewers['viewers']);
        }
    }

    /**
     * @return string[]
     */
    public function getType(): array
    {
        return $this->attributes['type'];
    }

    /**
     * @param string[] $attributes
     */
    public function setType($type): void
    {
        $this->attributes['type'] = $type;
    }
//    private $name;
//    private $text;
//    private $count1;//viewers
//    private $count2;//minutes
//    private $id;
//    private $created;

    /**
     * @param mixed $text
     */
    public function setWebinarId($webinarId): void
    {
        $this->attributes['webinarId'] = $webinarId;
    }

    public function getWebinarId()
    {
        return $this->attributes['webinarId'];
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->attributes['text'];
    }

    /**
     * @param mixed $text
     */
    public function setText($text): void
    {
        $this->attributes['text'] = $text;
    }

    /**
     * @return mixed
     */
    public function getCount1()
    {
        return $this->attributes['count1'];
    }

    /**
     * @param mixed $count1
     */
    public function setCount1($count1): void
    {
        $this->attributes['count1'] = $count1;
    }

    /**
     * @return mixed
     */
    public function getCount2()
    {
        return $this->attributes['count2'];
    }

    /**
     * @param mixed $count2
     */
    public function setCount2($count2): void
    {
        $this->attributes['count2'] = $count2;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->attributes['_id'];
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->attributes['_id'] = $id;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->attributes['created'];
    }

    /**
     * @param mixed $created
     */
    public function setCreated($created): void
    {
        $this->attributes['created'] = $created;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->attributes['name'];
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->attributes['name'] = $name;
    }


}