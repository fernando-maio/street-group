<?php

namespace App\Components;

/**
 * People Class
 */
class People
{  
    /**
     * @var MountArrayPerson
     */
    private $arrayPerson;

    /**
     * @var string
     */
    private $owner = 'homeowner';

    /**
     * @var array
     */
    private $titles = array(
        "Dr",
        "Mr",
        "Ms",
        "Mrs",
        "Miss",
        "Prof",
        "Mister"
    );
    
    /**
     * __construct
     */
    public function __construct()
    {
        $this->arrayPerson = new MountArrayPerson();
    }
    
    /**
     * splitClients
     *
     * @param  resource $handle
     * 
     * @return array
     */
    public function splitClients($handle)
    {
        $clients = array();
        while(($data = fgetcsv($handle, 0, ",")) !== FALSE) {
            $splitClients = preg_split( "/ (&|and) /", $data[0]);
            if($data[0] != $this->owner){
                $clients[] = $splitClients;
            }
        }

        return $clients;
    }
    
    /**
     * getPeopleData
     *
     * @param  array $clients
     * 
     * @return array
     */
    public function getPeopleData($clients)
    {
        $person = array();
        $people = array();
        $errorLines = array();

        foreach ($clients as $names) {
            if(count($names) == 1){
                // Single person on string
                $person = $this->getDataLineSinglePerson($names);
                if(!$person){
                    $errorLines[] = $names[0];
                    continue;
                }

                $people[] = $person;
            }
            else {
                //Two people on string
                $person = $this->getDataLineTwoPeople($names);
                if(!$person){
                    $errorLines[] = $names[0] . ' and ' . $names[1];
                    continue;
                }

                $people[] = $person['first'];
                $people[] = $person['second'];
            }
        }

        return array(
            'people' => $people, 
            'errors' => $errorLines, 
        );
    }
    
    /**
     * getDataLineSinglePerson
     *
     * @param  array $name
     * 
     * @return array|false
     */
    private function getDataLineSinglePerson($name)
    {
        $splitName = explode(' ', $name[0]);              
        
        // Check if array contain at least 2 required values (Title, Last Name).
        if(count($splitName) == 1){
            $errorLines[] = $name[0];
            return false;
        }

        // Check if titles are valid ($this->titles).
        if(!in_array($splitName[0], $this->titles)){
            $errorLines[] = $name[0];
            return false;
        }

        $person = $this->arrayPerson->singlePersonArray($splitName);

        return $person;        
    }
    
    /**
     * getDataLineTwoPeople
     *
     * @param  array $name
     * 
     * @return array|false
     */
    private function getDataLineTwoPeople($name)
    {
        $firstSplit = explode(' ', $name[0]);
        $secondSplit = explode(' ', $name[1]);

        // Check if array contain at least 2 required values (Title, Last Name).
        if(count($firstSplit) == 1 && count($secondSplit) == 1){
            return false;
        }

        // Check if titles are valid ($this->titles).
        if(!in_array($firstSplit[0], $this->titles) || !in_array($secondSplit[0], $this->titles)){
            return false;
        }

        $person = $this->arrayPerson->twoPeopleArray($firstSplit, $secondSplit);
        
        return array(
            'first' => $person['first'],
            'second' => $person['second']
        );
    }

}