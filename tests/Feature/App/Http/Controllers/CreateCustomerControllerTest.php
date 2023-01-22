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

}