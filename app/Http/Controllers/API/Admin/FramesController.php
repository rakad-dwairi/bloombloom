<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Models\Frame;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class FramesController extends Controller
{
   
    public function store(Request $request)
    {
        if (Auth::user()->getUserPrivilege()->contains('admin')) {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'status' => 'required|in:active,inactive',
                'stock' => 'required|integer|min:0', 
                'currency' => 'required|in:usd,gbp,eur,jod,jpy',
                'price' => 'required|numeric|min:0',
            ]);
    
            $frame = Frame::create([
                'name' => $data['name'],
                'description' => $data['description'],
                'status' => $data['status'],
                'stock' => $data['stock'],
                'currency' => $data['currency'],
                'price' => $data['price'],
            ]);

    
            return response()->json(['message' => 'Frame created successfully', 'frame' => $frame], 201);
        }
    
        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->getUserPrivilege()->contains('admin')) {
            $frame = Frame::findOrFail($id);

            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'price' => 'required|numeric|min:0',
                'currency' => 'required|in:usd,gbp,eur,jod,jpy',
                'status' => 'required|in:active,inactive',
                'stock' => 'required|integer|min:0',
            ]);

            $frame->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'status' => $request->input('status'),
                'stock' => $request->input('stock'),
                'currency' => $request->input('currency'),
                'price' => $request->input('price'),
            ]);

            $frame->save();

            return response()->json(['message' => 'Frame updated successfully', 'frame' => $frame], 200);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }

    

    public function destroy($id)
    {
        if (Auth::user()->getUserPrivilege()->contains('admin')) {
            $frame = Frame::findOrFail($id);
            $frame->delete();
    
            return response()->json(['message' => 'Frame deleted successfully'], 200);
        }
    
        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function show($id)
    {
        $frame = Frame::findOrFail($id);

        return response()->json(['frame' => $frame], 200);
    }
}
