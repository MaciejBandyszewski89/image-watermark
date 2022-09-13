<?php

declare(strict_types=1);

namespace App\Validator;

use App\Repository\UserRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

final class UniqueEmailValidator extends ConstraintValidator
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function validate(mixed $value, Constraint $constraint)
    {
        if (!$this->userRepository->findOneBy(['email' => $value])) {
            return;
        }

        $this->context->addViolation($constraint->message);
    }
}
