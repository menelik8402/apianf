<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Filter;
use App\Http\Resources\FilterResource;

class FilterController extends Controller
{
    public function index()
    {
        $filters = Filter::all();
        return response()->json(['preferenceList' => FilterResource::collection($filters)
                                                     ->additional(['status'=>200])],200);
    }


}
