<?php

use Illuminate\Support\Facades\App;

if (!function_exists('authUserId')) {
    function authUserId()
    {
        return App::has('userId') ? App::make('userId') : null;
    }
}

if (!function_exists('authUserRole')) {
    function authUserRole()
    {
        return App::has('userRole') ? App::make('userRole') : null;
    }
}
