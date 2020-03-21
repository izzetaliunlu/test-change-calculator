<?php

declare(strict_types=1);

namespace AppBundle\Calculator;

use AppBundle\Model\Change;

class Mk1Calculator implements CalculatorInterface
{
    public const MODEL_NAME = 'mk1';

    public function getSupportedModel(): string
    {
        return self::MODEL_NAME;
    }

    public function getChange(int $amount): ?Change
    {
        if ($amount <= 0) {
            return null;
        }

        $change = new Change();
        $change->coin1 = $amount;

        return $change;
    }
}
