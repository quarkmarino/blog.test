<?php

use App\Enums\UserTypeEnum;

return [
    'title' => [
        'types' => [
            UserTypeEnum::ADMIN => 'Admin',
            UserTypeEnum::SUPERVISOR => 'Supervisor',
            UserTypeEnum::BLOGGER => 'Blogger',
        ],
        'id' => 'Id',
        'user_type' => 'User Type',
        'first_name' => 'First Name',
        'last_name' => 'Last Name',
        'email' => 'Email',
        'password' => 'Password',
        'password_confirmation' => 'Password Repeat',
        'last_login' => 'Last Login',
        'supervisors' => 'Supervisors',
        'bloggers' => 'Bloggers',
    ]
];
