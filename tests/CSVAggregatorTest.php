<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\File;

class CSVAggregatorTest extends TestCase
{
    use DatabaseMigrations;

    /**
    * test if application imports customer_data1.csv file correctly in database
    */
    public function testShouldImportFirstTestDataCorrectly()
    {
        File::copy(storage_path() . '/customer_test_data/customer_data1.csv', storage_path() . '/customer_data/customer_data1.csv');

        $this->artisan('import:csv-data');

        File::delete(storage_path() . '/customer_data/customer_data1.csv');

        $this->seeInDatabase('customers', [
            'name' => 'John',
            'surname' => 'Doe',
            'email' => 'test+john@gmail.com',
            'address' => 'Street 123',
            'city' => '',
            'gender' => '',
            'soc_security_num' => '',
            'balance' => '0',
        ]);

        $this->seeInDatabase('customers', [
            'name' => 'Jane',
            'surname' => 'Doe',
            'email' => 'invalid_email',
            'address' => 'Street 999',
            'city' => '',
            'gender' => 'male',
            'soc_security_num' => '',
            'balance' => '100.00',
        ]);
    }

    /**
    * test if application imports customer_data2.csv file correctly in database
    */
    public function testShouldImportSecondTestDataCorrectly()
    {
        File::copy(storage_path() . '/customer_test_data/customer_data2.csv', storage_path() . '/customer_data/customer_data2.csv');

        $this->artisan('import:csv-data');

        File::delete(storage_path() . '/customer_data/customer_data2.csv');

        $this->seeInDatabase('customers', [
            'name' => '',
            'surname' => 'Doe',
            'email' => 'test+doe@gmail.com',
            'address' => '',
            'city' => 'London',
            'gender' => 'male',
            'soc_security_num' => '',
            'balance' => '500',
        ]);
    }

    /**
    * test if application imports customer_data3.csv file correctly in database
    */
    public function testShouldImportThirdTestDataCorrectly()
    {
        File::copy(storage_path() . '/customer_test_data/customer_data3.csv', storage_path() . '/customer_data/customer_data3.csv');

        $this->artisan('import:csv-data');

        File::delete(storage_path() . '/customer_data/customer_data3.csv');

        $this->seeInDatabase('customers', [
            'name' => 'Jane',
            'surname' => 'Doe',
            'email' => 'test+jane@gmail.com',
            'address' => '',
            'city' => '',
            'gender' => 'female',
            'soc_security_num' => '555-111-222-000',
            'balance' => '20.00',
        ]);
    }
}