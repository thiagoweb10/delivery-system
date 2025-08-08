<?php

use Illuminate\Support\Facades\App;

if (!function_exists('authUserId')) {
    function authUserId()
    {
        return App::has('userId') ? App::make('userId') : null;
    }
}
