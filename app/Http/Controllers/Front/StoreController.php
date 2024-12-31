<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class StoreController extends Controller
{
    public function home()
    {
        return view('front.index');
    }

    public function allListings()
    {
        if (auth()->check()) {
            $listings = Listing::where('user_id', auth()->id())->latest()->filter(request(['tag', 'search']))->paginate(6);
            return view('front.listings', compact('listings'));
        } else {
            $listings = Listing::latest()->filter(request(['tag', 'search']))->paginate(6);
            return view('front.listings', compact('listings'));
        }
    }

    public function showCreate()
    {
        return view('front.create');
    }
    public function storeListing(Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);

        return redirect('/store/home')->with('message', 'Listing created successfully!');
    }

    public function showEdit($id)
    {
        $listing = Listing::find($id);
        if ($listing) {
            return view('front.edit', compact('listing'));
        } else {
            abort('404');
        }
    }

    public function updateListing(Request $request, $id)
    {
        $listing = Listing::findOrFail($id);
        // Make sure logged in user is owner
        if ($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);

        return back()->with('message', 'Listing updated successfully!');
    }

    public function showManage()
    {
        $listings = Auth()->user()->listings()->get();
        return view('front.manage', compact('listings'));
    }

    public function showDetailes($id)
    {
        $listing = Listing::find($id);
        if ($listing) {
            return view('front.show', compact('listing'));
        } else {
            abort('404');
        }
    }

    public function destroy($id)
    {
        $listing = Listing::findOrFail($id);
        // Make sure logged in user is owner
        if ($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        if ($listing->logo && Storage::disk('public')->exists($listing->logo)) {
            Storage::disk('public')->delete($listing->logo);
        }
        $listing->delete();
        return redirect('/store/home')->with('message', 'Listing deleted successfully');
    }
}
