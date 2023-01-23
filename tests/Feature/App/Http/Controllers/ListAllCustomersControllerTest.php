<?php

use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\TestCase;

class ListAllCustomersControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testListAllShouldReturnAnArray()
    {

        $this->get('/customers');

        $expected = '[]';

        $this->assertJsonStringEqualsJsonString(
            $expected,
            $this->response->getContent()
        );
    }
}
