<?php

namespace App\Enums;

enum UserTypeEnum: int
{
    case ADMIN = 1;
    case CUSTOMER = 2;
    case ONG = 3;
}
