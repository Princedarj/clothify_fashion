<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'user')
            ->withCount('orders')
            ->latest()
            ->paginate(5);

        $totalUsers = User::where('role', 'user')->count();

        return view('admin.users.index', compact('users', 'totalUsers'));
    }
}
