<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title'       => 'required',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id,deleted_at,NULL',
            'tags'        => 'required',
            'tags.*'      => 'exists:tags,id,deleted_at,NULL',
            'post'        => 'required',
            'published'   => 'required|in:0,1',
        ];
    }
}
