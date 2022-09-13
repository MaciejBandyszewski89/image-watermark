<?php

declare(strict_types=1);

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

final class UniqueEmailConstraint extends Constraint
{
    public string $message = 'This email is already registered in our application';

    public function validatedBy()
    {
        return UniqueEmailValidator::class;
    }
}
