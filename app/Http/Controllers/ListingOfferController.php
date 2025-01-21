<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Offer;
use App\Notifications\OfferMade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ListingOfferController extends Controller
{
    public function store(Listing $listing, Request $request)
    {
        Gate::authorize('view', $listing);
        $validate = $request->validate([
            'amount' => 'required|integer|min:0|max:10000000'
        ]);

        $offer = $listing->offers()->save(
            Offer::query()->make($validate)
                ->user()
                ->associate($request->user())
        );

        $listing->owner->notify(new OfferMade($offer));

        return redirect()->back()->with('success', 'Offer created.');
    }
}
