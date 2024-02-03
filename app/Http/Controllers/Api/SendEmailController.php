<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Jobs\SendEmail;
use App\Http\Controllers\Controller;
use App\Traits\Api\ApiResponseTrait;

class SendEmailController extends Controller
{
    use ApiResponseTrait;

    /**
     * send email to all users. 
     */
    public function sendEmail(){
        $users = User::get()->pluck('email');
        
        $subject = "Notify Subject";
        $body = "Hello, How are you? I hope you are well.";
        foreach ($users as $user => $email) {
            dispatch(new SendEmail($email, $subject, $body));
        }
        
        return $this->apiResponse(null, trans('The email was sent to all users successfully'), 200);

    }
}
