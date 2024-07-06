<?php

namespace App\Services;

class MultiplicationService{
    /**
     * MUltiplica dos enteros.
     *
     * @param int $operatorA Primer operando.
     * @param int $operatorB Segundo operando.
     *
     * @return int Resultado de la multiplicacion.
     */
    public function multiply(int $operatorA, int $operatorB): int
    {
        return $operatorA * $operatorB;
    }
}