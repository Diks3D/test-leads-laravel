<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class JsonRequest extends FormRequest
{
    
    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'json_content' => $this->getContent(),
        ]);
    }

    /**
     * The data to be validated should be processed as JSON.
     * @return mixed
     */
    public function validationData()
    {
        $jsonData = $this->json()->all();
        return $jsonData;
    }

    /**
     * Get error messages for empty json validation rule
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
