<?php

namespace App\Http\Controllers;

use App\Models\Bicycle;
use App\Models\Customer;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {
        return view('search.index');
    }

    public function search(Request $request)
    {
        $query  = trim($request->get('query', ''));
        $type   = $request->get('type', 'all');
        $results = collect();

        if ($query !== '') {
            $bicycleQuery = Bicycle::with(['customer', 'latestService']);

            if ($type === 'serial') {
                $bicycleQuery->where('serial_number', 'like', "%{$query}%");
            } elseif ($type === 'bicycle_number') {
                $bicycleQuery->where('bicycle_number', 'like', "%{$query}%");
            } elseif ($type === 'phone') {
                $bicycleQuery->whereHas('customer', function ($q) use ($query) {
                    $q->where('phone', 'like', "%{$query}%");
                });
            } else {
                // search all
                $bicycleQuery->where(function ($q) use ($query) {
                    $q->where('serial_number', 'like', "%{$query}%")
                      ->orWhere('bicycle_number', 'like', "%{$query}%")
                      ->orWhereHas('customer', function ($cq) use ($query) {
                          $cq->where('phone', 'like', "%{$query}%")
                             ->orWhere('name', 'like', "%{$query}%");
                      });
                });
            }

            $results = $bicycleQuery->get();
        }

        return view('search.index', compact('results', 'query', 'type'));
    }
}
