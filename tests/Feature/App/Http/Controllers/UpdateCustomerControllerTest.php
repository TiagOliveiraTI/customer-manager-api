<?php

namespace Tests\Feature\App\Http\Controllers;

use Laravel\Lumen\Testing\DatabaseTransactions;

class UpdateCustomerControllerTest extends \Tests\TestCase
{
    use DatabaseTransactions;

    public function testShouldReturn200IfADocumentExists()
    {
        $data = [
            'first_name' => 'valid_first_name',
            'last_name' => 'valid_last_name',
            'document' => '01234567890',
            'birth_date' => '1988-01-31',
            'phone_number' => '11998765432'
        ];

        $createdCustomer = $this->post('/customers', $data);

        $newData = [
            'first_name' => 'new_first_name',
            'last_name' => 'new_last_name',
            'document' => '01234567890',
            'birth_date' => '1988-01-31',
            'phone_number' => '11998765432'
        ];

        $createdUuid = json_decode($this->response->getContent())->uuid;

        $this->put("/customers/{$createdUuid}", $newData)
            ->assertResponseStatus(200);

        $this->seeInDatabase(
            'customers',
            $newData
        );
    }
}
