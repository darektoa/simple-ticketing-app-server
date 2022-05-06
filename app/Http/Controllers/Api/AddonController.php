<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\AddonResource;
use App\Models\Destination;
use Illuminate\Http\Request;

class AddonController extends Controller
{
    public function index() {
        $destinations = Destination::all();

        return ResponseHelper::make(
            AddonResource::collection($destinations)
        );
    }
}
