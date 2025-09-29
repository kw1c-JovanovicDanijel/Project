<?php

namespace App\Enums;

enum OrderStatus
{
    case PENDING;
    case PROCESSING;
    case SHIPPED;
    case DELIVERED;
    case CANCELLED;
}
