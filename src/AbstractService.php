<?php

namespace nueip\google\apiHelper;

use Google_Client;
use Google_Service;
use nueip\google\apiHelper\Client;

/**
 * Service Helper
 * 
 * @author  Nick Tsai <myintaer@gmail.com>
 * @since   1.0.1
 */
abstract class AbstractService
{
    /**
     * Current Service class name
     *
     * @var string $serviceClass
     */
    protected static $serviceClass;

    /**
     * Current Service
     *
     * @var object Google service object
     */
    protected static $service;
    
    /**
     * Set Google_Client into ClientHelper
     *
     * @param Google_Client $client
     * @return static
     */
    public static function setClient(Google_Client $client)
    {
        Client::setClient($client);
        
        // Clear service
        static::$service = null;

        return new static;
    }

    /**
     * Get Google Client from ClientHelper
     *
     * @return Google_Client By nueip\google\apiHelper\Client
     */
    public static function getClient()
    {
        return Client::getClient();
    }

    /**
     * Set Service
     * 
     * Giving by Google_Service or empty for new one
     *
     * @param Google_Service $service
     * @return self
     */
    public static function setService(Google_Service $service=null)
    {
        static::$service = ($service) ? $service : new static::$serviceClass(static::getClient());

        return new static;
    }
    
    /**
     * Get Service
     *
     * @return object Current Google Service
     */
    public static function getService()
    {
        if (!static::$service) {
            
            static::setService();
        }

        return static::$service;
    }
}
