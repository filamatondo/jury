<?php


namespace App\Search;

class SearchUser
{
    protected $filtrerParNom;

    protected $filtrerParPrenom;

    public function getFiltrerParNom()
    {
        return $this->filtrerParNom;
    }

    public function getFiltrerParPrenom()
    {
        return $this->filtrerParPrenom;
    }



    public function setFiltrerParNom($filtrerParNom)
    {
        $this->filtrerParNom = $filtrerParNom;
        return $this;
    }

    public function setFiltrerParPrenom($filtrerParPrenom)
    {
        $this->filtrerParPrenom = $filtrerParPrenom;
        return $this;
    }
}
