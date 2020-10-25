<?php
namespace App\Transformers;

use App\Customer;
use League\Fractal;

class CustomerTransformer extends Fractal\TransformerAbstract
{
    /**
     * Set the return array structure
     *
     * @var array
     */
	public function transform(Customer $customer)
	{
	    return [
            'first_name' => !empty($customer->name) ? $customer->name : null,
            'last_name' => !empty($customer->surname) ? $customer->surname : null,
            'email' => $customer->verified_email,
            'address' => !empty($customer->address) ? $customer->address : null,
            'city' => !empty($customer->city) ? $customer->city : null,
            'salutation' => $customer->salutation,
            'social_security_num' => !empty($customer->soc_security_num) ? $customer->soc_security_num : null,
            'account_balance' => $customer->account_balance
        ];
	}
}