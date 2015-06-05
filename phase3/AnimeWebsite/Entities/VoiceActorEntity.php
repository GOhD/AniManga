<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VoiceActorEntity
 *
 * @author yozubear
 */
class VoiceActorEntity {
    //put your code here
    public $birthday;
    public $gender;
    public $biography;
    public $vname;
    
    function __construct($birthday,$gender,$biography,$vname){
        $this->birthday = $birthday;
        $this->gender = $gender;
        $this->biography = $biography;
        $this->vname = $vname;
    }
}
