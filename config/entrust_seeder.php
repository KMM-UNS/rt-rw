<?php

return [
    'role_structure' => [
        'admin' => [
            'users' => 'c,r,u,d',
            'profile' => 'c,r,u,d'
        ],
        'ketua_rt' => [
            'users' => 'c,r,u,d',
            'profile' => 'r,u'
        ],
        'ketua_rw' => [
            'users' => 'c,r,u,d',
            'profile' => 'r,u'
        ],
        'warga' => [
            'profile' => 'r,u'
        ]
    ],
    'user_roles' => [
        'admin' => [
            ['name' => "Admin", "email" => "admin@admin.com", "password" => 'password'],
        ],
    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
    ],
];
