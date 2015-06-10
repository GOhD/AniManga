<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AnimeModel
 *
 * @author weininghu
 */

require ("Entities/AnimeEntity.php");
class AnimeModel {
    //put your code here
    //Get all anime genres from the database and return them in an array.
    function GetAnimeGenres() {
        require 'Credentials.php';

        //Open connection and Select database.   
        mysql_connect($host, $user, $passwd) or die(mysql_error());
        mysql_select_db($database);
        $result = mysql_query("SELECT DISTINCT genre FROM anime") or die(mysql_error());
        $genres = array();

        //Get data from database.
        while ($row = mysql_fetch_array($result)) {
            array_push($genres, $row[0]);
        }

        //Close connection and return result.
        mysql_close();
        return $genres;
    }
    
    
    function GetAnimeTitles() {
        require 'Credentials.php';

        //Open connection and Select database.   
        mysql_connect($host, $user, $passwd) or die(mysql_error());
        mysql_select_db($database);
        $result = mysql_query("SELECT DISTINCT title FROM anime") or die(mysql_error());
        $titles = array();

        //Get data from database.
        while ($row = mysql_fetch_array($result)) {
            array_push($titles, $row[0]);
        }

        //Close connection and return result.
        mysql_close();
        return $titles;
    }

    //Get animeEntity objects from the database and return them in an array.
    function GetAnimeByGenre($genre) {
        require 'Credentials.php';

        //Open connection and Select database.     
        mysql_connect($host, $user, $passwd) or die(mysql_error);
        mysql_select_db($database);

        $query = "SELECT * FROM anime WHERE genre LIKE '$genre'";
        $result = mysql_query($query) or die(mysql_error());
        $animeArray = array();

        //Get data from database.
        while ($row = mysql_fetch_array($result)) {
            $title = $row[1];
            $genre = $row[2];
            $rating = $row[3];
            $descripstion = $row[4];
            $season = $row[5];
            $status = $row[6];
            $start_date = $row[7];
            $studio = $row[8];
            $num_of_episode = $row[9];

            //Create anime objects and store them in an array.
            $anime = new AnimeEntity($title,$genre,$rating,$descripstion,$season,$status,$start_date,$studio,$num_of_episode);
            array_push($animeArray, $anime);
        }
        //Close connection and return result
        mysql_close();
        return $animeArray;
    }
    
    
    
    //Get animeEntity objects from the database according to keyword and return them in an array.
    function GetAnimeByKeyword($keyword) {
        require 'Credentials.php';

        //Open connection and Select database.     
        mysql_connect($host, $user, $passwd) or die(mysql_error);
        mysql_select_db($database);

        $query = "SELECT * FROM anime WHERE title LIKE '$keyword'";
        $result = mysql_query($query) or die(mysql_error());
        $animeArray = array();

        //Get data from database.
        while ($row = mysql_fetch_array($result)) {
            $title = $row[1];
            $genre = $row[2];
            $rating = $row[3];
            $descripstion = $row[4];
            $season = $row[5];
            $status = $row[6];
            $start_date = $row[7];
            $studio = $row[8];
            $num_of_episode = $row[9];

            //Create anime objects and store them in an array.
            $anime = new AnimeEntity($title,$genre,$rating,$descripstion,$season,$status,$start_date,$studio,$num_of_episode);
            array_push($animeArray, $anime);
        }
        //Close connection and return result
        mysql_close();
        return $animeArray;
    }
}
