<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserMasterStore extends FormRequest
{
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
        return [
            "um_first_name"=>"required|max:100",
            "um_last_name"=>"max:100",
            "um_mobile"=>"required|min:10|max:10",
            "um_email"=>"required|email|unique:user_master",
            "um_password"=>"required|min:5|max:100",
            "um_status"=>"required|in:A,I",
            "um_gender"=>"required|in:M,F,O",
            "um_user_type"=>"required|in:A,MA,U",
            "um_designation"=>"required|max:255"
            
        ];
    }
}
