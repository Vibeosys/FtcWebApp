<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\V1;

use App\Controller;
use App\Model\Table\V1;
use App\DTO;
use Cake\Log\Log;
use App\Controller\V2;


//use App\Request\V1;
/**
 * Description of UserController
 *
 * @author niteen
 */
class UserController extends Controller\ApiController {

    public $email_subject = 'Forgot Password';

    public function getTableObj() {
        return new V1\UserTable();
    }

    public function UserRegistration() {
        $this->autoRender = FALSE;
        $request = $this->getRequest();
        $userRequest = \App\Request\V1\UserRegisterRequest::Deserialize(
                $request->data);
        $registorInfo = new DTO\UserRegistrationDto(
                $userRequest->username, 
                $userRequest->name, 
                md5($userRequest->pwd), 
                $userRequest->email, 
                $userRequest->phone, 
                USER_GROUP, 
                null, 
                CREATOR_ID, 
                date(DATE_TIME_FORMAT), 
                CLIENT_ID, 
                DELETE_STATUS, 
                COMPANY_NAME, 
                ACTIVE);
        $this->conncetionCreator();
        if (!$this->getTableObj()->insert($registorInfo))
            $response = new \App\Response\V1\BaseResponse(
                    DTO\ErrorDto::prepareError(102));
        else
            $response = new \App\Response\V1\BaseResponse(
                    DTO\ErrorDto::prepareSuccessMessage(2));

        $this->response->body(json_encode($response));
    }

    public function userLogin() {
        $this->autoRender = FALSE;
        $request = $this->getRequest();
        $loginRequest = \App\Request\V1\UserLoginRequest::Deserialize(
                $request->data);
        Log::debug("request data string: " . $request->data);
        $this->conncetionCreator();

        if (!$this->getTableObj()->validateCredential(
                $loginRequest->username, md5($loginRequest->pwd)))
            $response = new \App\Response\V1\BaseResponse(
                    DTO\ErrorDto::prepareError(103));
        else {
            $info = $this->getTableObj()->getUserDetails($loginRequest->username);
            $info->subscriberId = 0;
            $response = new \App\Response\V1\BaseResponse(
                    DTO\ErrorDto::prepareSuccessMessage(3), json_encode($info));
        }
        $this->response->body(json_encode($response));
    }

    public function userSubLogin() {
        $this->autoRender = FALSE;
        $request = $this->getRequest();
        $loginRequest = \App\Request\V1\UserSubLoginRequest::Deserialize(
                $request->data);
        //connect to database using subscriberId
        if (!$this->conncetionCreator($loginRequest->subscriberId)) {
            $response = new \App\Response\V1\BaseResponse(
                    DTO\ErrorDto::prepareError(105));
            $this->response->body(json_encode($response));
            return;
        }
        //validate user using username, password, and validate license 
        //availability and expiry date
        // return bool true if all condition true else return error object
        $result = $this->userValidation($loginRequest);
        if (is_bool($result)) {
            $info = $this->getTableObj()->getUserDetails($loginRequest->username);
            $info->subscriberId = $loginRequest->subscriberId;
            $response = new \App\Response\V1\BaseResponse(
                    DTO\ErrorDto::prepareSuccessMessage(3), json_encode($info));
        } else
            $response = $result;
        $this->response->body(json_encode($response));
    }

    public function checkUserCredential($username, $pwd = null, $subscriberId = null) {
        $result =  $this->getTableObj()->validateCredential($username, $pwd);
        if(is_null($subscriberId) or !$result)
            return $result;
        $subscriberController = new V2\SystemsController();
        if($subscriberController->subscriberValidationCheck($result, $subscriberId))
            return $result;
        return FALSE;
    }

    public function usernameAvailability() {
        $this->autoRender = FALSE;
        $request = $this->getRequest();
        $usernameRequest = \App\Request\V1\UsernameAvailabilityRequest::Deserialize(
                $request->data);
        $this->conncetionCreator();
        if ($this->getTableObj()->validateCredential($usernameRequest->username))
            $response = new \App\Response\V1\BaseResponse(
                    DTO\ErrorDto::prepareError(106));
        else
            $response = new \App\Response\V1\BaseResponse(
                    DTO\ErrorDto::prepareSuccessMessage(4));
        $this->response->body(json_encode($response));
    }

    public function forgotPassword() {
        $this->autoRender = FALSE;
        $request = $this->getRequest();
        $this->conncetionCreator();
        $forgotRequest = \App\Request\V1\ForgotPasswordRequest::Deserialize(
                $request->data);
        $result = $this->getTableObj()->getPassword(
                $forgotRequest->username, $forgotRequest->email);
        Log::debug('Result of forgot password is : ' . $result);
        if ($result) {
            $link = $this->getChangePasswordLink($result);
            $FpEmailTemplate = new V2\EmailTemplatesController();
            $template = $FpEmailTemplate->getForgotPasswordTemplate();
            if(!$template){
                $response = new \App\Response\V1\BaseResponse(
                    DTO\ErrorDto::prepareError(108));
            $this->response->body(json_encode($response));
            return;
            }
            $message = str_replace(TEMPLATE_NIDDLE, $link, $template);
            $message = str_replace('#user_name#', $forgotRequest->username, $message);
            if ($this->mail($forgotRequest->email, $this->email_subject, $message) )
                $response = new \App\Response\V1\BaseResponse(
                        DTO\ErrorDto::prepareSuccessMessage(5));
            else
                $response = new \App\Response\V1\BaseResponse(
                        DTO\ErrorDto::prepareError(107));
        } else
            $response = new \App\Response\V1\BaseResponse(
                    DTO\ErrorDto::prepareError(108));
        $this->response->body(json_encode($response));
    }

    public function forgotSubPassword() {
        $this->autoRender = FALSE;
        $request = $this->getRequest();
        $forgotRequest = \App\Request\V1\ForgotPasswordSubRequest::Deserialize(
                $request->data);
        
        if (!$this->conncetionCreator($forgotRequest->subscriberId) or is_null($forgotRequest->subscriberId)) {
            $response = new \App\Response\V1\BaseResponse(
                    DTO\ErrorDto::prepareError(105));
            $this->response->body(json_encode($response));
            return;
        }
        $result = $this->getTableObj()->getPassword(
                $forgotRequest->username, $forgotRequest->email);
        $systemController = new V2\SystemsController();
        
        if ($result and $systemController->subscriberValidationCheck($result,$forgotRequest->subscriberId)) {
            $sub = TRUE;
            $link = $this->getChangePasswordLink($result, $sub);
            $this->reliseConnection();
            if (!$this->conncetionCreator($forgotRequest->subscriberId)) {
            $response = new \App\Response\V1\BaseResponse(
                    DTO\ErrorDto::prepareError(105));
            $this->response->body(json_encode($response));
            return;
            }
             $FpEmailTemplate = new V2\EmailTemplatesController();
            $template = $FpEmailTemplate->getForgotPasswordTemplate();
            if(!$template){
                $response = new \App\Response\V1\BaseResponse(
                    DTO\ErrorDto::prepareError(108));
            $this->response->body(json_encode($response));
            return;
            }
            $message = str_replace(TEMPLATE_NIDDLE, $link, $template);
            $message = str_replace('#user_name#', $forgotRequest->username, $message);
            if ($this->mail($forgotRequest->email, $this->email_subject, $message, $result))
                $response = new \App\Response\V1\BaseResponse(
                        DTO\ErrorDto::prepareSuccessMessage(5));
            else
                $response = new \App\Response\V1\BaseResponse(
                        DTO\ErrorDto::prepareError(107));
        } else
            $response = new \App\Response\V1\BaseResponse(
                    DTO\ErrorDto::prepareError(108));
        $this->response->body(json_encode($response));
    }

    public function changePassword() {

        if ($this->request->is('post') and isset($this->request->data['login'])) {
            $data = $this->request->data;

            if (isset($data['subscriberId']))
                $subId = $data['subscriberId'];
            else
                $subId = false;
            $changeRequest = new \App\Request\V1\ChangePasswordRequest(
                    $data['userId'], $subId, $data['pwd']);
            $this->conncetionCreator($subId);
            if ($this->getTableObj()->changePassword(
                    $changeRequest->userId, $changeRequest->pwd))
                $this->set([
                    'sucMsg' => DTO\ErrorDto::getWebMessage(2),
                    'color' => 'green'
                ]);
            else
                $this->set([
                    'sucMsg' => DTO\ErrorDto::getWebMessage(3),
                    'color' => 'red'
                ]);
        }else {
            $this->conncetionCreator();
            $code = $this->request->query('code');
            $query = $this->request->query;
            $changePasswordLogController = new ChangePasswordLogController();
            $userId = $changePasswordLogController->getCurrentEntry($code);
            $data = [
                'userId' => $userId,
                'errorMessage' => DTO\ErrorDto::getWebMessage(1),
            ];
            if (isset($query['type'])) {
                $data['isShowSub'] = true;
            }
            $this->set($data);
        }
        // $this->response->type('html');
    }

    public function resetPassword() {
        $this->autoRender = FALSE;
        $request = $this->getRequest();
        $resetRequest = \App\Request\V1\ResetPasswordRequest::Deserialize(
                $request->data);
        $resetUser = \App\Request\V1\UserRequest::Deserialize(
                $request->user);
        if (!$this->conncetionCreator($resetUser->subscriberId)) {
            $response = new \App\Response\V1\BaseResponse(
                    DTO\ErrorDto::prepareError(105));
            $this->response->body(json_encode($response));
            return;
        }
        // pass false for login user validation
        $result = $this->userValidation($resetUser, FALSE);
        if (is_bool($result)) {
            if ($this->getTableObj()->validateCredential(
                    $resetUser->username, md5($resetRequest->oldPwd)))
                if ($this->getTableObj()->changePassword(
                        $resetUser->userId, $resetRequest->newPwd)) {
                    $info = $this->getTableObj()->getUserDetails(null, $resetUser->userId);
                    $info->subscriberId = $resetUser->subscriberId;
                    $response = new \App\Response\V1\BaseResponse(
                            DTO\ErrorDto::prepareSuccessMessage(6), json_encode($info));
                } else
                    $response = new \App\Response\V1\BaseResponse(
                            DTO\ErrorDto::prepareError(109));
            else
                $response = new \App\Response\V1\BaseResponse(
                        DTO\ErrorDto::prepareError(111));
        } else
            $response = $result;
        $this->response->body(json_encode($response));
    }

    public function getUserProfile() {
        $this->autoRender = FALSE;
        $request = $this->getRequest();
        $getProfileRequest = \App\Request\V1\UserRequest::Deserialize(
                $request->user);
   
        if (!$this->conncetionCreator($getProfileRequest->subscriberId)) {
            $response = new \App\Response\V1\BaseResponse(
                    DTO\ErrorDto::prepareError(105));
            $this->response->body(json_encode($response));
            return;
        }
        $result = $this->userValidation($getProfileRequest, FALSE);
        if (is_bool($result)) {
            $profile = $this->getTableObj()->getProfile(
                    $getProfileRequest->userId);
            if (is_null($profile))
                $response = new \App\Response\V1\BaseResponse(
                        DTO\ErrorDto::prepareError(112));
            else {
                $userPlanController = new UserPlanController();
                $profile->plan = $userPlanController->getUserPlan(
                        $getProfileRequest->userId);
                $profile->subscriberId = $getProfileRequest->subscriberId;
                $response = new \App\Response\V1\BaseResponse(
                        DTO\ErrorDto::prepareSuccessMessage(8), json_encode($profile));
            }
        } else
            $response = $result;
        $this->response->body(json_encode($response));
    }

    public function updateUserProfile() {
        $this->autoRender = FALSE;
        $request = $this->getRequest();
        $requestUser = \App\Request\V1\UserRequest::Deserialize($request->user);
        $updateRequest = \App\Request\V1\UpdateUserProfileRequest::Deserialize(
                $request->data);
         Log::debug($updateRequest);
        if (!$this->conncetionCreator($requestUser->subscriberId)) {
            $response = new \App\Response\V1\BaseResponse(
                    DTO\ErrorDto::prepareError(105));
            $this->response->body(json_encode($response));
            return;
        }
        $result = $this->userValidation($requestUser, FALSE);
        if (is_bool($result)) {
            if ($this->getTableObj()->updateProfile(
                    $requestUser->userId, $updateRequest))
                $response = new \App\Response\V1\BaseResponse(
                        DTO\ErrorDto::prepareSuccessMessage(9));
            else
                $response = new \App\Response\V1\BaseResponse(
                        DTO\ErrorDto::prepareError(114));
        } else
            $response = $result;
        $this->response->body(json_encode($response));
    }

}
