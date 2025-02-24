<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\ListingImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class RealtorListingImageController extends Controller
{
    public function create(Listing $listing)
    {
        $listing->load(['images']);

        return inertia('Realtor/ListingImage/Create', [
            'listing' => $listing
        ]);
    }

    public function store(Request $request, Listing $listing)
    {
        if ($request->hasFile('images')) {
            $request->validate([
                'images.*' => 'mimes:png,jpg,jpeg|max:5000'
            ], [
                'images.*.mimes' => 'The images must be a file of type: png, jpg, jpeg.',
            ]);

            foreach ($request->file('images') as $image) {
                $path = $image->store('images', 'public');

                $listing->images()->create([
                    'filename' => $path
                ]);
            }
        }

        return redirect()->back()->with('success', 'Images uploaded.');
    }

    public function destroy($listing, ListingImage $image)
    {
        Storage::disk('public')->delete($image->filename);
        $image->deleteOrFail();

        return redirect()->back()->with('success', 'Image deleted.');
    }
}
