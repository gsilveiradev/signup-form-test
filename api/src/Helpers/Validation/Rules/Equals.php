<?php

namespace SignupFormTest\Helpers\Validation\Rules;

use Symfony\Component\HttpFoundation\Request;
use SignupFormTest\Helpers\Validation\Validation;

class Equals implements Validation
{
    protected $error;

    public function setError($error)
    {
        $this->error = $error;
    }

    public function getError()
    {
        return $this->error;
    }

    public function check(Request $request, $rule, $field)
    {
        list($ruleName, $value) = explode(':', $rule);

        if ($request->request->get($field) != $request->request->get($value)) {
            $this->setError('O campo '.$field.' deve ser igual ao campo '.$value.'!');

            return false;
        }

        return true;
    }
}
