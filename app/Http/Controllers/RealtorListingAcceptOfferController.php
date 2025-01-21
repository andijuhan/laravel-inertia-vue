<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RealtorListingAcceptOfferController extends Controller
{
    public function __invoke(Offer $offer)
    {
        $listing = $offer->listing;
        Gate::authorize('update', $listing);
        //Accept selected offer
        $offer->update([
            'accepted_at' => now()
        ]);

        $listing->update([
            'sold_at' => now()
        ]);

        //reject all other offer
        $listing->offers()
            ->except($offer)
            ->update([
                'rejected_at' => now()
            ]);

        return redirect()->back()->with('success', 'Offer accepted.');
    }
}
