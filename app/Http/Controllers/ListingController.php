<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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
                ->withoutSold()
                ->paginate(12)
                ->withQueryString()
        ]);
    }


    public function show(Listing $listing)
    {
        Gate::authorize('view', $listing);
        $listing->load(['images']);
        $offer = !Auth::user() ? null : $listing->offers()->byMe()->first();

        return inertia('Listings/Show', [
            'listing' => $listing,
            'offerMade' => $offer
        ]);
    }
}
