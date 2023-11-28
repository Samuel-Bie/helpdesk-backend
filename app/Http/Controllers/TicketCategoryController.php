<?php

namespace App\Http\Controllers;

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
            'data' => TicketCategory::all(),
        ]);
    }
}
