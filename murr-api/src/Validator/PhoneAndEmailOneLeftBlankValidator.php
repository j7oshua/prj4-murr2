<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class PhoneAndEmailOneLeftBlankValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        /*THIS STILL NEEDS TO BE WORKED ON. THIS IS JUST DEFAULT CODE*/
        /* @var $constraint \App\Validator\PhoneAndEmailOneLeftBlank */

        if (null === $value || '' === $value) {
            return;
        }

        // TODO: implement the validation here
        $this->context->buildViolation($constraint->message)
            ->setParameter('{{ value }}', $value)
            ->addViolation();
    }
}
