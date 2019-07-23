<?php


namespace app\models;


class User extends AppModels
{

    public $attributes = [
        'login' => '',
        'password' => '',
        'email' => '',
        'name' => '',

    ];

    public $rules = [
        'required' =>[
            ['login'],
            ['password'],
            ['email'],
            ['name'],
        ],
        'email' =>[
            ['email']
        ],
        'lengthMin' => [
            ['password', 6]
        ]
    ];
}