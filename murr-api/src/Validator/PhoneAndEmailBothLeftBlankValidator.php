<?php

namespace App\Validator;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;


class PhoneAndEmailBothLeftBlankValidator extends ConstraintValidator
{
    public function validate($entity, Constraint $constraint) : void
    {
        /*THIS STILL NEEDS TO BE WORKED ON. THIS IS JUST DEFAULT CODE*/
       // /* @var $constraint \App\Validator\PhoneAndEmailBothLeftBlankValidator */

        if (null === $entity || '' === $entity) {
            return;
        }


        // TODO: implement the validation here
        if ($entity->getEmail() == "" && $entity->getPhone() == "" || is_null($entity->getPhone()) && is_null($entity->getEmail())) {
            $this->context->buildViolation($constraint->message)
                ->atPath('email')
                ->addViolation();
        }

        if ($entity->getEmail() == "" && $entity->getPhone() == "" || is_null($entity->getPhone()) && is_null($entity->getEmail())) {
            $this->context->buildViolation($constraint->message)
                ->atPath('phone')
                ->addViolation();
        }

    }
}
