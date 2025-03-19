<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Traits\ApiResponse;

class UserController extends Controller
{
    use ApiResponse;

    public function index()
    {
        $users = User::all();
        return $this->successResponse($users, 'Users retrieved successfully');
    }

    public function create()
    {
        return $this->errorResponse('Method not supported for API', 405);
    }

    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();
        
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'age' => $validated['age'] ?? null,
        ]);

        return $this->successResponse($user, 'User created successfully', 201);
    }

    public function show(User $user)
    {
        return $this->successResponse($user, 'User retrieved successfully');
    }

    public function edit(User $user)
    {
        return $this->errorResponse('Method not supported for API', 405);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request->validated();
        
        $userData = [];
        
        if (isset($validated['name'])) {
            $userData['name'] = $validated['name'];
        }
        
        if (isset($validated['email'])) {
            $userData['email'] = $validated['email'];
        }
        
        if (isset($validated['age'])) {
            $userData['age'] = $validated['age'];
        }
        
        $user->update($userData);

        return $this->successResponse($user, 'User updated successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return $this->successResponse(null, 'User deleted successfully');
    }
}
