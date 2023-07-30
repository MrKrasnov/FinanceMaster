<?php

namespace App\Core;

use ReflectionClass;

abstract class Request
{
    abstract public function setRequestParams() : void;

    public static function getValidRequest(string $class, string $method) : ?Request
    {
        /** @var Request|NULL $request */
        $request = null;

        try{
            $validateClass      = new ReflectionClass( 'App\Controllers\\'.ucfirst($class));
            $reflectionMethod   = $validateClass->getMethod($method);
            $parameters         = $reflectionMethod->getParameters();

            if(empty($parameters)) {
                return null;
            }

            foreach ($parameters as $parameter) {

                $type = $parameter->getType()?->getName();

                if(!isset($type)) {
                    continue;
                }

                if(is_subclass_of($type, __CLASS__)) {
                    $request = new $type();
                    break;
                }
            }

            $request->setRequestParams();
        }  catch (\ReflectionException $e) {
            Log::writeLog('Don\'t found a request class with the help the ReflectionClass' . PHP_EOL . $e->getMessage());
            View::renderErrorCodePage(500);
        }

        return $request;
    }


}