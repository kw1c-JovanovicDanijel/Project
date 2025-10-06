<?php

namespace App\Enums;

enum UserRoles
{
    case ACCOUNT_MANAGER;
    case PRODUCT_MANAGER;
    case BACKOFFICE_MEDEWERKER;
    case BACKOFFICE_MANAGER;
    case LOGISTIEK_MANAGER;
    case ADMIN;
}
