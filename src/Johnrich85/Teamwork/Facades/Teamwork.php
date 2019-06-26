<?php  namespace Johnrich85\Teamwork\Facades;

use Illuminate\Support\Facades\Facade;

class Teamwork extends Facade {
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'rossedman.teamwork'; }
}
