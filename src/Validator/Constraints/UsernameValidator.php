<?php

/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * Class UsernameValidator
 */
class UsernameValidator extends ConstraintValidator
{
    /**
     * @param mixed      $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        /* @var $constraint Username */

        if (!\is_string($value)) {
            throw new UnexpectedTypeException($value, 'string');
        }

        if (\preg_match('/^1\d{10}$/', $value) && !\preg_match('/^[\x{4e00}-\x{9fa5}a-zA-z0-9_.·]+$/u', $value)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }
    }
}
