<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gift;
use App\Models\Filter;
use App\Http\Resources\GiftResource;

class GiftController extends Controller
{
    //

    public function getGiftByFilter($filter)
        {
            $filter = Filter::where('id',$filter)->first();
            return response()->json(['preference' => $filter->name,
                                     'giftlList' => GiftResource::collection($filter->gifts)
                                      ->additional(['status'=>200])],200);
        }

}
