<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Property;
use App\Models\User;
use Illuminate\Support\Facades\File;
class PropertyController extends Controller
{
    /**
     * Post a new property.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postProperty(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'lat' => 'nullable|numeric',
            'lng' => 'nullable|numeric',
            'type' => 'required|in:house,building,apartment',
            'type_of_rent' => 'required|in:sell,rent',
            'bedrooms' => 'nullable|integer',
            'bathrooms' => 'nullable|integer',
            'parking_spaces' => 'nullable|integer',
            'square_footage' => 'nullable|integer',
            'furnishing' => 'nullable|string|max:255',
            'flooring' => 'nullable|string|max:255',
            'water_supply' => 'nullable|string|max:255',
            'amenities' => 'nullable|string',
            'price' => 'required|numeric',
            'currency' => 'nullable|string|max:255',
            'payment_frequency' => 'nullable|string|max:255',
            'photos.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:9216',
            'videos' => 'nullable|array',
            'virtual_tour' => 'nullable|string|max:255',
            'additional_information' => 'nullable|string',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $user = User::find($request->user_id);
    
        Cache::put('new_property_available', true, 1440);
    
        $imagePaths = [];
    
        if ($request->hasFile('photos')) {
            $directoryPath = public_path('property_images');
            if (!File::exists($directoryPath)) {
                File::makeDirectory($directoryPath, 0755, true);
            }
    
            foreach ($request->file('photos') as $photo) {
                $validator = Validator::make(['photo' => $photo], [
                    'photo' => 'image|mimes:jpeg,png,jpg,gif|max:8048',
                ]);
    
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
    
                $imageName = uniqid('property_image_') . '.' . $photo->getClientOriginalExtension();
                $photo->move($directoryPath, $imageName);
                $imagePaths[] = 'property_images/' . $imageName;
            }
        }
    
        $propertyData = $request->except('photos');
        $propertyData['photos'] = json_encode($imagePaths);
    
        $property = Property::create($propertyData);
    
       
        return redirect()->back()->with('success', 'Property added successfully!');


        
    }
    
    /**
     * Get the list of all properties.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function getList()
    {
        $properties = Property::all();

        $properties->each(function($property) {
            if (is_string($property->photos)) {
                $property->photos = json_decode($property->photos, true);
            }
            $property->photos = (array) $property->photos;
        });

        return view('list', compact('properties'));
    }

    public function newindex()
    {
        $properties = Property::all();

        $properties->each(function($property) {
            if (is_string($property->photos)) {
                $property->photos = json_decode($property->photos, true);
            }
        });

        Log::info($properties);

        return view('newindex', compact('properties'));
    }

    /**
     * Show the portfolio for a specific property.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function showPortfolio($id)
    {
        $property = Property::find($id);
        
        if (is_string($property->photos)) {
            $property->photos = json_decode($property->photos, true);
        }

        return view('portofilio', compact('property'));
    }

    public function editProperty($id)
    {
        $property = Property::find($id);
        
        if (is_string($property->photos)) {
            $property->photos = json_decode($property->photos, true);
        }
    
        return view('agent.edit-property', compact('property'));
    }

   

    public function edit($id)
    {
        $property = Property::findOrFail($id);
        return view('agent.edit-property', compact('property'));
    }
    
    public function search(Request $request)
    {
        $query = $request->input('q');
        $properties = Property::where('title', 'LIKE', "%{$query}%")
            ->orWhere('location', 'LIKE', "%{$query}%")
            ->get();

        $properties->each(function($property) {
            if (is_string($property->photos)) {
                $property->photos = json_decode($property->photos, true);
            }
            $property->photos = (array) $property->photos;
        });

        return view('list', compact('properties'));
    }

    public function adminPropertyList()
    {
        $properties = Property::all();

        $properties->each(function($property) {
            if (is_string($property->photos)) {
                $property->photos = json_decode($property->photos, true);
            }
            $property->photos = (array) $property->photos;
        });

        return view('agent.admin-property-list', compact('properties'));
    }

    public function removeImage(Request $request, $propertyId)
    {
        $property = Property::findOrFail($propertyId);
        $photos = json_decode($property->photos, true);
    
        $photoPath = $request->input('photo_path');
        if (($key = array_search($photoPath, $photos)) !== false) {
            unset($photos[$key]);
        }
    
        $property->photos = json_encode(array_values($photos));
        $property->save();
    
        // Delete the actual file if needed
        if (file_exists(public_path($photoPath))) {
            unlink(public_path($photoPath));
        }
    
        // Redirect back to the edit page with a success message
        return redirect()->route('property.edit', $propertyId)
                         ->with('success', 'Image removed successfully.');
    }
    

    

    public function update(Request $request, $id)
    {
        $property = Property::find($id);
    
        if (!$property) {
            return redirect()->back()->with('error', 'Property not found.');
        }
    
        // Validate the request
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'type' => 'required|in:house,property,apartment',
            'type_of_rent' => 'required|in:sell,rent',
            'bedrooms' => 'required|integer|min:0',
            'bathrooms' => 'required|integer|min:0',
            'square_footage' => 'required|numeric|min:0',
            'parking_spaces' => 'required|integer|min:0',
            'flooring' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'photos.*' => 'nullable|image|mimes:jpg,jpeg,png|max:9216', // Use the same validation as postProperty
            'removed_photos.*' => 'nullable|string',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Update property details
        $property->title = $request->input('title');
        $property->location = $request->input('location');
        $property->type = $request->input('type');
        $property->type_of_rent = $request->input('type_of_rent');
        $property->bedrooms = $request->input('bedrooms');
        $property->bathrooms = $request->input('bathrooms');
        $property->square_footage = $request->input('square_footage');
        $property->parking_spaces = $request->input('parking_spaces');
        $property->flooring = $request->input('flooring');
        $property->price = $request->input('price');
        $property->description = $request->input('description');
    
        // Handle removed images
        $existingPhotos = json_decode($property->photos, true) ?? [];
        $removedPhotos = $request->input('removed_photos', []);
        
        foreach ($removedPhotos as $removedPhoto) {
            if (($key = array_search($removedPhoto, $existingPhotos)) !== false) {
                unset($existingPhotos[$key]);
                Storage::disk('public')->delete($removedPhoto);
            }
        }
    
        // Handle new images
        $newPhotos = [];
        if ($request->hasFile('photos')) {
            $directoryPath = public_path('property_images');
            if (!File::exists($directoryPath)) {
                File::makeDirectory($directoryPath, 0755, true);
            }
    
            foreach ($request->file('photos') as $photo) {
                $validator = Validator::make(['photo' => $photo], [
                    'photo' => 'image|mimes:jpeg,png,jpg,gif|max:8048',
                ]);
    
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
    
                $imageName = uniqid('property_image_') . '.' . $photo->getClientOriginalExtension();
                $photo->move($directoryPath, $imageName);
                $newPhotos[] = 'property_images/' . $imageName;
            }
        }
    
        // Merge existing and new photos
        $allPhotos = array_merge($existingPhotos, $newPhotos);
        $property->photos = json_encode($allPhotos);
    
        // Save the updated property
        $property->save();
    
        return redirect()->route('property.edit', $property->id)->with('success', 'Property updated successfully.');
    }
    
    

    

}
