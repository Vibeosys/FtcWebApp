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
    
    public static function getWebMessage($messageCode) {
         $errorDto = new ErrorDto();
        return $errorDto->webMessageDictionary[$messageCode];
    }
    
    protected $errorDictionary = [
        101 => 'Signals not found for given criteria.',
        102 => 'Sorry..! User registration Failed.',
        103 => 'Login failed for the user',
        104 => 'Your subscription expired. Please contact administrator',
        105 => 'Your subscription not found. Please contact administrator',
        106 => 'Username not available.',
        107 => 'Sorry the email service is currently unavailable, please try after some time',
        108 => 'Your information didnt match.',
        109 => 'Error ocurred while reset password.',
        110 => 'You are not authorised for this request.',
        111 => 'Password didnt match. please modify request.',
        112 => 'No data found.',
        113 => 'Sorry the email service is currently unavailable, please try after some time',
        114 => 'Error while updating user profile.',
        115 => 'Trade history signal not found for given criteria.',
        116 => 'Pages not found for given criteria.',
        117 => 'Error in acknowledgement.',
        118 => 'Fail to connect database.',
        119 => 'User list empty.',
       ];
    protected $SuccessDictionary = [
        1 => 'Signals found.',
        2 => 'Congrats..!You have been registered with us.',
        3 => 'Login successful..!',
        4 => 'Username available.',
        5 => 'Please check your mailbox and follow instruction.',
        6 => 'Password reset successfull.',
        7 => 'Orders Not FulFilled for requested customer',
        8 => 'User profile.',
        9 => 'Profile updated successfully.',
        10 => 'Trade history signal found.',
        11 => 'Pages found.',
        12 => 'Acknowledgement success.',
        
        13 => 'Database connected successfully.',
        14 => 'Requested profile found.',
        15 => 'User radius settings changed.',
        16 => 'User profile updated.',
        17 => 'Your ad removed from Favourite successfully.',
       ];
    
    protected $webMessageDictionary = [
        1 => 'This link is expired.Please try again.',
        2 => 'Congrats..!Your password successfully changed.',
        3 => 'Sorry..! Your password not changed.',
        4 => 'Page saved as draft.',
        5 => 'Error to save page. Please try again.',
        6 => 'Page Successfully updated.',
        7 => 'Error to save page. Please try again.',
        8 => 'Database saved Successfully.',
        9 => 'Error to save database. Please try again.',
        10 => 'Database updated Successfully.',
        11 => 'Error to update database. Please try again.',

        12 => 'categories are found.',
        13 => 'Types are found.',
        14 => 'Requested profile found.',
        15 => 'User radius settings changed.',
        16 => 'User profile updated.',
        17 => 'Your ad removed from Favourite successfully.',
       ];
}
