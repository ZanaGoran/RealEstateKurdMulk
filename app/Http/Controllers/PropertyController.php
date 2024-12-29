<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;
class PropertyController extends Controller
{

      /**
     * Convert a DMS coordinate to decimal.
     *
     * @param string $coordinate
     * @return float|null
     */
    function dmsToDecimal($coordinate) {
        $pattern = '/(\d{1,2})°(\d{1,2})\'(\d{1,2}\.\d+)"?([NSEW])/';
        if (preg_match($pattern, $coordinate, $matches)) {
            $degrees = $matches[1];
            $minutes = $matches[2];
            $seconds = $matches[3];
            $direction = $matches[4];

            // Convert DMS to decimal
            $decimal = $degrees + ($minutes / 60) + ($seconds / 3600);

            // Apply negative for South and West directions
            if ($direction == 'S' || $direction == 'W') {
                $decimal *= -1;
            }

            return $decimal;
        }

        return null;
    }


    public function postProperty(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'lat' => 'nullable|numeric',
            'lng' => 'nullable|numeric',
            'property_type' => 'required|in:house,building,apartment',
            'listing_type' => 'required|in:sell,rent',
            'bedrooms' => 'nullable|integer',
            'bathrooms' => 'nullable|integer',
            'address' => 'nullable|string|max:255',
            'area' => 'nullable|integer',
            'furnishing' => 'nullable|string|max:255',
            'flooring' => 'nullable|string|max:255',
            'water_supply' => 'nullable|string|max:255',
            'amenities' => 'nullable|string',
            'price' => 'required|numeric',
            'currency' => 'nullable|string|max:255',
            'payment_frequency' => 'nullable|string|max:255',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:9216',
            'videos' => 'nullable|array',
            'virtual_tour' => 'nullable|string|max:255',
            'additional_information' => 'nullable|string',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Handle location parsing
        $locationInput = $request->input('location');
        $lat = $lng = null;
        if (preg_match('/@(-?\d+\.\d+),(-?\d+\.\d+)/', $locationInput, $matches)) {
            $lat = $matches[1];
            $lng = $matches[2];
        } else {
            $coordinates = preg_split('/[ ,]+/', $locationInput);
            if (count($coordinates) == 2) {
                $lat = $this->dmsToDecimal($coordinates[0]);
                $lng = $this->dmsToDecimal($coordinates[1]);
            }
        }

        if ($lat === null || $lng === null) {
            return redirect()->back()->withErrors(['location' => 'Invalid location format. Please enter a valid Google Maps link or DMS coordinates.'])->withInput();
        }

        // Image upload
        $userId = auth()->id();
        Cache::put('new_property_available', true, 1440);
        $imagePaths = [];

        if ($request->hasFile('images')) {
            $directoryPath = public_path('property_images');
            if (!File::exists($directoryPath)) {
                File::makeDirectory($directoryPath, 0755, true);
            }

            foreach ($request->file('images') as $photo) {
                $imageName = uniqid('property_image_') . '.' . $photo->getClientOriginalExtension();
                $photo->move($directoryPath, $imageName);
                $imagePaths[] = 'property_images/' . $imageName;
            }
        }

        // Property creation
        $propertyData = $request->except('images', 'location');
        $propertyData['user_id'] = $userId;
        $propertyData['images'] = json_encode($imagePaths);
        $propertyData['location'] = json_encode(['lat' => $lat, 'lng' => $lng]);

        $property = Property::create($propertyData);
    
        // Redirect to the portfolio page for the newly created property
        return redirect()->route('property.PropertyDetail', ['property_id' => $property->property_id])->with('success', 'Property added successfully!');

    }
    

    public function getList() {
        $properties = Property::all(); // Fetch all properties
        
        $properties->each(function ($property) {
            $property->images = is_string($property->images) ? json_decode($property->images, true) : $property->images;
        });
    
        return view('list', compact('properties')); // Pass the properties to the view
    }
    
    
    
    
    

 
    


    public function showPortfolio($id)
    {
        $property = Property::find($id);
        
        if (!$property) {
            return redirect()->back()->with('error', 'Property not found.');
        }
    
        // Decode images and location if they are stored as JSON strings
        $property->images = is_string($property->images) ? json_decode($property->images, true) : $property->images;
        $property->location = is_string($property->location) ? json_decode($property->location, true) : $property->location;
    
        // Return the PropertyDetail view with the property data
        return view('PropertyDetail', compact('property'));
    }
    
    

   
    
    

    public function search(Request $request)
    {
        $query = $request->input('q');
        $properties = Property::where('title', 'LIKE', "%{$query}%")
            ->orWhere('location', 'LIKE', "%{$query}%")
            ->get();

        $properties->each(function ($property) {
            $property->images = is_string($property->images) ? json_decode($property->images, true) : (array)$property->images;
        });

        return view('list', compact('properties'));
    }

    
 // PropertyController.php

public function removeImage(Request $request, $property_id)
{
    // Find the property
    $property = Property::where('property_id', $property_id)->firstOrFail();

    // Decode existing images from JSON
    $images = is_string($property->images) ? json_decode($property->images, true) : $property->images;

    // Get the photo path from the request
    $photoPath = $request->input('photo_path');

    // Check if the photo path exists in the images array
    if (($key = array_search($photoPath, $images)) !== false) {
        // Remove the image from the array
        unset($images[$key]);

        // Save the updated images back to the property
        $property->images = json_encode(array_values($images)); // re-index the array
        $property->save();

        // Delete the physical image file if it exists
        $fullPath = public_path($photoPath);
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
    }

    // Redirect back to the edit property page with a success message
    return redirect()->route('property.edit', ['property_id' => $property_id])
                     ->with('success', 'Image removed successfully.');
}

    

public function update(Request $request, $property_id)
{
    // Before processing the images
Log::info('Request Data: ', $request->all());

// Check if the images are present in the request
if ($request->hasFile('images')) {
    Log::info('Images Found: ', $request->file('images'));
} else {
    Log::info('No images found in the request.');
}

    $property = Property::where('property_id', $property_id)->first();
    
    if (!$property) {
        return redirect()->back()->with('error', 'Property not found.');
    }

    $validator = Validator::make($request->all(), [
        'title' => 'required|string|max:255',
        'location' => 'required|json',
        'type' => 'required|in:house,property,apartment',
        'type_of_rent' => 'required|in:sell,rent',
        'bedrooms' => 'required|integer|min:0',
        'bathrooms' => 'required|integer|min:0',
        'area' => 'required|numeric|min:0',
        'parking_spaces' => 'nullable|integer|min:0',
        'flooring' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'description' => 'nullable|string',
        'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:9216',
        'removed_images.*' => 'nullable|string',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Exclude unwanted fields
    $property->fill($request->except(['_token', '_method', 'images', 'removed_images']));

    // Handle removed images
    $removedImages = $request->input('removed_images', []);
    $currentImages = is_string($property->images) ? json_decode($property->images, true) : $property->images;
    $currentImages = $currentImages ?? [];

    foreach ($removedImages as $removedPhoto) {
        if (($key = array_search($removedPhoto, $currentImages)) !== false) {
            unset($currentImages[$key]);
            if (file_exists(public_path($removedPhoto))) {
                unlink(public_path($removedPhoto));
            }
        }
    }

    // Handle new images
    $newPhotos = [];
    if ($request->hasFile('images')) {
        $directoryPath = public_path('property_images');
        if (!File::exists($directoryPath)) {
            File::makeDirectory($directoryPath, 0755, true);
        }

        foreach ($request->file('images') as $photo) {
            $validator = Validator::make(['photo' => $photo], [
                'photo' => 'image|mimes:jpeg,png,jpg,gif|max:9216',
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
    $allPhotos = array_merge($currentImages, $newPhotos);
    $property->images = json_encode(array_values($allPhotos));

    // Save the updated property
    $property->save();

    return redirect()->route('property.edit', ['property_id' => $property_id])
                     ->with('success', 'Property updated successfully!');

                     
}

 
    

public function editProperty($property_id)
{
    $property = Property::where('property_id', $property_id)->first();
    
    if (!$property) {
        return redirect()->back()->with('error', 'Property not found.');
    }

    $property->images = is_string($property->images) ? json_decode($property->images, true) : $property->images;

    return view('agent.edit-property', compact('property'));
}

    
    public function newindex()
    {
        $properties = Property::all();

        $properties->each(function($property) {
            if (is_string($property->images)) {
                $property->images = json_decode($property->images, true);
            }
        });

        Log::info($properties);

        return view('newindex', compact('properties'));
    }

    public function adminPropertyList()
{
    // Get the authenticated user's ID
    $userId = Auth::id();

    // Retrieve properties uploaded by the authenticated user
    $properties = Property::where('user_id', $userId)->get();

    // Pass the filtered properties to the view
    return view('agent.admin-property-list', compact('properties'));
}
    

}
