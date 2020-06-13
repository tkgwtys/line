<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use LINE\LINEBot;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->lineBot();
    }

    /**
     * ラインボット
     */
    private function lineBot()
    {
        $this->app->bind('line-bot', function ($app, array $parameters) {
            return new LINEBot(
                new LINEBot\HTTPClient\CurlHTTPClient(config('app.line.access_token')),
                ['channelSecret' => config('app.line.channel_secret')]
            );
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        # 商用環境以外だった場合、SQLログを出力する
        if (config('app.env') !== 'production') {
            DB::listen(function ($query) {
                \Log::info("Query Time:{$query->time}s] $query->sql " . json_encode($query->bindings));
            });
        }
    }
}
