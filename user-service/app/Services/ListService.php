<?php

namespace App\Services;

use App\Models\User;

class ListService {

    public static function getListAll($filtersDTO)
    {
       return User::paginateWithFilters($filtersDTO->toArray());
    }

}