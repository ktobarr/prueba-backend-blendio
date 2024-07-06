<?php

namespace App\Services;

use Exception;

class DivisionService{
    /**
     * Divide dos enteros.
     *
     * @param int $operatorA Dividendo.
     * @param int $operatorB Divisor.
     *
     * @return float|int Resultado de la división.
     *
     * @throws Exception Si el divisor es cero.
     */
    public function divide(int $operatorA, int $operatorB): float|int
    {
        return $operatorB == 0 ? throw new Exception("Second operator cannot be zero. Division by zero") : $operatorA / $operatorB;
    }
}