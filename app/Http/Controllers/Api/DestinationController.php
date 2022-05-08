<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\DestinationResource;
use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index() {
        $destinations = Destination::all();

        return ResponseHelper::make(
            DestinationResource::collection($destinations)
        );
    }
}
