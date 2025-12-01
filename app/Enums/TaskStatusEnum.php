<?php

namespace App\Enums;

enum TaskStatusEnum: string
{
    case OPEN = 'open';
    case DONE = 'done';
    case EXPIRED = 'expired';
    case CLOSED = 'closed';
}