<?php

namespace App\Enums;

enum AttributeTypeEnum: string
{
    use BaseEnum;

    case TEXT = 'text';
    case DATE = 'date';
    case NUMBER = 'number';
    case SELECT = 'select';
}
