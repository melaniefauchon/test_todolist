<?php

namespace App\Models;

class CoreModel {
    /**
     * @var int
     */
    protected $id;
    /**
     * @var string
     */

     /**
     * Get the value of id
     *
     * @return  int
     */ 
    public function getId() : int
    {
        return $this->id;
    }

}
