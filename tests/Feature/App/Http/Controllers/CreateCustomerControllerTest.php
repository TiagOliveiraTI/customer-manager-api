<?php

use Tests\TestCase;

class CreateCustomerControllerTest extends TestCase
{
    public function testIfRouteExists()
    {
        $this->post('/customers');

        $this->assertResponseOk();
    }
}