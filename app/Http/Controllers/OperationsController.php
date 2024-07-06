<?php

namespace App\Http\Controllers;

use App\Services\AdditionService;
use App\Services\SubtractionService;
use App\Services\MultiplicationService;
use App\Services\DivisionService;
use Exception;
use Illuminate\Http\JsonResponse;
use App\Enums\Operation;
class OperationsController extends Controller{

    private AdditionService $additionService;
    private SubtractionService $subtractionService;
    private MultiplicationService $multiplicationService;
    private DivisionService $divisionService;

    public function __construct(AdditionService $additionService, SubtractionService $subtractionService, MultiplicationService $multiplicationService, DivisionService $divisionService){
        $this->additionService = $additionService;
        $this->subtractionService = $subtractionService;
        $this->multiplicationService = $multiplicationService;
        $this->divisionService = $divisionService;
    }

    /**
     * Realiza una operación matemática con los operandos dados.
     *
     * @param string $operation Tipo de operación ('ADDITION', 'SUBTRACTION', 'MULTIPLICATION', 'DIVISION').
     * @param int $operatorA Primer operando.
     * @param int $operatorB Segundo operando.
     *
     * @return JsonResponse Resultado de la operación en formato JSON o un mensaje de error si la operación es inválida o ocurre una excepción.
     */
    public function calculate(string $operation, int $operatorA, int $operatorB): JsonResponse
    {
        try {
            $operationEnum = Operation::tryFrom($operation);

            if (!$operationEnum) {
                return response()->json(['error' => 'Invalid operation'], 400);
            }

            $result = match ($operationEnum) {
                Operation::ADDITION => $this->additionService->add($operatorA, $operatorB),
                Operation::SUBTRACTION => $this->subtractionService->subtract($operatorA, $operatorB),
                Operation::MULTIPLICATION => $this->multiplicationService->multiply($operatorA, $operatorB),
                Operation::DIVISION => $this->divisionService->divide($operatorA, $operatorB),
            };
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

        return response()->json(['result' => $result]);
    }
}
