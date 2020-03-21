<?php

declare(strict_types=1);

namespace AppBundle\Calculator;

use AppBundle\Model\Change;

class Mk2Calculator implements CalculatorInterface
{
    public const MODEL_NAME = 'mk2';

    public function getSupportedModel(): string
    {
        return self::MODEL_NAME;
    }

    public function getChange(int $amount): ?Change
    {
        if ($amount <= 1) {
            return null;
        }

        $initialAmount = $amount;

        $change = new Change();

        if ($amount >= 10) {
            $change->bill10 = intdiv($amount, 10);

            $amount = $amount % 10;
        }

        if ($amount >= 5) {
            $change->bill5 = intdiv($amount, 5);

            $amount = $amount % 5;
        }

        if ($amount >= 2) {
            $change->coin2 = intdiv($amount, 2);
        }

        $totalChange = $change->bill10 * 10 + $change->bill5 * 5 + $change->coin2 * 2;
        if ($totalChange !== $initialAmount) {
            return null;
        }

        return $change;
    }
}
