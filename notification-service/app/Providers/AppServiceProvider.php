<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Listeners\SendLinkResetListener;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $connection = new AMQPStreamConnection('rabbitmq', 5672, 'guest', 'guest');
        $channel = $connection->channel();

        $queue = 'user.sendlinkreset-password';
        $channel->queue_declare($queue, false, true, false, false);

        $channel->basic_consume($queue, '', false, true, false, false, new SendLinkResetListener());

        register_shutdown_function(function () use ($channel, $connection) {
            while ($channel->is_consuming()) {
                $channel->wait();
            }
            $channel->close();
            $connection->close();
        });
    }
}
