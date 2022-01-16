<?php

namespace APP\MesServices;

class PanierItem
{
    public $id;

    public $qty;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
    public function getQty($id)
    {
        $this->id = $id;
        return $this;
    }
    public function setQty($id)
    {
        $this->id = $id;
        return $this;
    }
}
