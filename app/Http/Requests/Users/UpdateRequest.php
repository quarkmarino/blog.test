<?php

namespace App\Http\Requests\Users;

use App\Enums\UserTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
            'first_name' => 'required|between:3,255',
            'last_name' => 'required|between:3,255',
            'email' => 'required|email',
            'user_type' => [
                'sometimes',
                Rule::in(UserTypeEnum::options())
            ],
            'supervisors' => 'array|required_if:user_type,' . UserTypeEnum::BLOGGER,
            'supervisors.*' => [
                'integer',
                Rule::exists('users', 'id')->where(function ($users) {
                    $users->where('user_type', '=', UserTypeEnum::SUPERVISOR);
                })
            ],
        ];
    }
}
