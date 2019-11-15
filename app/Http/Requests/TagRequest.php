<?php

namespace App\Http\Requests;

use App\Eloquent\TagOrm;
use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
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
        $nameColumn = TagOrm::getNameColumn();

        return [
            'tag' => 'required|unique:tags,' . $nameColumn
        ];
    }
}
