<?php

return [
    'parent'=> 'parent',
    'primary_key' => 'id',
    'generate_url'   => true,
    'childNode' => 'child',
    'body' => [
        'id',
        'label',
        'link',
        'parent',
        'sort',
        'class',
        'menu',
        'depth'
    ],
    'html' => [
        'label' => 'label',
        'href'  => 'link'
    ],
    'dropdown' => [
        'prefix' => '',
        'label' => 'label',
        'value' => 'link'
    ]
];
