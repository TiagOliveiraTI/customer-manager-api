<?php

namespace Tests\Feature\App\Http\Controllers;

use Laravel\Lumen\Testing\DatabaseTransactions;

class ListCustomerByDocumentTest extends \Tests\TestCase
{
    use DatabaseTransactions;

    public function testShouldReturn422IfADocumentNotExists()
    {
        $data1 = [
            'first_name' => 'valid_first_name',
            'last_name' => 'valid_last_name',
            'document' => '01234567890',
            'birth_date' => '1988-01-31',
            'phone_number' => '11998765432'
        ];

        $expected = '{"document": ["Customer with document 12345678901 not found."]}';

        $this->post('/customers', $data1);

        $this->get('/customers/12345678901')
            ->assertResponseStatus(404);

        $this->assertJsonStringEqualsJsonString(
            $expected,
            $this->response->getContent()
        );
    }

    public function testShouldReturn200IfADocumentExists()
    {
        $data = [
            'first_name' => 'valid_first_name',
            'last_name' => 'valid_last_name',
            'document' => '01234567890',
            'birth_date' => '1988-01-31',
            'phone_number' => '11998765432'
        ];

        $this->post('/customers', $data);

        $this->get('/customers/01234567890')
            ->assertResponseStatus(200);

        $this->seeInDatabase(
            'customers',
            $data
        );
    }
}
