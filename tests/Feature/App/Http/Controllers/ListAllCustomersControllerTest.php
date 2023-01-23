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

    public function testListAllCustomers()
    {
        $data1 = [
            'first_name' => 'any_first_name',
            'last_name' => 'any_last_name',
            'document' => '01234567890',
            'birth_date' => '1988-01-31',
            'phone_number' => '11998765432'
        ];

        $this->post('/customers', $data1);

        $this->get('/customers');

        $this->seeInDatabase('customers', $data1);

    }
}
