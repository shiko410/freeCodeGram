<?php
namespace App\Http\Validators;

use Illuminate\Validation\Validator;

class HelloValidator extends Validator
{

    /**
     * @param $attribute
     * @param $value
     * @param $parameters
     * @return int
     */
    public function validateHello($attribute, $value, $parameters)
    {
        return $value % 2 == 0;
    }
}
