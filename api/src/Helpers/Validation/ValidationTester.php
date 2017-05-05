<?php

namespace SignupFormTest\Helpers\Validation;

use Symfony\Component\HttpFoundation\Request;
use SignupFormTest\Helpers\Validation\Validation;

class ValidationTester
{
    private $validation;

    public function __construct(Validation $validation)
    {
        $this->validation = $validation;
    }

    public function getError()
    {
        return $this->validation->getError();
    }

    public function check(Request $request, $rule, $field)
    {
        return $this->validation->check($request, $rule, $field);
    }
}
