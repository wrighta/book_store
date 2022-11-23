<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
         return [
            'title' => ['required'],
            'category' =>['required'],
            'description'  =>['required'],
            'book_image'  =>['required'],
            'likes'  =>['required'],
            'publisher_id' =>['required'],
            // 'authors'is an array coming in from the request.
            // Laravel is clever enough to traverse through each element in the authors array
           //  and check if it exists as an id in the authors table
            'authors' =>['required' , 'exists:authors,id']
        ];
    }
}
