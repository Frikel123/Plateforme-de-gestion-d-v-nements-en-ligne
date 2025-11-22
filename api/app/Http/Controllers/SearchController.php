<?php

namespace App\Http\Controllers;


use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\EventCategory;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {



        $category = $request->category;
        $searchValue = $request->search;

        $data = [];

        switch ($category) {
            case 'Events':
                $data = Event::where('name', 'like', '%' . $searchValue . '%')->get();
                break;
            case 'EventCategory':
                $data = EventCategory::with('groupe')->where('name', 'like', '%' . $searchValue . '%')->get();
                break;
            default:
                return response()->json([
                    'message' => "Invalid category",
                    'data' => []
                ], 400);
        }

        return response()->json([
            'message' => "Search results for $category",
            'data' => $data
        ], 200);
    }
}
