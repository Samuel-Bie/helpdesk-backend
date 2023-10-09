<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Http\Controllers\Controller;
use App\Http\Resources\TicketResource;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Http\Resources\TicketResourceCollection;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::all();
        return new TicketResourceCollection($tickets);
    }



    public function store(StoreTicketRequest $request)
    {
        $ticket = new Ticket();
        $ticket->title = $request->input('title');
        $ticket->description = $request->input('description');
        $ticket->image = $request->input('image');
        $ticket->category_id = $request->input('category');
        $ticket->status = $request->input('status');
        $ticket->priority = $request->input('priority');
        $ticket->feedback_notes = $request->input('feedback_notes');
        $ticket->creator_user_id = $request->input('creator_user');
        $ticket->save();

        return response()->json(new TicketResource($ticket), 201);
    }

    public function show(Ticket $ticket)
    {
        return response()->json(new TicketResource($ticket), 200);
    }



    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        $ticket->title = $request->input('title');
        $ticket->description = $request->input('description');
        $ticket->image = $request->input('image');
        $ticket->category_id = $request->input('category');
        $ticket->status = $request->input('status');
        $ticket->priority = $request->input('priority');
        $ticket->feedback_notes = $request->input('feedback_notes');
        $ticket->creator_user_id = $request->input('creator_user');
        $ticket->save();

        return response()->json(new TicketResource($ticket), 202);
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return response()->json(null, 204);
    }
}
