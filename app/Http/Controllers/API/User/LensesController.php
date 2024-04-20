<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lens;
use Illuminate\Support\Facades\Auth;

class LensesController extends Controller
{
    public function getActiveLenses(Request $request)
    {
        if (Auth::user()->getUserPrivilege()->contains('user')) {

            $lenses = Lens::all();
            return response()->json(['frames' => $lenses], 200);

        }
        return response()->json(['message' => 'Unauthorized'], 403);
    }
}
