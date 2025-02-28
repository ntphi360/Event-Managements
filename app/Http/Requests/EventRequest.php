<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $isUpdate = $this->isMethod('put') || $this->isMethod('patch');
        
        return [
            'name'        => $isUpdate ? ['sometimes', 'string', 'max:255'] : ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'start_time'  => $isUpdate ? ['sometimes', 'date'] : ['required', 'date'],
            'end_time'    => $isUpdate ? ['sometimes', 'date', 'after:start_time'] : ['required', 'date', 'after:start_time'],
            
        ];  
    }
}