<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */

public function update(ProfileUpdateRequest $request): RedirectResponse
{
    $user = $request->user();

    // Apply standard validated fields
    $user->fill($request->validated());

    // Handle email reset if changed
    if ($user->isDirty('email')) {
        $user->email_verified_at = null;
    }

    // Handle profile photo upload if available
    if ($request->hasFile('profile_photo')) {
        // Delete old photo if it exists
        if ($user->profile_photo_path) {
            Storage::disk('public')->delete($user->profile_photo_path);
        }

        // Store new photo in /storage/app/public/profile-photos
        $path = $request->file('profile_photo')->store('profile-photos', 'public');

        // Save path in database
        $user->profile_photo_path = $path;
    }

    // Save the user with updated info and optional image path
    $user->save();

    return Redirect::route('profile.edit')->with('status', 'profile-updated');
}


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function updatePhoto(Request $request): RedirectResponse
{
    $request->validate([
        'profile_photo' => ['required', 'image', 'max:2048'],
    ]);

    $user = $request->user();

    if ($user->profile_photo_path) {
        Storage::disk('public')->delete($user->profile_photo_path);
    }

    $path = $request->file('profile_photo')->store('profile-photos', 'public');
    $user->profile_photo_path = $path;
    $user->save();

    return back()->with('status', 'profile-photo-updated');
}

}
