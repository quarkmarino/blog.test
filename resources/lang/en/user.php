<?php

use App\Enums\UserTypeEnum;

return [
    'title' => [
        'types' => [
            UserTypeEnum::ADMIN => 'Admin',
            UserTypeEnum::SUPERVISOR => 'Supervisor',
            UserTypeEnum::BLOGGER => 'Blogger',
        ],
        'user_type' => 'User Type',
        'first_name' => 'First Name',
        'last_name' => 'Last Name',
        'email' => 'Email',
        'last_login' => 'Last Login',
    ]
];
