<?php

namespace Tests\Feature;

use App\Components\MountArrayPerson;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MountArrayTwoPeopleTest extends TestCase
{
    /**
     *
     * @return void
     */
    public function testTwoPeopleCoupleLastNameOnlyOnSecondPerson()
    {
        $firstName = array(
            0 => 'Mr'
        );

        $secondName = array(
            0 => 'Mrs',
            1 => 'Scott',
        );

        $expects = array(
            'first' => array(
                'title' => 'Mr',
                'first_name' => null,
                'initial' => null,
                'last_name' => 'Scott',
            ),
            'second' => array(
                'title' => 'Mrs',
                'first_name' => null,
                'initial' => null,
                'last_name' => 'Scott',
            )
        );

        $arrayPerson = new MountArrayPerson();
        $twoPeople = $arrayPerson->twoPeopleArray($firstName, $secondName);

        $this->assertEquals($expects, $twoPeople);
    }

    /**
     *
     * @return void
     */
    public function testTwoPeopleCoupleFirstNameOnlyOnSecondPerson()
    {
        $firstName = array(
            0 => 'Mr'
        );

        $secondName = array(
            0 => 'Mrs',
            1 => 'Jhon',
            2 => 'Smith'
        );

        $expects = array(
            'first' => array(
                'title' => 'Mr',
                'first_name' => 'Jhon',
                'initial' => null,
                'last_name' => 'Smith',
            ),
            'second' => array(
                'title' => 'Mrs',
                'first_name' => null,
                'initial' => null,
                'last_name' => 'Smith',
            )
        );

        $arrayPerson = new MountArrayPerson();
        $twoPeople = $arrayPerson->twoPeopleArray($firstName, $secondName);

        $this->assertEquals($expects, $twoPeople);
    }

    /**
     *
     * @return void
     */
    public function testTwoPeopleCoupleInitialOnlyOnSecondPerson()
    {
        $firstName = array(
            0 => 'Dr'
        );

        $secondName = array(
            0 => 'Mrs',
            1 => 'B.',
            2 => 'Franklyn'
        );

        $expects = array(
            'first' => array(
                'title' => 'Dr',
                'first_name' => null,
                'initial' => 'B',
                'last_name' => 'Franklyn',
            ),
            'second' => array(
                'title' => 'Mrs',
                'first_name' => null,
                'initial' => null,
                'last_name' => 'Franklyn',
            )
        );

        $arrayPerson = new MountArrayPerson();
        $twoPeople = $arrayPerson->twoPeopleArray($firstName, $secondName);

        $this->assertEquals($expects, $twoPeople);
    }

    /**
     *
     * @return void
     */
    public function testTwoPeopleNotMarried()
    {
        $firstName = array(
            0 => 'Mr',
            1 => 'George',
            2 => 'Bush'
        );

        $secondName = array(
            0 => 'Mr',
            1 => 'Bill',
            2 => 'Clinton'
        );

        $expects = array(
            'first' => array(
                'title' => 'Mr',
                'first_name' => 'George',
                'initial' => null,
                'last_name' => 'Bush',
            ),
            'second' => array(
                'title' => 'Mr',
                'first_name' => 'Bill',
                'initial' => null,
                'last_name' => 'Clinton',
            )
        );

        $arrayPerson = new MountArrayPerson();
        $twoPeople = $arrayPerson->twoPeopleArray($firstName, $secondName);

        $this->assertEquals($expects, $twoPeople);
    }
}
