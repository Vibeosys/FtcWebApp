<?php
namespace App\DTO;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ClsErrorDto
 *
 * @author niteen
 */
class ErrorDto {
    
    public $errorCode;
    public $message;
   // public $data;
    //public $settings;


    //format {"errorCode":"100", "message":"User is not authenticated"}
    public static function prepareError($errorcode) {
        
        $errorDto = new ErrorDto();
        $errorDto->errorCode = $errorcode;
        $errorDto->message = $errorDto->errorDictionary[$errorcode];
        return json_encode($errorDto);
    }
    
     public static function prepareSuccessMessage($successCode) {
        
        $errorDto = new ErrorDto();
        $errorDto->errorCode = 0;
        $errorDto->message = $errorDto->SuccessDictionary[$successCode];
        return json_encode($errorDto);
    }
    
    protected $errorDictionary = [
        101 => 'Signals not found for given criteria.',
        102 => 'Login failed for the user',
        103 => 'Sorry..! User registration Failed.',
        104 => 'Email id is invalid, it does not exist in our record',
        105 => 'Unable to get the details.',
        106 => 'Error while changing the Ad status.',
        107 => 'Configurations could not be saved.',
        108 => 'User is not authorised for this activity',
        109 => 'Error ocurred while posting the Ad.',
        110 => 'Error occurred while saving the Ad.',
        111 => 'No ads found for the given criteria',
        112 => 'No data found.',
        113 => 'Sorry the email service is currently unavailable, please try after some time',
        114 => 'Error while changing user setting.',
        115 => 'Error while updating user profile.',
        116 => 'Error occurred while removing favourite Ad.',
       ];
    protected $SuccessDictionary = [
        1 => 'Signals found.',
        2 => 'Congrasts..!You are register with us.',
        3 => 'Please check your mail box..!',
        4 => 'Ad status changed.',
        5 => 'Invalid request',
        6 => 'Error to Place order',
        7 => 'Orders Not FulFilled for requested customer',
        8 => 'Configurations saved successfully',
        9 => 'Your ad posted successfully.',
        10 => 'Your ad set as Favourite successfully.',
        11 => 'Ad found.',
        12 => 'categories are found.',
        13 => 'Types are found.',
        14 => 'Requested profile found.',
        15 => 'User radius settings changed.',
        16 => 'User profile updated.',
        17 => 'Your ad removed from Favourite successfully.',
       ];
    
}
