<?php

use Tests\TestCase;

class CreateCustomerControllerTest extends TestCase
{
    public function testStoreCustomerShouldThrowErrorIfFirstNameIsMissing()
    {
        $expected = '{"first_name":["The first name field is required."]}';

        $this->post('/customers')
            ->assertResponseStatus(422);

        $this->assertJsonStringEqualsJsonString(
            $expected,
            $this->response->getContent()
        );
    }

}