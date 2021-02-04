<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * Class Name
 * @package App\Validator
 * @Annotation
 */
class PhoneAndEmailBothLeftBlank extends Constraint
{
    /*
     * Any public properties become valid options for the annotation.
     * Then, use these in your validator class.
     */
    public $message = 'Phone and Email cannot be both left blank. Only one is required.';

    public function getTargets()
    {
        return array(self::CLASS_CONSTRAINT);
    }
}
