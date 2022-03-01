<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Rules\ValidMobileNumber;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserFormRequest extends FormRequest
{

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ])
        );
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = User::VALIDATION_ROLE;

        if(request()->update_id){
            $rules['email'][2] = 'unique:users,email,'.request()->update_id;
            $rules['mobile_no'][2] = 'unique:users,mobile_no,'.request()->update_id;
        }

        $rules['mobile_no'][2] = new ValidMobileNumber;

        return $rules;
    }
}
