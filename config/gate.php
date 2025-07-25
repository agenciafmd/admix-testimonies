<?php

use Agenciafmd\Testimonies\Policies\TestimonyPolicy;

return [
    [
        'name' => config('admix-testimonies.name'),
        'policy' => TestimonyPolicy::class,
        'abilities' => [
            [
                'name' => 'View',
                'method' => 'view',
            ],
            [
                'name' => 'Create',
                'method' => 'create',
            ],
            [
                'name' => 'Update',
                'method' => 'update',
            ],
            [
                'name' => 'Delete',
                'method' => 'delete',
            ],
            [
                'name' => 'Restore',
                'method' => 'restore',
            ],
        ],
        'sort' => 200,
    ],
];
