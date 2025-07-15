<?php

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
uses(RefreshDatabase::class);

test('usuario pode se autenticar com credencias validas', function () {

    Role::create(['name' => 'courier', 'label' => 'Entregador', 'guard_name' => 'api']);

    $user = User::factory()->create([
        'name' => 'Thiago Pest',
        'document' => '36133333399',
        'phone' => '11983344588',
        'email' => 'thiago_pest@example.com',
        'password' => bcrypt('senhanova123'),
    ]);

    $user->assignRole('courier');

    $response = $this->postJson('/api/login', [
        'email' => 'thiago_pest@example.com',
        'password' => 'senhanova123',
    ]);

    $response->assertOk();
});

test('usuário não pode se autenticar com senha inválida', function () {
    
    User::factory()->create([
        'name' => 'Thiago Pest',
        'document' => '36133333399',
        'phone' => '11983344588',
        'email' => 'thiago_pest@example.com',
        'password' => bcrypt('senhanova123'),
    ]);

    $response = $this->postJson('/api/login', [
        'email' => 'thiago@example.com',
        'password' => 'senha-incorreta',
    ]);
    
    $response->assertStatus(400);
    $response->assertJson([
        'status' => false,
        'message' => 'Credenciais inválidas.'
    ]);
});