<?php

namespace App\Enums;

enum Operation: string{
    case ADDITION = 'add';
    case SUBTRACTION = 'subtract';
    case MULTIPLICATION = 'multiply';
    case DIVISION = 'divide';
}