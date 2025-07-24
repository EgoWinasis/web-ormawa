<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    // Display the setting page
    public function index()
    {
        $user = User::find(Auth::user()->id);
        $latestBrand = DB::table('brand_image')->latest('id')->first();

        $brandImage = $latestBrand?->path ?? null; // null if not set
        return view('admin.setting', compact('brandImage', 'user'));
    }

    // Handle the image upload
    public function updateBrandImage(Request $request)
    {
        $request->validate([
            'brand_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Store in the same folder as default image
        $image = $request->file('brand_image');
        $path = $image->store('file-logo', 'public'); // saved to storage/app/public/file-logo

        // Save to DB
        DB::table('brand_image')->insert([
            'path' => $path,
            'created_at' => now(),
        ]);

        return redirect()->route('admin.setting')->with('success', 'Brand image updated successfully.');
    }
}
