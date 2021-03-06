<?php
namespace Poirot\Loader\Autoloader;

use Poirot\Loader\ResourceMapTrait;

if (class_exists('Poirot\\Loader\\Autoloader\\ClassMapAutoloader' , false))
    return;

require_once __DIR__ . '/AbstractAutoloader.php';

class ClassMapAutoloader extends AbstractAutoloader
{
    use ResourceMapTrait {
        ResourceMapTrait::resolve as protected __t_resolve;
    }

    /**
     * Construct
     *
     * @param array|string $options
     */
    function __construct($options = null)
    {
        if ($options !== null)
            $this->from($options);
    }

    /**
     * Autoload Class Callable
     *
     * - must not throw exception
     *
     * @param string $class Class Name
     *
     * @return mixed
     */
    function resolve($class)
    {
        $resolved = $this->__t_resolve($class);
        if ($resolved)
            require_once $resolved;

        return $resolved;
    }
}
