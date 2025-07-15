<?php


use Spatie\Permission\Models\Role;
use App\Actions\User\RegisterAction;
use App\Jobs\SendToRabbitMQ;

use Illuminate\Support\Facades\Queue;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('registra um novo usuário com sucesso', function () {

    Role::create(['name' => 'courier', 'label' => 'Entregador', 'guard_name' => 'api']);
    
    Queue::fake();

    $dto = [
        'name' => 'Thiago Pest',
        'document' => '36133333399',
        'phone' => '11983344588',
        'email' => 'thiago_pest@example.com',
        'password' => 'senha123',
        'role' => 'courier',
    ];

    $action = app(RegisterAction::class);
    $result = $action->execute($dto);

    expect($result->name)->toBe('Thiago Pest');
    expect($result->email)->toBe('thiago_pest@example.com');

    Queue::assertPushed(SendToRabbitMQ::class, function ($job) use ($dto) {
        return $job->payload['email'] === $dto['email'];
    });
});