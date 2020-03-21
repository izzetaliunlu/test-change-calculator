<?php

declare(strict_types=1);

namespace AppBundle\Registry;

use AppBundle\Calculator\CalculatorInterface;
use AppBundle\Calculator\Mk1Calculator;
use AppBundle\Calculator\Mk2Calculator;

class CalculatorRegistry implements  CalculatorRegistryInterface
{
    public function getCalculatorFor(string $model): ?CalculatorInterface
    {
        switch ($model) {
            case Mk1Calculator::MODEL_NAME:
                return new Mk1Calculator();

            case Mk2Calculator::MODEL_NAME:
                return new Mk2Calculator();

            default:
                return null;
        }
    }
}
