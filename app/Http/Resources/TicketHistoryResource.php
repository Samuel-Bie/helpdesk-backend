<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketHistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->image,
            'category' => [
                'id' => $this->category_id,
                'name' => $this->category->name,
            ],
            'status' => $this->status,
            'priority' => $this->priority,
            'feedback_notes' => $this->feedback_notes,
            'creator_user_id' => $this->creator_user_id,
            'messages' => MessageResource::collection($this->whenLoaded('messages')),
            'links' => [
                'self' => route('tickets.show', ['ticket' => $this->id]),
                'messages' => route('tickets.messages.index', ['ticket' => $this->id]),
            ],
        ];
    }
}
