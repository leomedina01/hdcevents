<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class StoreEventRequest extends FormRequest
{

    /**
    * Get custom attributes for validator errors.
    *
    * @return array
    */
    public function attributes()
    {
        return [
            'title' => 'event title',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'items.required' => 'Please select at least one infrastructure item',
        ];
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
        
        $rules = [
            'title' => 'required|string|max:255|unique:events',
            'city' => 'required|max:255',
            'private' => 'required|integer|min:0|max:1',
            'description' => 'required|max:1000',
            'image' => 'required|image',
            'date' => 'required|date',
            'items' => 'required'
        ];

        // Ref: https://stackoverflow.com/questions/61543013/laravel-form-request-validation-on-store-and-update-use-same-validation
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            //$eventId = $this->route()->parameter('id');
            $eventId = $this->id;

            $rules['title'] = [
                'required',
                'string',
                'max:255',
                Rule::unique('events')->ignore($eventId)
            ];

            $rules['image'] = 'image';
        }

        return $rules;
    }
}
