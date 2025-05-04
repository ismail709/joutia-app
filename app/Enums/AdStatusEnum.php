<?php

namespace App\Enums;

enum AdStatusEnum: string {
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REFUSED = 'refused';
}