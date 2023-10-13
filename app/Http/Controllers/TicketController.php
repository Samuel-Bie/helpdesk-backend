<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Http\Controllers\Controller;
use App\Http\Resources\TicketResource;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\TicketFilterRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Http\Resources\TicketHistoryResource;
use App\Http\Requests\UpdateTicketStatusRequest;
use App\Http\Resources\TicketResourceCollection;

class TicketController extends Controller
{
    public function index(TicketFilterRequest  $request)
    {
        // Validation has passed, you can access the validated data
        $validatedData = $request->validated();

        // Build your query based on the validated data
        $query = Ticket::query();

        if (isset($validatedData['status'])) {
            $query->where('status', $validatedData['status']);
        }

        if (isset($validatedData['priority'])) {
            $query->where('priority', $validatedData['priority']);
        }

        if (isset($validatedData['category_id'])) {
            $query->where('category_id', $validatedData['category_id']);
        }

        if ($request->user()->is_employee) {
            // Execute the query
            $tickets = $query->get();
        } else {
            $tickets = $query
                ->where('creator_user_id', $request->user()->id)
                ->get();
        }

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
        $ticket->creator_user_id = $request->user()->id;
        $ticket->save();

        return response()->json(new TicketResource($ticket), 201);
    }

    public function show(Ticket $ticket)
    {
        if (request()->user()->is_employee || $ticket->user->id == request()->user()->id) {
            return response()->json(new TicketResource($ticket), 200);
        } else {
            throw new \Exception("You are not authorized to view this ticket", 403);
        }
    }



    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        if (request()->user()->is_employee || $ticket->user->id == request()->user()->id) {
            $ticket->title = $request->input('title');
            $ticket->description = $request->input('description');
            $ticket->image = $request->input('image');
            $ticket->category_id = $request->input('category');
            $ticket->status = $request->input('status');
            $ticket->priority = $request->input('priority');
            $ticket->feedback_notes = $request->input('feedback_notes');
            $ticket->save();

            return response()->json(new TicketResource($ticket), 202);
        } else {
            throw new \Exception("You are not authorized to update this ticket", 403);
        }
    }

    public function status(UpdateTicketStatusRequest $request, Ticket $ticket)
    {
        if (request()->user()->is_employee || $ticket->user->id == request()->user()->id) {
            $ticket->status = $request->input('status');
            $ticket->save();
            return response()->json(new TicketResource($ticket), 202);
        } else {
            throw new \Exception("You are not authorized to update this ticket", 403);
        }
    }

    public function history(Ticket $ticket)
    {
        if (request()->user()->is_employee || $ticket->user->id == request()->user()->id) {
            $ticket->load('messages.user');
            return response()->json(new TicketHistoryResource($ticket), 200);
        } else {
            throw new \Exception("You are not authorized to view this ticket", 403);
        }
    }

    public function destroy(Ticket $ticket)
    {
        if (request()->user()->is_employee || $ticket->user->id == request()->user()->id) {
            $ticket->delete();
            return response()->json(null, 204);
        } else {
            throw new \Exception("You are not authorized to view this ticket", 403);
        }
    }
}
