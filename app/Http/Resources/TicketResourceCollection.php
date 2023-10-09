<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\TicketResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TicketResourceCollection extends ResourceCollection
{
    public $collects = TicketResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
