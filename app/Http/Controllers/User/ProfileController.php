<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Repositories\Interfaces\UserRepositoryInterface;

use App\Http\Requests\PasswordChangeRequest;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    protected $user;

    public function __construct(
        UserRepositoryInterface $userRepository
    ) {
        $this->user = $userRepository;
    }

    public function updateUserProfile(ProfileUpdateRequest $request, $userId)
    {
        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone
        ];

        $this->user->update($data, $userId);

        return redirect()->route('dashboard')->with('success', 'Account details updated successully.');
    }

    public function changePassword(PasswordChangeRequest $request)
    {
        $data = [
            'password' => $request->password
        ];

        $this->user->update($data, Auth::id());

        return redirect()->route('dashboard')->with('success', 'Password changed successully.');
    }
}
