<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->only([
            'price_from',
            'price_to',
            'beds',
            'baths',
            'area_from',
            'area_to',
        ]);

        return inertia('Listings/Index', [
            'filters' => $filters,
            'listings' => Listing::mostRecent()
                ->filter($filters)
                ->paginate(12)
                ->withQueryString()
        ]);
    }


    public function show(Listing $listing)
    {
        $listing->load(['images']);

        return inertia('Listings/Show', [
            'listing' => $listing
        ]);
    }
}
