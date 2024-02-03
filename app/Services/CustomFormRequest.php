<?php


namespace App\Services;


use App\Traits\Api\Request\RequestSanitizer;
use App\Traits\Api\Request\RequestValidationErrorResponse;
use Illuminate\Foundation\Http\FormRequest;

class CustomFormRequest extends FormRequest
{
    use RequestSanitizer , RequestValidationErrorResponse;
}
