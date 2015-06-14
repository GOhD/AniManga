<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Character
 *
 * @author weininghu
 */
class CharacterEntity {
    //put your code here
    public $cname;
    public $description;
    public $rating;
    public $img;
    
    function __construct($cname,$description,$rating,$img){
        $this->cname = $cname;
        $this->description = $description;
        $this->rating = $rating;
        $this->img=$img;
    }
}
