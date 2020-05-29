<?php

namespace App\Components;

/**
 * MountArrayPerson Class
 */
class MountArrayPerson
{
    /**
     * singlePersonArray - Mount array data from CSV line with 1 person.
     *
     * @param  array $splitName
     * 
     * @return array
     */
    public function singlePersonArray($splitName)
    {
        $person = array();
        $person['title'] = $splitName[0]; 

        // Check if exists a name. If not, set null.
        $person['first_name'] = (count($splitName) > 2 
            && $splitName[1] != substr($splitName[1], 0, 1) . '.'
            && strlen($splitName[1]) > 1) 
                ? $splitName[1] 
                : null;

        // Check if exists a initial name. If not, set null.
        $person['initial'] = (count($splitName) > 2 
            && ($splitName[1] == substr($splitName[1], 0, 1) . '.'
            || strlen($splitName[1]) == 1)) 
                ? substr($splitName[1], 0, 1) 
                : null; 

        $person['last_name'] = end($splitName);

        return $person;
    }
    
    /**
     * twoPeopleArray - Mount array data from CSV line with 2 people.
     *
     * @param  array $firstSplit
     * @param  array $secondSplit
     * 
     * @return array
     */
    public function twoPeopleArray($firstSplit, $secondSplit)
    {
        $firstPerson['title'] = $firstSplit[0];
        $secondPerson['title'] = $secondSplit[0];

        // Check if exists a name to first person. 
        // If not, check in the second. And the last case, set null.
        if(count($firstSplit) > 2 
            && $firstSplit[1] != substr($firstSplit[1], 0, 1) . '.'
            && strlen($firstSplit[1]) > 1){
                $firstPerson['first_name'] = $firstSplit[1];
        }
        elseif(count($firstSplit) == 1 
            && count($secondSplit) > 2
            && $secondSplit[1] != substr($secondSplit[1], 0, 1) . '.'
            && strlen($secondSplit[1]) > 1){
                $firstPerson['first_name'] = $secondSplit[1];
        }
        else{
            $firstPerson['first_name'] = null;
        }

        // Check if exists a name to second person. If not, set null.
        if(count($firstSplit) > 2 
            && count($secondSplit) > 2 
            && $firstSplit[1] != substr($firstSplit[1], 0, 1) . '.'
            && strlen($firstSplit[1]) > 1){
                $secondPerson['first_name'] = $secondSplit[1];
        }
        else{
            $secondPerson['first_name'] = null;
        }

        // Check if exists a initial name to first person. 
        // If not, check in the second. And the last case, set null.
        if(count($firstSplit) > 2 
            && ($firstSplit[1] == substr($firstSplit[1], 0, 1) . '.'
                || strlen($firstSplit[1]) == 1)){
                    $firstPerson['initial'] = substr($firstSplit[1], 0, 1);
        }
        elseif(count($firstSplit) == 1 
            && count($secondSplit) > 2
            && ($secondSplit[1] == substr($secondSplit[1], 0, 1) . '.'
                || strlen($secondSplit[1]) == 1)){
                    $firstPerson['initial'] = substr($secondSplit[1], 0, 1);
        }
        else{
            $firstPerson['initial'] = null;
        }

        // Check if exists a initial name to second person. If not, set null.
        if(count($firstSplit) > 2 
            && count($secondSplit) > 2 
            && ($secondSplit[1] == substr($secondSplit[1], 0, 1) . '.'
                || strlen($secondSplit[1]) == 1)){
                    $secondPerson['initial'] = substr($secondSplit[1], 0, 1);
        }
        else{
            $secondPerson['initial'] = null;
        }

        // Set Last Name to first person
        if(count($firstSplit) > 2){
            $firstPerson['last_name'] = end($firstSplit);
        }
        else{
            $firstPerson['last_name'] = end($secondSplit);
        }

        $secondPerson['last_name'] = end($secondSplit); 

        return array(
            'first' => $firstPerson,
            'second' => $secondPerson
        );
    }
}