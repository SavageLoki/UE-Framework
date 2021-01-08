<?php


namespace App\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class PasswordConstraint extends Constraint
{
    public $message = 'You must use one lowercase, one uppercase, one number and one special character';

    public function validatedBy()
    {
        return static::class . 'Validator';
    }


}