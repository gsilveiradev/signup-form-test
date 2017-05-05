<?php

namespace SignupFormTest\Helpers\Validation\Rules;

use Symfony\Component\HttpFoundation\Request;
use SignupFormTest\Helpers\Validation\Validation;

class Required implements Validation
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
        if (!$request->request->get($field)) {
            $this->setError('O campo '.$field.' é obrigatório!');
            
            return false;
        }

        return true;
    }
}
