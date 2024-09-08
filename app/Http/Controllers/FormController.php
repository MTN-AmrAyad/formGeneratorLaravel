<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FormController extends Controller
{
    //retrive all data
    public function index()
    {
        $forms = Form::all();
        return response()->json([
            "message" => "data retrived successfully",
            "data" => $forms
        ], 201);
    }
    //function to create a form with unique slug
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "slug" => "required|unique:forms,slug",

        ])->stopOnFirstFailure();
        if ($validator->fails()) {
            // Get the first error message
            $firstError = $validator->errors()->first();
            return response()->json(['error' => $firstError], 422);
        };
        $form = Form::create($request->all());
        return response()->json([
            "message" => "form create successfully",
            "data" => $form
        ], 201);
    }
}
