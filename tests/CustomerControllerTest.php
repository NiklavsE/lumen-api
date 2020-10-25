<?php

use Illuminate\Database\Eloquent\Factories\Sequence;
use Laravel\Lumen\Testing\DatabaseMigrations;

class CustomerControllerTest extends TestCase
{
    use DatabaseMigrations;

    const INDEX_URI = 'api/v1/customers';

     /**
     * /products [GET]
     */
    public function testShouldReturnCorrectCustomerStructure()
    {
        $this->get(self::INDEX_URI, []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            'data' => ['*' =>
                [
                    'first_name',
                    'last_name',
                    'email',
                    'address',
                    'city',
                    'salutation',
                    'social_security_num',
                    'account_balance',
                ]
            ]
        ]);
    }

    public function testShouldReturnNullOnEmptyStringDataIfNotDefinedOtherWise()
    {
        $customers = App\Customer::factory()->create([
            'name' => '',
            'surname' => '',
            'address' => '',
            'city' => '',
            'soc_security_num' => ''
        ]);

        $this->get(self::INDEX_URI, [])
             ->seeJson([
                 'first_name' => null,
                 'last_name' => null,
                 'address' => null,
                 'city' => null,
                 'social_security_num' => null
            ]);
    }

    public function testShouldReturnOnlyValidEmail()
    {
        $customers = App\Customer::factory()->create([
            'email' => 'invalid_email',
        ]);

        $this->get(self::INDEX_URI, [])
        ->seeJson([
            'email' => null,
       ]);
    }

    public function testShouldReturnSmallestCommonCurrencyUnit()
    {
        $customers = App\Customer::factory()->create([
            'balance' => '1.59',
        ]);

        $this->get(self::INDEX_URI, [])
        ->seeJson([
            'account_balance' => 159,
       ]);
    }

    public function testShouldReturnMrSalutation()
    {
        $customers = App\Customer::factory()->create([
            'gender' => 'male',
        ]);


        $this->get(self::INDEX_URI, [])
        ->seeJson([
            'salutation' => 'mr',
        ]);
    }

    public function testShouldReturnMsSalutation()
    {
        $customers = App\Customer::factory()->create([
            'gender' => 'female',
        ]);
 
        $this->get(self::INDEX_URI, [])
        ->seeJson([
            'salutation' => 'ms',
        ]);
    }

    public function testShouldReturnNullSalutation()
    {
        $customers = App\Customer::factory()->create([
            'gender' => 'random text',
        ]);
 
        $this->get(self::INDEX_URI, [])
        ->seeJson([
            'salutation' => null,
        ]);
    }

    public function testShouldReturn10ItemsPerPage()
    {
        $customers = App\Customer::factory()->count(20)->create();
 
        $this->get(self::INDEX_URI, [])
        ->seeJson([
            'per_page' => 10,
            'total' => 20,
            'total_pages' => 2,
        ]);
    }
}