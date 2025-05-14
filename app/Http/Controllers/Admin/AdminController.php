<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminStoreRequest;
use App\Http\Requests\AdminUpdateRequest;
use App\Repositories\Interfaces\AdminRepositoryInterface;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    use UploadImageTrait;

    protected $admin;

    public function __construct(
        AdminRepositoryInterface $adminRepository
    ) {
        $this->admin = $adminRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = $this->admin->getAllAdmins();

        return view('pages.admin.admins.index', [
            'admins' => $admins
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminStoreRequest $request)
    {
        $data = [
           'name' => $request->name,
           'email' => $request->email,
           'password' => $request->password,
           'phone' => $request->phone,
           'address' => $request->address,
           'is_super_admin' => 0,
           'status' => isset($request->active) && $request->active == "on" ? 'active' : 'blocked'
        ];

        // store profile image
        if($request->hasFile('photo')) {
             $image = $request->file('photo');
            // if file is uploaded file object
            if($image instanceof \Illuminate\Http\UploadedFile) {

                $path = 'upload/profiles';

                $imageName = 'profiles_' . uniqid();

                $imageUrl = $this->uploadImage($image, $path, $imageName);

                $data['photo'] = $imageUrl;
            
            }
        }

        $this->admin->create($data);

        return redirect()->route('admin.admins.index')
                         ->with('success', 'Admin created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // get admin
        $admin = $this->admin->getAdminById($id);
    	if(!isset($admin) || empty($admin)) {
    		abort(404);
    	}
        
        return view('pages.admin.admins.edit', [
            'admin' => $admin
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminUpdateRequest $request, string $id)
    {
        // get admin
        $admin = $this->admin->getAdminById($id);
    	if(!isset($admin) || empty($admin)) {
    		abort(404);
    	}

        $data = [
           'name' => $request->name,
           'email' => $request->email,
           'phone' => $request->phone,
           'address' => $request->address,
           'status' => isset($request->active) && $request->active == "on" ? 'active' : 'blocked'
        ];

        // store profile image
        if($request->hasFile('photo')) {
             $image = $request->file('photo');
            // if file is uploaded file object
            if($image instanceof \Illuminate\Http\UploadedFile) {

                // delete previous image from folder
                if(isset($admin->photo)) {
                    $this->deleteImage($admin->photo);
                }

                $path = 'upload/profiles';

                $imageName = 'profiles_' . uniqid();

                $imageUrl = $this->uploadImage($image, $path, $imageName);

                $data['photo'] = $imageUrl;
            
            }
        }

        $this->admin->update($data, $admin->id);

        return redirect()->route('admin.admins.index')
                         ->with('success', 'Admin updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = $this->admin->getAdminById($id);
    	if(!isset($admin) || empty($admin)) {
    		abort(404);
    	}

        // delete image from folder if exist
        if(isset($admin->photo)) {
            $this->deleteImage($admin->photo);
        }

        $admin->delete();               

        return redirect()->route('admin.admins.index')
                         ->with('success', 'Admin deleted successfully');
    }
}
