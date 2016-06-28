<?php

namespace CodeCommerce\Http\Requests;

class ProductRequest extends Request
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
            'category_id' => 'required|regex:/[1-9]+/|exists:categories,id',
            'name' => 'required|min:3',
            'description' => 'required',
            'price' => 'required|numeric',
            'featured' => 'boolean',
            'recommend' => 'boolean',
        ];
    }
}
