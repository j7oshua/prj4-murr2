<?php

namespace App\Validator;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;


class PhoneAndEmailBothLeftBlankValidator extends ConstraintValidator
{
    public function validate($entity, Constraint $constraint) : void
    {
        if (null === $entity || '' === $entity) {
            return;
        }

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
