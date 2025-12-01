<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\JsonRequest;
use Illuminate\Validation\Rule;
use App\Enums\TaskStatusEnum;

/**
 * Verification and validation form rules for buy coins action
 */
class TaskEditRequest extends JsonRequest
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
            'content' => ['required', 'string', 'min:15', 'max:10000'],
            'status' => ['required', 'string', 'alpha:ascii', Rule::enum(TaskStatusEnum::class)],
            'expired_at' => ['date_format:Y-m-d\TH:i:sP'],
        ];
    }

    /**
     * Получить сообщения об ошибках для определенных правил валидации.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'json_content.json' => 'Request body must be a valid JSON string.',
        ];
    }
}
