<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class ListingController extends Controller
{
    // SHOW ALL LISTINGS
    public function index() {
        
        return view('listings.index', [
            'listings'=> Listing::latest()->filter(request(['tag', 'search']))->paginate(6)
        ]);
    }

    // Show create form
    public function create(){
        return view('listings.create');
    }

    // Store form information
    public function store(Request $request){
        $formFields = $request->validate([
            'title'=> 'required',
            'company'=> ['required', Rule::unique('listings', 'company')],
            'location'=> 'required',
            'website' => 'required',
            'email'=> ['required', 'email'],
            'tags' => 'required',
            'description' => 'required',
        ]);

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();
       
        $listing = Listing::create($formFields);

        
        if($request->hasFile('image')){
            $images['image'] = $request->file('image')->store('pictures', 'public');
            $images['listing_id'] = $listing->id;
            Image::create($images);
        }

        return redirect('/')->with('message', 'Listing created successfully!');
        
    }

    // SHOW SINGLE LISTING
    public function show(Listing $listing){
        // $images = $listing->images;
        
        return view('listings.show', [
            'listing'=> $listing
        ]);
    }

    // Show edit form
    public function edit(Listing $listing){

        return view('listings.edit', [
            'listing' =>$listing
        ]);
    }

    // Update listing info on database/process edit form
    public function update(Request $request, Listing $listing){
        // Make sure logged in user is owner
        if($listing->user_id != auth()->id()){
            abort(403, 'Unauthorized Action');
        }
        $formFields = $request->validate([
            'title'=> 'required',
            'company'=> ['required'],
            'location'=> 'required',
            'website' => 'required',
            'email'=> ['required', 'email'],
            'tags' => 'required',
            'description' => 'required',
        ]);

        if($request->hasFile('logo')){
            if($listing->logo != Null){           
                Storage::disk('public')->delete($listing->logo);            
            }
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);

        return back()->with('message', 'Listing updated successfully!');
    }

// DELETE listing
    public function destroy(Listing $listing){
        if($listing->user_id != auth()->id()){
            abort(403, 'Unauthorized Action');
        }
        if($listing->logo != Null){           
            Storage::disk('public')->delete($listing->logo);            
        }
        $listing->delete();

        return redirect('/')->with('message', 'Listing was deleted!');
    }

    // Manage listings
    public function manage(){
        return view('listings.manage', [
            'listings'=> auth()->user()->listings()->get()
        ]);
    }

    
}
