<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\Property;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class PropertyController extends Controller
{
    /**
     * Post a new property.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postProperty(Request $request)
    {
        // Validate the incoming request
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
            'payment_frequency' => 'nullable|string|max:255',//Month or
            'photos.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:9216',

            'videos' => 'nullable|array',
            'virtual_tour' => 'nullable|string|max:255',
            'additional_information' => 'nullable|string',
        ]);

        // If validation fails, return the errors
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Find the user
        $user = User::find($request->user_id);

        // Check if the user is active
     

        // Cache new property availability
        Cache::put('new_property_available', true, 1440);

        // Handle image upload
        $imagePaths = [];

        if ($request->hasFile('photos')) {
            // Create the public/property_images directory if it doesn't exist
            $directoryPath = public_path('property_images');
            if (!File::exists($directoryPath)) {
                File::makeDirectory($directoryPath, 0755, true);
            }

            // Process each uploaded file
            foreach ($request->file('photos') as $photo) {
                // Validate the file
                $validator = Validator::make(['photo' => $photo], [
                    'photo' => 'image|mimes:jpeg,png,jpg,gif|max:8048', // Adjust file types and size as needed
                ]);

                if ($validator->fails()) {
                    return response()->json(['error' => $validator->errors()], 422);
                }

                // Generate a unique filename for the image
                $imageName = uniqid('property_image_') . '.' . $photo->getClientOriginalExtension();

                // Store the image in the public/property_images directory
                $photo->move($directoryPath, $imageName);

                // Set the image path
                $imagePaths[] = 'property_images/' . $imageName;
            }
        }

        // Separate image paths from the main request data
        $propertyData = $request->except('photos');

        // Merge the property data and image paths to create the property
        $property = Property::create(array_merge($propertyData, ['photos' => $imagePaths]));

        // Return a JSON response with the updated property data
        return response()->json([
            'message' => 'Property posted successfully!',
            'property' => $property,
        ], 201);
    }

    /**
     * Get the list of all properties.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function getList()
{
    // Fetch all properties from the database
    $properties = Property::all();

    // Log or dump $properties to verify its content
    Log::info($properties);

    return view('list', compact('properties'));
}

    
public function newindex()
{
    // Fetch all properties from the database
    $properties = Property::all();
    
    // Log or dump $properties to verify its content
    Log::info($properties);

    // Pass the $properties variable to the view
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
        // Fetch the property details based on the ID
        $property = Property::find($id);
    
        // Pass the property details to the portfolio view
        return view('portofilio', compact('property'));
    }
}
