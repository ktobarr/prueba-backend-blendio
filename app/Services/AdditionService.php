<?php

namespace App\Services;

class AdditionService{
    /**
     * Suma dos enteros.
     *
     * @param int $operatorA Primer operando.
     * @param int $operatorB Segundo operando.
     *
     * @return int Resultado de la suma.
     */
    public function add(int $operatorA, int $operatorB): int
    {
        return $operatorA + $operatorB;
    }
}