<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Message;
use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Http\Resources\MessageResourceCollection;

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
        $message->sender()->associate($request->user()) ;
        $message->save();

        return response()->json(new MessageResource($message), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        return new MessageResource($message);
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
