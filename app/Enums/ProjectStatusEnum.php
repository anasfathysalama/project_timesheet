<?php

namespace App\Enums;

enum ProjectStatusEnum: string
{
    use BaseEnum;

    case OPEN = 'open';
    case IN_PROGRESS = 'in_progress';
    case CLOSED = 'closed';
}
