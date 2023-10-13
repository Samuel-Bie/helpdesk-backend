<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
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
            'content' => $this->content,
            'image' => $this->image,
            'ticket_id' => $this->ticket_id,
            'sender_user_id' => $this->sender_user_id,
            'full_user_info' => new UserResource($this->whenLoaded('user')),
            'created_at' => $this->created_at,
            'links' => [
                'self' => route('messages.show', ['message' => $this->id]),
                'ticket' => route('tickets.show', ['ticket' => $this->ticket_id]),
            ],
        ];
    }
}
