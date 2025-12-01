<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\JsonRequest;

/**
 * Verification and validation form rules for buy coins action
 */
class CategoryRequest extends JsonRequest
{

    protected $stopOnFirstFailure = true;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'json_content' => ['required', 'json',],
            'title'=> ['required', 'string', 'min:3', 'max:1024'],
        ];
    }

}
