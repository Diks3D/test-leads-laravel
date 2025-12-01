<?php

namespace App\Http\Requests\Api;

use Illuminate\Validation\Rule;
use App\Http\Requests\JsonRequest;

/**
 * Verification and validation form rules for buy coins action
 */
class TaskAddRequest extends JsonRequest
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
            'category_id' => ['integer', Rule::exists('categories', 'category_id')],
            'title'=> ['required', 'string', 'min:3', 'max:1024'],
            'content' => ['required', 'string', 'min:15', 'max:10000'],
            'expired_at' => ['date_format:Y-m-d\TH:i:sP'],
        ];
    }

}
