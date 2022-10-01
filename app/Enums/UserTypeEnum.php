<?php

namespace App\Enums;

use App\Enums\Contracts\Enumerable;
use App\Enums\Traits\EnumerableTrait;

class UserTypeEnum implements Enumerable
{
    use EnumerableTrait;

    const ADMIN = 'admin';
    const SUPERVISOR = 'supervisor';
    const BLOGGER = 'blogger';
}
