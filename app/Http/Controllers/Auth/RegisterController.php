<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;

class RegisterController extends Controller
{
    //The form will be show with this method showForm
    public function showForm()
    {
        return view('pages.auth.register');
    }

    // The form perform action wtih this method
    public function actionForm(RegisterRequest $request)
    {
        if ($request->fails())
        {
            return response()->json(["errors" => $request->messages()],422);
        }

        // Validation passed, create user record
        $user =  User::create($request->validated());
        return response()->json(['message' => 'User created successfully'], 200);

    }
}
