<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CreateRequest extends FormRequest
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
        // dd($this->all());
        return [
            'name' => [
                'required',
                Rule::unique('products', 'name')->where(function ($query) {
                    return $query->where('store_id', $this->store->id);
                })
            ],
            'categories' => 'required|array',
            'price' => 'required|integer',
            'description' => 'required',
            'thumbnail' => 'required|image|dimensions:ratio=1/1',
            'is_active' => 'required|in:0,1',
            'images' => 'required|array'
        ];
    }

    public function validated()
    {
        $path = $this->file('thumbnail')->store('products/thumbnail', 's3');

        return [
            'store_id' => $this->store->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'thumbnail' => $path,
        ];
    }
}
