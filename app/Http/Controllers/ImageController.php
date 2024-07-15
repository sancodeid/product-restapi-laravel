<?php

namespace App\Http\Controllers;

use App\Models\User;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request;

class ImageController extends Controller
{
    public function getImage($filename)
    {
        $path = public_path('images/' . $filename);

        if (!file_exists($path)) {
            return response()->json(['message' => 'Image not found.'], 404);
        }

        $url = url('images/' . $filename);

        return response()->json(['url' => $url]);
    }

    public function show()
    {
        $user = User::all();
        return response()->json($user);
    }
}
