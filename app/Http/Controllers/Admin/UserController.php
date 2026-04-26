<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'user')
            ->withCount('orders');

        // Search filter
        if ($request->filled('search') && $request->filled('search_type')) {
            $search = $request->search;
            $type = $request->search_type;

            if ($type == 'id') {
                $query->where('id', $search);
            } elseif ($type == 'name') {
                $query->where('name', 'like', '%' . $search . '%');
            } elseif ($type == 'email') {
                $query->where('email', 'like', '%' . $search . '%');
            } elseif ($type == 'phone') {
                $query->where('phone', 'like', '%' . $search . '%');
            } elseif ($type == 'city') {
                $query->where('city', 'like', '%' . $search . '%');
            }
        }

        // Order count filter
        if ($request->filled('min_orders')) {
            $query->has('orders', '>=', (int) $request->min_orders);
        }

        $users = $query->latest()
            ->paginate(10)
            ->withQueryString();

        $totalUsers = User::where('role', 'user')->count();

        if ($request->ajax()) {
            return view('admin.users.partials.table', compact('users'))->render();
        }

        return view('admin.users.index', compact('users', 'totalUsers'));
    }
}