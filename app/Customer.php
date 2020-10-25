<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'email', 'address', 'city', 'gender', 'soc_security_num', 'balance', 'created_at', 'updated_at'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $appends = ['salutation', 'account_balance', 'verified_email'];


    /**
     * Get the customer's salutation
     *
     * @return string|null
     */
    public function getSalutationAttribute()
    {
        $salutation = null;
        if (in_array($this->gender, array('male', 'female'))) {
            switch ($this->gender) {
                case 'female':
                    $salutation = 'ms';
                    break;
                case 'male':
                    $salutation = 'mr';
                    break;
            }
        }

        return $salutation;
    }

    /**
     * Get the customer's account balance in smallest unit
     *
     * @return int
     */
    public function getAccountBalanceAttribute()
    {
        $accountBalance = 0;

        if (!is_null($this->balance)) {
            $accountBalance = (float)$this->balance * 100;
        }

        return (int)$accountBalance;
    }

    /**
     * Get the customer's email address if its valid
     *
     * @return string|null
     */
    public function getVerifiedEmailAttribute()
    {
        $validEmail = null;

        if (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $validEmail = $this->email;
        }

        return $validEmail;
    }
}