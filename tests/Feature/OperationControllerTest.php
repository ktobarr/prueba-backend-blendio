<?php

namespace Tests\Feature;

use App\Http\Controllers\OperationsController;
use App\Services\AdditionService;
use App\Services\DivisionService;
use App\Services\MultiplicationService;
use App\Services\SubtractionService;
use Tests\TestCase;

class OperationControllerTest extends TestCase {

    public function testWithInvalidOPeration(){
        $controller = new OperationsController(
            new AdditionService(),
            new SubtractionService(),
            new MultiplicationService(),
            new DivisionService()
        );

        $response = $controller->calculate('invalid', 1, 2);
        $this->assertEquals(400, $response->getStatusCode());
        $this->assertJsonStringEqualsJsonString('{"error": "Invalid operation"}', $response->getContent());
    }

    public function testOperationReturnsAdditionResult(){
        $controller = new OperationsController(
            new AdditionService(),
            new SubtractionService(),
            new MultiplicationService(),
            new DivisionService()
        );

        $response = $controller->calculate('add', 10, 5);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJsonStringEqualsJsonString('{"result": 15}', $response->getContent());
    }

    public function testOperationReturnsSubtractionResult(){
        $controller = new OperationsController(
            new AdditionService(),
            new SubtractionService(),
            new MultiplicationService(),
            new DivisionService()
        );

        $response = $controller->calculate('subtract', 10, 5);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJsonStringEqualsJsonString('{"result": 5}', $response->getContent());
    }

    public function testOperationReturnsMultiplicationResult(){
        $controller = new OperationsController(
            new AdditionService(),
            new SubtractionService(),
            new MultiplicationService(),
            new DivisionService()
        );

        $response = $controller->calculate('multiply', 10, 5);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJsonStringEqualsJsonString('{"result": 50}', $response->getContent());
    }

    public function testOperationReturnsValidDivisionResult(){
        $controller = new OperationsController(
            new AdditionService(),
            new SubtractionService(),
            new MultiplicationService(),
            new DivisionService()
        );

        $response = $controller->calculate('divide', 10, 5);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJsonStringEqualsJsonString('{"result": 2}', $response->getContent());
    }

    public function testOperationReturnsDivisionByZeroResult(){
        $controller = new OperationsController(
            new AdditionService(),
            new SubtractionService(),
            new MultiplicationService(),
            new DivisionService()
        );

        $response = $controller->calculate('divide', 10, 0);
        $this->assertEquals(400, $response->getStatusCode());
        $this->assertJsonStringEqualsJsonString('{"error": "Second operator cannot be zero. Division by zero"}', $response->getContent());
    }
}