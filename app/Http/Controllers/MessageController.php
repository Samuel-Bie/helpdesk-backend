<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use App\Http\Resources\MessageResource;
use App\Http\Resources\MessageResourceCollection;
use App\Jobs\MessageSent;
use App\Models\Message;
use App\Models\Ticket;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = Message::all();

        return new MessageResourceCollection($messages);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMessageRequest $request, Ticket $ticket)
    {
        $message = new Message();

        $message->content = $request->input('content');
        $message->image = $request->input('image');
        $message->ticket()->associate($ticket);
        $message->sender()->associate($request->user());
        $message->save();

        // Dispatch the message sent job to The Queue Driver.

        $data = (new MessageResource($message))->toJson();

        MessageSent::dispatch($data);

        return response()->json(new MessageResource($message->setRelations([])), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        return new MessageResource($message->load('user'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        $message->delete();

        return response()->json(null, 204);
    }
}
