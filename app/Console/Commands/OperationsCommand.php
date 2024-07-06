<?php

namespace App\Console\Commands;

use App\Enums\Operation;
use App\Services\AdditionService;
use App\Services\DivisionService;
use App\Services\MultiplicationService;
use App\Services\SubtractionService;
use Exception;
use Illuminate\Console\Command;
use ValueError;

class OperationsCommand extends Command
{
    private AdditionService $additionService;
    private SubtractionService $subtractionService;
    private MultiplicationService $multiplicationService;
    private DivisionService $divisionService;

    public function __construct(
        AdditionService $additionService,
        SubtractionService $subtractionService,
        MultiplicationService $multiplicationService,
        DivisionService $divisionService
    ) {
        parent::__construct();
        $this->additionService = $additionService;
        $this->subtractionService = $subtractionService;
        $this->multiplicationService = $multiplicationService;
        $this->divisionService = $divisionService;
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'operations {operatorA} {operatorB} {operation}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Performs a mathematical operation on two numbers';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $operation = $this->argument('operation');
        $operatorA = (int)$this->argument('operatorA');
        $operatorB = (int)$this->argument('operatorB');

        try {
            $operationEnum = Operation::tryFrom($operation);

            if (!$operationEnum) {
                return Command::FAILURE;
            }

            $result = match ($operationEnum) {
                Operation::ADDITION => $this->additionService->add($operatorA, $operatorB),
                Operation::SUBTRACTION => $this->subtractionService->subtract($operatorA, $operatorB),
                Operation::MULTIPLICATION => $this->multiplicationService->multiply($operatorA, $operatorB),
                Operation::DIVISION => $this->divisionService->divide($operatorA, $operatorB),
            };
        } catch (ValueError) {
            $this->error("Invalid operation: $operation");
            return Command::FAILURE;
        } catch (Exception $e) {
            $this->error($e->getMessage());
            return Command::FAILURE;
        }

        $this->info("Result: $result");
        return Command::SUCCESS;
    }
}
