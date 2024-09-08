<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\form;
use App\Models\FormResponse;
use App\Models\Response;
use Illuminate\Support\Str;


class ResponseFormController extends Controller
{
    //
    // public function store(Request $request, $slug)
    // {
    //     // Find the form by slug
    //     $form = Form::where('slug', $slug)->first();

    //     // Check if the form exists
    //     if (!$form) {
    //         return response()->json([
    //             "message" => "Slug not found"
    //         ], 422);
    //     }

    //     // Get the form ID
    //     $formId = $form->id;

    //     // Generate a unique submit key
    //     $submitKey = Str::uuid()->toString();

    //     // Assuming you want to store the key-value pairs from the request
    //     foreach ($request->all() as $key => $value) {
    //         // Ensure 'submit_key' is generated once and used across all key-value pairs
    //         Response::create([
    //             'form_id' => $formId,
    //             'key' => $key,
    //             'value' => $value,
    //             'submit_key' => $submitKey,
    //         ]);
    //     }

    //     return response()->json([
    //         "message" => "Form responses saved successfully",
    //         "submit_key" => $submitKey, // Return the submit key if needed
    //     ], 200);
    // }
    public function store(Request $request, $slug)
    {
        // Find the form by slug
        $form = Form::where('slug', $slug)->first();

        // Check if the form exists
        if (!$form) {
            return response()->json([
                "message" => "Slug not found"
            ], 422);
        }

        // Get the form ID
        $formId = $form->id;

        // Generate a unique submit key
        $submitKey = Str::uuid()->toString();

        // Loop through the request input to store each key-value pair
        foreach ($request->all() as $key => $value) {
            Response::create([
                'form_id' => $formId,
                'key' => $key,
                'value' => $value,
                'submit_key' => $submitKey,
            ]);
        }

        return response()->json([
            "message" => "Form responses saved successfully",
            "submit_key" => $submitKey, // Return the submit key if needed
        ], 200);
    }

    public function getSubmitionBySlug($slug)
    {
        // Find the form by slug
        $form = Form::where('slug', $slug)->with('responses')->first();

        // Check if the form exists
        if (!$form) {
            return response()->json([
                "message" => "Slug not found"
            ], 422);
        }

        // Group responses by submit_key
        $submissions = [];
        foreach ($form->responses as $response) {
            $submissions[$response->submit_key][$response->key] = $response->value;
        }

        return response()->json([
            "form" => $form->slug,
            "submissions" => $submissions
        ], 200);
    }
}
