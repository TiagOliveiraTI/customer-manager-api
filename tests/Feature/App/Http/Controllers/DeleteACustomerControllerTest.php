<?php

use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\TestCase;

class DeleteACustomerControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testStoreCustomerShouldCreateACustomer()
    {
        $data = [
            'first_name' => 'valid_first_name',
            'last_name' => 'valid_last_name',
            'document' => '01234567890',
            'birth_date' => '1988-01-31',
            'phone_number' => '11998765432'
        ];

        $expected = '{"last_name":["The last name field is required."]}';

        $this->post('/customers', $data)->seeInDatabase('customers', $data);

        $createdUuid = json_decode($this->response->getContent())->uuid;

        $this->delete("/customers/{$createdUuid}")
            ->notSeeInDatabase('customers', $data);
    }
}