<?php

namespace App\Core;

use App\Core\Enum\AcceptType;
use App\Exceptions\ValidationException;
use ReflectionClass;

abstract class Request
{
    abstract public function setRequestParams() : void;
    /**
     * @throws ValidationException
     */
    public function doValidate(): void{}

    public static function getValidRequest(string $class, string $method) : ?Request
    {
        /** @var Request|NULL $request */
        $request = null;
        $acceptType = null;

        try{
            $controllerClass    = new ReflectionClass( 'App\Controllers\\'.ucfirst($class));
            $reflectionMethod   = $controllerClass->getMethod($method);
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

            $acceptType = AcceptType::fromServer();
            $request->doValidate();
            $request->setRequestParams();
        } catch (\ReflectionException $e) {
            //TODO: fixed writeLog - https://github.com/MrKrasnov/FinanceMaster/issues/7
//            Log::writeLog('Don\'t found a request class with the help the ReflectionClass' . PHP_EOL . $e->getMessage());

            if (isset($acceptType) && $acceptType === AcceptType::Json) {
                View::renderJsonForErrorCode($e->getCode(), $e->getMessage());
            } else {
                View::renderErrorCodePage(500);
            }
        } catch (ValidationException $e) {
            //TODO: fixed writeLog - https://github.com/MrKrasnov/FinanceMaster/issues/7
            //Log::writeLog($e->getMessage());

            if (isset($acceptType) && $acceptType === AcceptType::Json) {
                View::renderJsonForErrorCode($e->getCode(), $e->getMessage());
            } else {
                View::renderErrorCodePage($e->getCode());
            }
        }

        return $request;
    }

}