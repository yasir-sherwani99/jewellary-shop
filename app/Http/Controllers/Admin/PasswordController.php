<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPasswordChangeRequest;
use App\Repositories\Interfaces\AdminRepositoryInterface;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    protected $admin;

    public function __construct(
        AdminRepositoryInterface $adminRepository
    ) {
        $this->admin = $adminRepository;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.password.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminPasswordChangeRequest $request)
    {
        // get admin
        $admin = $this->admin->getAdminById(auth()->guard('admin')->user()->id);
    	if(!isset($admin) || empty($admin)) {
    		abort(404);
    	}

        $this->admin->update(['password' => $request->password], $admin->id);
        
        return redirect()->route('admin.password.create')
                         ->with('success', 'Your Password reset successfully.');

    }
}
