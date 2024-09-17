<?php

namespace App\Enums;

use ReflectionClass;

enum StatusEnum : int
{
    case NOT_STARTED = 1;
    case FIRST_HALF = 2;
    case HALF_TIME = 3;
    case SECOND_HALF = 4;
    case OVERTIME = 5;
    case OVERTIME_DEPRECATED = 6;
    case PENALTY = 7;
    case END = 8;
    case DELAY = 9;


    public static function keys()
    {
        $permissions = [];
        $reflection = new ReflectionClass(StatusEnum::class);
        foreach ($reflection->getConstants() as $constantValue) {
            $permissions[] = $constantValue->value;
        }
        return $permissions;
    }
}