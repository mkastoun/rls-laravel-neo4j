<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'team',
        'team/*/employee',
        'employee/*',
        'folder',
        'folder/*/item',
        'access-level',
        'access/*/employee/*',
        'access/*/item/*',
        'access/*/folder/*',
        'access/*/team/*',
        'employee/orphan'
    ];
}
