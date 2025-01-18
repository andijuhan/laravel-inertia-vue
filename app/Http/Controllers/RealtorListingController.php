<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RealtorListingController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('view-any', Listing::class);

        $filters = [
            'deleted' => $request->boolean('deleted'),
            ...$request->only(['by', 'order'])
        ];

        return inertia('Realtor/Index', [
            'listings' => $request->user()
                ->listings()
                ->filter($filters)
                ->withCount('images')
                ->paginate(12)
                ->withQueryString(),
            'filters' => $filters
        ]);
    }

    public function create()
    {
        Gate::authorize('create', Listing::class);

        return inertia('Realtor/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'beds' => 'required|integer|min:0|max:20',
            'baths' => 'required|integer|min:0|max:20',
            'area' => 'required|integer|min:0|max:1000',
            'city' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'street_number' => 'required|string|max:255',
            'price' => 'required|integer|min:0|max:1000000',
        ]);

        $request->user()->listings()->create($validatedData);

        return redirect()->route('realtor.listing.index')->with('success', 'Listing created.');
    }

    public function edit(Listing $listing)
    {
        Gate::authorize('update', $listing);

        return inertia('Realtor/Edit', [
            'listing' => $listing
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing)
    {
        $validatedData = $request->validate([
            'beds' => 'required|integer|min:0|max:20',
            'baths' => 'required|integer|min:0|max:20',
            'area' => 'required|integer|min:0|max:1000',
            'city' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'street_number' => 'required|string|max:255',
            'price' => 'required|integer|min:0|max:1000000',
        ]);

        $listing->update($validatedData);

        return redirect()->route('realtor.listing.index')->with('success', 'Listing updated.');
    }

    public function destroy(Listing $listing)
    {
        if ($listing->trashed()) {
            $listing->forceDelete();

            return redirect()->back()->with('success', 'Listing deleted permanently.');
        }

        $listing->deleteOrFail();

        return redirect()->back()->with('success', 'Listing deleted.');
    }

    public function restore(Listing $listing)
    {
        $listing->restore();

        return redirect()->back()->with('success', 'Listing was restored.');
    }
}
