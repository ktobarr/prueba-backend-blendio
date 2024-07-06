<?php

namespace App\Services;

class SubtractionService{
    /**
     * Resta dos enteros.
     *
     * @param int $operatorA Primer operando.
     * @param int $operatorB Segundo operando.
     *
     * @return int Resultado de la resta.
     */
    public function subtract(int $operatorA, int $operatorB): int
    {
        return $operatorA - $operatorB;
    }
}