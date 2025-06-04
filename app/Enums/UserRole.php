<?php

namespace App\Enums;

enum UserRole: int
{
    case Admin = 1;
    case Author = 2;
    case Guest = 3;
}