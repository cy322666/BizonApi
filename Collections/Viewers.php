<?php


namespace cy322666\BizonApi\Collections;


class Viewers
{
    private $list = [];

    /**
     * @param array $list
     */
    public function setList(array $list)
    {
        $this->list = $list;
    }

    public function getList()
    {
        return $this->list;
    }


}