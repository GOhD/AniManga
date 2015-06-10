<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AnimeController
 *
 * @author weininghu
 */

require ("Model/AnimeModel.php");
class AnimeController {
    //put your code here


//Contains non-database related function for the Coffee page
class AnimeController {

    function CreateAnimeDropdownList() {
        $animeModel = new AnimeModel();
        $result = "<form action = '' method = 'post' width = '200px'>
                    Please enter a genre: 
                    <select name = 'types' >
                        <option value = '%' >All</option>
                        " . $this->CreateOptionValues($coffeeModel->GetCoffeeTypes()) .
                "</select>
                     <input type = 'submit' value = 'Search' />
                    </form>";

        return $result;
    }

    function CreateOptionValues(array $valueArray) {
        $result = "";

        foreach ($valueArray as $value) {
            $result = $result . "<option value='$value'>$value</option>";
        }

        return $result;
    }
    
    function CreateCoffeeTables($types)
    {
        $coffeeModel = new AnimeModel();
        $coffeeArray = $coffeeModel->GetCoffeeByType($types);
        $result = "";
        
        //Generate a coffeeTable for each coffeeEntity in array
        foreach ($coffeeArray as $key => $coffee) 
        {
            $result = $result .
                    "<table class = 'coffeeTable'>
                        <tr>
                            <th rowspan='6' width = '150px' ><img runat = 'server' src = '$coffee->image' /></th>
                            <th width = '75px' >Name: </th>
                            <td>$coffee->name</td>
                        </tr>
                        
                        <tr>
                            <th>Type: </th>
                            <td>$coffee->type</td>
                        </tr>
                        
                        <tr>
                            <th>Price: </th>
                            <td>$coffee->price</td>
                        </tr>
                        
                        <tr>
                            <th>Roast: </th>
                            <td>$coffee->roast</td>
                        </tr>
                        
                        <tr>
                            <th>Origin: </th>
                            <td>$coffee->country</td>
                        </tr>
                        
                        <tr>
                            <td colspan='2' >$coffee->review</td>
                        </tr>                      
                     </table>";
        }        
        return $result;
        
    }

}
}
