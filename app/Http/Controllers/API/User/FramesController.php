<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Frame;
use Illuminate\Support\Facades\Auth;

class FramesController extends Controller
{
    public function getActiveFrames(Request $request)
    {
        if (Auth::user()->getUserPrivilege()->contains('user')) {

            $frames = Frame::where('status', 'active')->get();
            return response()->json(['frames' => $frames], 200);

        }
        return response()->json(['message' => 'Unauthorized'], 403);
    }
}