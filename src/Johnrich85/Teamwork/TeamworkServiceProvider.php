<?php namespace Johnrich85\Teamwork;

use GuzzleHttp\Client as Guzzle;
use Illuminate\Support\ServiceProvider;

class TeamworkServiceProvider extends ServiceProvider {

    public function register(): void
    {
        $this->app->singleton('rossedman.teamwork', function($app)
        {
            $client = new Client(new Guzzle,
                $app['config']->get('services.teamwork.key'),
                $app['config']->get('services.teamwork.url')
            );

            return new Factory($client);
        });

        $this->app->bind('Johnrich85\Teamwork\Factory', 'rossedman.teamwork');
    }

}
