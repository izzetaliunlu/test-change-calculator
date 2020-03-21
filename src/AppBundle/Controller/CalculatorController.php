<?php

declare(strict_types=1);

namespace AppBundle\Controller;

use AppBundle\Calculator\Mk2Calculator;
use AppBundle\Registry\CalculatorRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalculatorController extends Controller
{
    /**
     * @Route(
     *     "/automaton/{modelName}/change/{amount}",
     *     name="app_calculator_change",
     *     options = {"expose"=true},
     *     methods = {"GET"}
     * )
     */
    public function calculate(string $modelName, int $amount, CalculatorRegistry $calculatorRegistry): JsonResponse
    {
        $calculator = $calculatorRegistry->getCalculatorFor($modelName);
        if (null === $calculator) {
            return new JsonResponse(null, Response::HTTP_NOT_FOUND);
        }

        $change = $calculator->getChange($amount);

        if (null === $change) {
            return new JsonResponse(null, Response::HTTP_NO_CONTENT);
        }

        return new JsonResponse($change);
    }
}
