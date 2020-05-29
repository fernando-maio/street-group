<?php

namespace Tests\Feature;

use App\Components\MountArrayPerson;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MountArraySinglePersonTest extends TestCase
{
    /**
     *
     * @return void
     */
    public function testSinglePersonWithoutNameAndInitial()
    {
        $name = array(
            0 => 'Mrs',
            2 => 'Cardon'
        );

        $expects = array(
            'title' => 'Mrs',
            'first_name' => null,
            'initial' => null,
            'last_name' => 'Cardon',
        );

        $arrayPerson = new MountArrayPerson();
        $singlePerson = $arrayPerson->singlePersonArray($name);

        $this->assertEquals($expects, $singlePerson);
    }

    /**
     *
     * @return void
     */
    public function testSinglePersonWithFirstName()
    {
        $name = array(
            0 => 'Mr',
            1 => 'Jhon',
            2 => 'Smith'
        );

        $expects = array(
            'title' => 'Mr',
            'first_name' => 'Jhon',
            'initial' => null,
            'last_name' => 'Smith',
        );

        $arrayPerson = new MountArrayPerson();
        $singlePerson = $arrayPerson->singlePersonArray($name);

        $this->assertEquals($expects, $singlePerson);
    }

    /**
     *
     * @return void
     */
    public function testSinglePersonWithInitialLetter()
    {
        $name = array(
            0 => 'Dr',
            1 => 'P.',
            2 => 'Vasquez'
        );

        $expects = array(
            'title' => 'Dr',
            'first_name' => null,
            'initial' => 'P',
            'last_name' => 'Vasquez',
        );

        $arrayPerson = new MountArrayPerson();
        $singlePerson = $arrayPerson->singlePersonArray($name);

        $this->assertEquals($expects, $singlePerson);
    }

    /**
     *
     * @return void
     */
    public function testSinglePersonWithBigName()
    {
        $name = array(
            0 => 'Dra',
            1 => 'Suzy',
            2 => 'Carmella',
            3 => 'Mendez',
            4 => 'Richards',
            5 => 'Scott'
        );

        $expects = array(
            'title' => 'Dra',
            'first_name' => 'Suzy',
            'initial' => null,
            'last_name' => 'Scott',
        );

        $arrayPerson = new MountArrayPerson();
        $singlePerson = $arrayPerson->singlePersonArray($name);

        $this->assertEquals($expects, $singlePerson);
    }
}
