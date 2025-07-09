<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessUserTest implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public array $userData
    )
    {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        \Log::info('Processando usuário na fila:', $this->userData);
    }
}
