<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Offer;
use Illuminate\Http\Request;

class ListingOfferController extends Controller
{
    public function store(Listing $listing, Request $request)
    {
        $validate = $request->validate([
            'amount' => 'required|integer|min:0|max:10000000'
        ]);

        $listing->offers()->save(
            Offer::query()->make($validate)
                ->user()
                ->associate($request->user())
        );

        return redirect()->back()->with('success', 'Offer created.');
    }
}
