<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public static function index()
    {
        $listings = Listing::all();
        return response()->view('cms.listing.index', compact('listings'));
    }
    public static function show($id)
    {
        $listing = Listing::findOrFail($id);
        return response()->view('cms.listing.show', compact('listing'));
    }
}
