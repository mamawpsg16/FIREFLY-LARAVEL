<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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

        // $post = $this->route('post'); // Retrieve the post ID from the route

        return [
            'title' => [
                'required',
                Rule::unique('posts')->ignore($this->post->id),
                'max:255'
            ],
            'description'  => 'required',
            'is_published' => 'sometimes',
            'tags' => ['required']

        ];
    }
}
