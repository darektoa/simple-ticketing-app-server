<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\TransactionDestination;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $destinations = TransactionDestination::with(['destination' => fn($query) => $query->select('id', 'name')])
            ->selectRaw('destination_id, COUNT(*) AS total')
            ->groupBy('destination_id')
            ->get();

        return view('pages.all.dashboard.index', compact('destinations'));
    }
}
