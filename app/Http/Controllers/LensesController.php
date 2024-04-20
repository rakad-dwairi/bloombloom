<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\API\AuthorizationException;
use Illuminate\Support\Facades\Auth;


class LensesController extends Controller
{
    public function store(Request $request)
    {
        if (Auth::user()->getUserPrivilege()->contains('admin')) {
            $data = $request->validate([
                'colour' => 'required|string|max:255',
                'description' => 'required|string',
                'prescription_type' => 'required|in:fashion,single_vision,varifocal',
                'lens_type' => 'required|in:classic,blue_light,transition',
                'stock' => 'required|integer|min:0', 
                'currency' => 'required|in:usd,gbp,eur,jod,jpy',
                'price' => 'required|numeric|min:0',
            ]);
    
            $lens = Lens::create([
                'colour' => $data['colour'],
                'description' => $data['description'],
                'prescription_type' => $data['prescription_type'],
                'lens_type' => $data['lens_type'],
                'stock' => $data['stock']
            ]);
    
            $lens->price()->create([
                'type' => 'lens',
                'currency' => $data['currency'],
                'price' => $data['price'],
            ]);
    
            return response()->json(['message' => 'Lens created successfully', 'lens' => $lens], 201);
        }
    
        return response()->json(['message' => 'Unauthorized'], 403);
    }


    public function update(Request $request, $id)
    {
        if (Auth::user()->getUserPrivilege()->contains('admin')) {
            $lens = Lens::findOrFail($id);

            $request->validate([
                'colour' => 'required|string|max:255',
                'description' => 'required|string',
                'prescription_type' => 'required|in:fashion,single_vision,varifocal',
                'lens_type' => 'required|in:classic,blue_light,transition',
                'stock' => 'required|integer|min:0', 
                'currency' => 'required|in:usd,gbp,eur,jod,jpy',
                'price' => 'required|numeric|min:0',
            ]);

            $lens->update([
                'colour' => $request->input('colour'),
                'description' => $request->input('description'),
                'prescription_type' => $request->input('prescription_type'),
                'lens_type' => $request->input('lens_type'),
                'stock' => $request->input('stock')
            ]);

            $lens->save();

            // Update price separately
            $lens->price()->update([
                'currency' => $request->input('currency'),
                'price' => $request->input('price'),
            ]);

            return response()->json(['message' => 'Frame updated successfully', 'frame' => $lens], 200);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }


    public function destroy($id)
    {
        if (Auth::user()->getUserPrivilege()->contains('admin')) {
            $lens = Lens::findOrFail($id);
            $lens->delete();
    
            return response()->json(['message' => 'Frame deleted successfully'], 200);
        }
    
        return response()->json(['message' => 'Unauthorized'], 403);
    }
}
