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
        'bendahara' => [
            'users' => 'c,r,u,d',
            'profile' => 'r,u'
        ],
        'petugas_iuran' => [
            'users' => 'c,r,u,d',
            'profile' => 'r,u'
        ],
        'warga' => [
            'profile' => 'r,u'
        ]
    ],
    'user_roles' => [
        'admin' => [
            ['name' => "Admin", "email" => "admin@admin.com", "phone_number" => "623728290281","password" => 'password'],
        ],
        'ketua_rt' => [
            ['name' => "Ketua RT", "email" => "rt@admin.com", "phone_number" => "628113021011","password" => 'password'],
        ],
        'bendahara' => [
            ['name' => "Bendahara", "email" => "bendahara@admin.com", "phone_number" => "628113221011","password" => 'password'],
        ],
    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
    ],
];
