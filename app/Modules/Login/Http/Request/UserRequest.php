<?php


namespace App\Modules\Login\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest {
    public function rules(): array {
        return [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ];
    }

    public function authorize(): bool {
        return true;
    }
}
