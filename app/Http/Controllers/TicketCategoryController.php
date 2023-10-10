<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketCategoryRequest;
use App\Http\Requests\UpdateTicketCategoryRequest;
use App\Models\TicketCategory;

class TicketCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        TicketCategory::all();

        return response()->json([
            'data' => TicketCategory::all()
        ]);
    }
}
