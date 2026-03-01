<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Bicycle;
use App\Models\ServiceHistory;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $stats = [
            'customers'       => Customer::count(),
            'bicycles'        => Bicycle::count(),
            'total_services'  => ServiceHistory::count(),
            'pending'         => ServiceHistory::where('status', 'pending')->count(),
            'in_progress'     => ServiceHistory::where('status', 'in_progress')->count(),
            'completed'       => ServiceHistory::where('status', 'completed')->count(),
        ];

        $recentServices = ServiceHistory::with('bicycle.customer')
            ->latest('service_date')
            ->take(8)
            ->get();

        return view('home', [
            'user'           => Auth::user(),
            'stats'          => $stats,
            'recentServices' => $recentServices,
        ]);
    }
}

