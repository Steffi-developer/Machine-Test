<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SearchController extends Controller
{
    public function index()
    {
        $users = User::with('designation', 'department')->get();
        return view('search', compact('users'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        
        $users = User::with('designation', 'department')
                       ->where('name', 'LIKE', "%{$query}%")
                       ->orWhereHas('department',function ($q) use ($query) {
                                                    $q->where('name', 'LIKE', "%{$query}%");
                                                     })
                      ->orWhereHas('designation', function ($q) use ($query) {
                                                    $q->where('name', 'LIKE', "%{$query}%");
                                                      })
                      ->get();

        return response()->json($users);
    }
}
