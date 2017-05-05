<?php

namespace SignupFormTest\Helpers\Validation;

use Symfony\Component\HttpFoundation\Request;

class Validator
{
    /**
     * Validate params in Request
     * @param Request $request The Request instance
     * @param array $rules Fields and rules to validate
     * @return array
     */
    public static function validate(Request $request, $rules)
    {
        $errors = array();

        foreach ($rules as $field => $fieldRules) {
            foreach (explode('|', $fieldRules) as $rule) {
                switch (strtok($rule, ':')) {
                    case 'required':
                        $validator = new ValidationTester(new Rules\Required());

                        if (!$validator->check($request, $rule, $field)) {
                            $errors[$field] = array($validator->getError());
                        }
                        break;

                    case 'equals':
                        $validator = new ValidationTester(new Rules\Equals());

                        if (!$validator->check($request, $rule, $field)) {
                            $errors[$field] = array($validator->getError());
                        }
                        break;
                    
                    default:
                        break;
                }

                if (isset($errors[$field])) {
                    break;
                }
            }
        }

        return $errors;
    }
}
