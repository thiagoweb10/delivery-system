<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ValidateResetCodeService
{
    public function execute(array $data): void
    {
        $record = DB::table('password_reset_tokens')
            ->where('email', $data['email'])
            ->first();

        if (!$record) {
            throw new \Exception('Código inválido ou expirado.');
        }

        if (Carbon::parse($record->created_at)->addMinutes(10)->isPast()) {
            throw new \Exception('Código expirado.');
        }

        if (!Hash::check($data['code'], $record->token)) {
            throw new \Exception('Código inválido.');
        }
    }
}
