<?php

namespace App\Actions\User;

use App\DTOs\User\FiltersDTO;
use App\Services\ListService;
use Illuminate\Pagination\LengthAwarePaginator;

class ListAction {

    public function __construct(
        public ListService $listService
    ){}

    public function __invoke($request = []) : LengthAwarePaginator
    {
        $filtersDTO = FiltersDTO::fromArray($request);
        
        return $this->listService->getListAll($filtersDTO);
    }
}