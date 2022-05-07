<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\AddonResource;
use App\Models\Addon;
use Illuminate\Http\Request;

class AddonController extends Controller
{
    public function index() {
        $addons = Addon::all();

        return ResponseHelper::make(
            AddonResource::collection($addons)
        );
    }
}
