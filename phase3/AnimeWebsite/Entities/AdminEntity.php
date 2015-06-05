<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Admin
 *
 * @author yozubear
 */
class AdminEntity {
    //put your code here
    public $admin_name;
    public $password;
    
    function _construct($admin_name,$password){
        $this->admin_name = $admin_name;
        $this->password = $password;
    }
    
}
