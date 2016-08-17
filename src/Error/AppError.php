<?php

namespace App\Error;

use Cake\Error\BaseErrorHandler;
use Cake\Log\Log;
use Cake\Network\Response;
use App\DTO;

class AppError extends BaseErrorHandler
{
    public $_options;
    
    public function _displayError($error, $debug)
    {
        echo 'There has been an error!';
    }
    public function _displayException($exception)
    {
         $request = new Request();
      if($request->contentType() == 'application/json'){  
       $errorDto = new DTO\ErrorDto();
       $errorDto->errorCode =   $exception->getCode()? $exception->getCode():500;
       $errorDto->message = $exception->getMessage();
        $error = new \App\Response\V1\BaseResponse($errorDto);
        $response = new Response();
        $response->type('json');
        $response->body(json_encode($error));
        $response->send();
          }else{
           echo '<h1>INTERNAL SERVER ERROR</h1><br><span><a href="/">Back To Home</a></span>';
       }
    }
    public function handleFatalError($code, $description, $file, $line)
    {
        echo 'A fatal error has happened';
    }
}

