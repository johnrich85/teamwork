<?php namespace Johnrich85\Teamwork;

use GuzzleHttp\Client as Guzzle;
use Illuminate\Support\ServiceProvider;

class TeamworkServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('rossedman.teamwork', function($app)
        {
            $client = new \Johnrich85\Teamwork\Client(new Guzzle,
                $app['config']->get('services.teamwork.key'),
                $app['config']->get('services.teamwork.url')
            );

            return new \Johnrich85\Teamwork\Factory($client);
        });

        $this->app->bind('Johnrich85\Teamwork\Factory', 'rossedman.teamwork');
    }

}
