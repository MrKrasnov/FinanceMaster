<?php

namespace App\Core\Enum;

enum UserRole: int
{
    case Owner = 0;
    case Admin = 1;
    case Viewer = 2;
}
