<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

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

        // Get the uploaded file
        $image = $request->file('brand_image');

        // Generate timestamped filename with original extension
        $timestamp = Carbon::now()->format('Ymd_His');
        $extension = $image->getClientOriginalExtension();
        $filename = $timestamp . '.' . $extension;

        // Store the file manually
        $path = $image->storeAs('file-logo', $filename, 'public'); // stored in storage/app/public/file-logo

        // Save just the filename to the DB
        DB::table('brand_image')->insert([
            'path' => $filename,  // Only the filename
            'created_at' => now(),
        ]);

        return redirect()->route('admin.setting')->with('success', 'Brand image updated successfully.');
    }
}
