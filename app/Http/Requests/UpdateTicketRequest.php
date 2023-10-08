<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,gif',
            'category_id' => 'required|exists:ticket_categories,id',
            'status' => 'required|in:open,closed,in progress,on hold',
            'priority' => 'required|in:high,medium,low',
            'feedback_notes' => 'nullable|string',
            'creator_user_id' => 'nullable|exists:users,id',
        ];
    }
}
