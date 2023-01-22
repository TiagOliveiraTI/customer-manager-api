<?php

namespace Tests;

use Laravel\Lumen\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }

    protected function removeItemFromData(string $key): array
    {
        $data = [
            'first_name' => 'any_first_name',
            'last_name' => 'any_last_name',
            'document' => 'any_document',
            'bith_date' => 'any_bith_date',
            'phone_number' => 'any_phone_number'
        ];

        unset($data[$key]);

        return $data;
    }
}
