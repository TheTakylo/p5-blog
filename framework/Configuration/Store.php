<?php

namespace Framework\Configuration;

use Framework\Router\Router;
use Twig\Environment;

class Store
{
    private $store = [];

    private static $_instance;

    public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new Store();
        }
        return self::$_instance;
    }

    private function __construct()
    {
    }

    public function get($key)
    {
        if (!isset($this->store[$key])) {
            return null;
        }
        return $this->store[$key];
    }

    public function set($key, $value)
    {
        $this->store[$key] = $value;
    }

    /**
     * @return Router
     */
    public function getRouter(): Router
    {
        return $this->get('Router');
    }

    /**
     * @return \PDO
     */
    public function getDatabase(): \PDO
    {
        return $this->get('Database');
    }

    /**
     * @return Environment
     */
    public function getTwig(): Environment
    {
        return $this->get('Twig');
    }
}