<?php

namespace SignupFormTest\Helpers\Validation;

use Symfony\Component\HttpFoundation\Request;

interface Validation
{
    public function getError();
    public function check(Request $request, $rule, $field);
}
