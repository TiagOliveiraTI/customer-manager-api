<?php

use Tests\TestCase;
use Illuminate\Http\Response;
use Laravel\Lumen\Testing\DatabaseTransactions;

class CreateCustomerControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testStoreCustomerShouldThrowErrorIfFirstNameIsMissing()
    {
        $expected = '{"first_name":["The first name field is required."]}';

        $this->post('/customers', $this->removeItemFromData('first_name'))
            ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->assertJsonStringEqualsJsonString(
            $expected,
            $this->response->getContent()
        );
    }

    public function testStoreCustomerShouldThrowErrorIfLastNameIsMissing()
    {
        $expected = '{"last_name":["The last name field is required."]}';

        $this->post('/customers', $this->removeItemFromData('last_name'))
            ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->assertJsonStringEqualsJsonString(
            $expected,
            $this->response->getContent()
        );
    }

    public function testStoreCustomerShouldThrowErrorIfDocumentIsMissing()
    {
        $expected = '{"document":["The document field is required."]}';

        $this->post('/customers', $this->removeItemFromData('document'))
            ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

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
            'birth_date' => '1988-01-31',
            'phone_number' => 'any_phone_number'
        ];

        $expected = '{"document":["The document must be a number.", "The document must be 11 digits."]}';

        $this->post('/customers', $data)
            ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

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
            'birth_date' => '1988-01-31',
            'phone_number' => 'any_phone_number'
        ];

        $expected = '{"document":["The document must be 11 digits."]}';

        $this->post('/customers', $data)
            ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->assertJsonStringEqualsJsonString(
            $expected,
            $this->response->getContent()
        );
    }

    public function testStoreCustomerShouldThrowErrorIfBithDateIsMissing()
    {
        $expected = '{"birth_date":["The birth date field is required."]}';

        $this->post('/customers', $this->removeItemFromData('birth_date'))
            ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->assertJsonStringEqualsJsonString(
            $expected,
            $this->response->getContent()
        );
    }

    public function testStoreCustomerShouldThrowErrorIfBirthDateIsNotValidDate()
    {
        $data = [
            'first_name' => 'any_first_name',
            'last_name' => 'any_last_name',
            'document' => '01234567890',
            'birth_date' => 'any_birth_date',
            'phone_number' => 'any_phone_number'
        ];

        $expected = '{"birth_date":["The birth date is not a valid date."]}';

        $this->post('/customers', $data)
            ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->assertJsonStringEqualsJsonString(
            $expected,
            $this->response->getContent()
        );
    }

    public function testStoreCustomerShouldThrowErrorIfBirthDateIsAfterNow()
    {
        $data = [
            'first_name' => 'any_first_name',
            'last_name' => 'any_last_name',
            'document' => '01234567890',
            'birth_date' => '2050-01-01',
            'phone_number' => '11998765432'
        ];

        $expected = '{"birth_date":["The birth date is not a valid date."]}';

        $this->post('/customers', $data)
            ->assertResponseStatus(Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function testStoreCustomerShouldThrowErrorIfDocumentHasBeenCreated()
    {
        $data1 = [
            'first_name' => 'any_first_name',
            'last_name' => 'any_last_name',
            'document' => '01234567890',
            'birth_date' => '1988-01-31',
            'phone_number' => '11998765432'
        ];

        $this->post('/customers', $data1);

        $data2 = [
            'first_name' => 'any_first_name',
            'last_name' => 'any_last_name',
            'document' => '01234567890',
            'birth_date' => '1988-01-31',
            'phone_number' => '11998765432'
        ];

        $expected = '{"document":["The document has already been taken."]}';

        $this->post('/customers', $data2)
            ->assertResponseStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->assertJsonStringEqualsJsonString(
            $expected,
            $this->response->getContent()
        );
    }

    public function testStoreCustomerShouldCreateACustomer()
    {
        $data = [
            'first_name' => 'valid_first_name',
            'last_name' => 'valid_last_name',
            'document' => '01234567890',
            'birth_date' => '1988-01-31',
            'phone_number' => '11998765432'
        ];

        $response = $this->post('/customers', $data);
        
        $response->assertResponseStatus(Response::HTTP_CREATED);

        $this->assertArrayHasKey('uuid', json_decode($response->response->getContent(), true));
    }
}