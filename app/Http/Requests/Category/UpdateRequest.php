<?php

namespace App\Http\Requests\Category;

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
            'title' => [
                'required', Rule::unique('categories', 'title')->where(function ($query) {
                    return $query->where('store_id', $this->store->id);
                })->ignore($this->category->id)
            ],
            'parent_id' => [
                'nullable', Rule::exists('categories', 'id')->where(function ($query) {
                    return $query->whereNull('parent_id')
                        ->where('store_id', $this->store->id);
                })
            ],
            'description' => 'required',
            'is_active' => 'nullable',
        ];
    }
}
