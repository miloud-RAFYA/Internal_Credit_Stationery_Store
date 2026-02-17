<?php

namespace App\Http\Controllers;
use App\Models\Employe;
use Illuminate\Http\Request;

class EmployeeDashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $token = $user->employe->token;   
        return view('shop.dashboard', [
            'token' => $token,
        ]);
    }
}
