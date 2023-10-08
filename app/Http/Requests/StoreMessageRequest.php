<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'content' => 'required|string', // Adjust the validation rules as needed
            'image' => 'nullable|image|mimes:jpeg,png,gif', // Example validation for image upload
            'ticket_id' => 'required|exists:tickets,id', // Ensure the ticket exists
            'sender_user_id' => 'required|exists:users,id', // Ensure the sender user exists
        ];
    }
}
