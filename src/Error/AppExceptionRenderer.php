<?php
// goes in src/Error/AppExceptionRenderer
namespace App\Error;

use Cake\Error\ExceptionRenderer;
use Cake\Network\Request;
use Cake\Network\Response;
use App\DTO;
class AppExceptionRenderer extends ExceptionRenderer
{
    public function render()
    {
       $request = new Request();
       $response = new Response();
       if($request->contentType() == 'application/json'){
           $errorDto = new DTO\ErrorDto();
           $errorDto->errorCode = '500';
           $errorDto->message = 'Server Error ! This functionality unavailable.';
           $error = new \App\Response\V1\BaseResponse($errorDto);
        $response->type('json');
        $response->body(json_encode($error));
        $response->send();
       }else{
           echo '<h1>INTERNAL SERVER ERROR</h1><br><span><a href="/">Back To Home</a></span>';
       }
       
       
    }
}