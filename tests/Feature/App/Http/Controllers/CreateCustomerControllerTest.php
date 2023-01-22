<?php

use Tests\TestCase;

class CreateCustomerControllerTest extends TestCase
{
    public function testStoreCustomerShouldThrowErrorIfFirstNameIsMissing()
    {
        $expected = '{"first_name":["The first name field is required."]}';

        $this->post('/customers', $this->removeItemFromData('first_name'))
            ->assertResponseStatus(422);

        $this->assertJsonStringEqualsJsonString(
            $expected,
            $this->response->getContent()
        );
    }

    public function testStoreCustomerShouldThrowErrorIfLastNameIsMissing()
    {
        $expected = '{"last_name":["The last name field is required."]}';

        $this->post('/customers', $this->removeItemFromData('last_name'))
            ->assertResponseStatus(422);

        $this->assertJsonStringEqualsJsonString(
            $expected,
            $this->response->getContent()
        );
    }

    public function testStoreCustomerShouldThrowErrorIfDocumentIsMissing()
    {
        $expected = '{"document":["The document field is required."]}';

        $this->post('/customers', $this->removeItemFromData('document'))
            ->assertResponseStatus(422);

        $this->assertJsonStringEqualsJsonString(
            $expected,
            $this->response->getContent()
        );
    }

    public function testStoreCustomerShouldThrowErrorIfDocumentIsNotNumber()
    {
        $data = [
            'first_name' => 'any_first_name',
            'last_name' => 'any_last_name',
            'document' => 'anyDocument',
            'birth_date' => 'any_birth_date',
            'phone_number' => 'any_phone_number'
        ];

        $expected = '{"document":["The document must be a number.", "The document must be 11 digits."]}';

        $this->post('/customers', $data)
            ->assertResponseStatus(422);

        $this->assertJsonStringEqualsJsonString(
            $expected,
            $this->response->getContent()
        );
    }

    public function testStoreCustomerShouldThrowErrorIfDocumentIsNot11digits()
    {
        $data = [
            'first_name' => 'any_first_name',
            'last_name' => 'any_last_name',
            'document' => '0123456789',
            'birth_date' => 'any_birth_date',
            'phone_number' => 'any_phone_number'
        ];

        $expected = '{"document":["The document must be 11 digits."]}';

        $this->post('/customers', $data)
            ->assertResponseStatus(422);

        $this->assertJsonStringEqualsJsonString(
            $expected,
            $this->response->getContent()
        );
    }

    public function testStoreCustomerShouldThrowErrorIfBithDateIsMissing()
    {
        $expected = '{"birth_date":["The birth date field is required."]}';

        $this->post('/customers', $this->removeItemFromData('birth_date'))
            ->assertResponseStatus(422);

        $this->assertJsonStringEqualsJsonString(
            $expected,
            $this->response->getContent()
        );
    }

}