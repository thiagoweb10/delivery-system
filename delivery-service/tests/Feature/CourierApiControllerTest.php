<?php

use App\Services\CourierService;
use Illuminate\Pagination\LengthAwarePaginator;
use Mockery;
use Tests\Helpers\JwtTestHelper;

// Garante que os testes herdam do TestCase do Laravel
uses(Tests\TestCase::class)->in('Feature');

beforeEach(function () {
    // Mock do serviço
    $this->courierService = Mockery::mock(CourierService::class);
    $this->app->instance(CourierService::class, $this->courierService);
});

afterEach(function () {
    Mockery::close();
});

it('retorna lista de entregas disponíveis com sucesso', function () {
    $mockData = [
        [
        ],
    ];

    $paginator = new LengthAwarePaginator(
        collect($mockData),
        count($mockData),
        15,
        1
    );

    $mockService = Mockery::mock(CourierService::class);
    $mockService->shouldReceive('listAvailableDeliveries')->once()->andReturn($paginator);
    $this->app->instance(CourierService::class, $mockService);

    $token = JwtTestHelper::generate(['sub' => 16, 'role' => 'courier']);

    $response = $this->withHeaders([
        'Authorization' => "Bearer $token",
    ])->getJson('/api/deliveries/available');

    $response->assertStatus(200)
        ->assertJson([
            'status' => 'true',
            'message' => 'Listagem gerada com sucesso!',
        ])
        ->assertJsonStructure([
            'status',
            'message',
            'data' => [
                'current_page',
                'data' => [
                    '*' => [
                        'id',
                        'tracking_code',
                        'order_id',
                        'courier_id',
                        'delivery_status_id',
                        'type',
                        'pickup_address',
                        'delivery_address',
                        'pickup_time',
                        'delivery_time',
                        'notes',
                        'delivered_at',
                        'created_at',
                        'updated_at',
                    ],
                ],
                'first_page_url',
                'from',
                'last_page',
                'last_page_url',
                'links',
                'next_page_url',
                'path',
                'per_page',
                'prev_page_url',
                'to',
                'total',
            ],
        ]);
});
