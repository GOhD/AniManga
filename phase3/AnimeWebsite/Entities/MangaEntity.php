<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MangaEntity
 *
 * @author weininghu
 */
class MangaEntity {
    //put your code here
    public $title;
    public $genre;
    public $rating;
    public $descripstion;
    public $author;
    public $volume;
    public $published_date;
    
    
    function __construct($title,$genre,$rating,$description,$author,$volume,$published_date){
        $this->title = $title;
        $this->genre = $genre;
        $this->rating = $rating;
        $this->description = $description;
        $this->author = $author;
        $this->volume = $volume;
        $this->published_date = $published_date;
        
    }
}
