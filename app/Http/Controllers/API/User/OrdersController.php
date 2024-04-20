<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Frame;
use App\Models\Lens;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function createCustomGlasses(Request $request)
    {
        $user = auth()->user();
        
        if ($user->getUserPrivilege()->contains('user')) {
            $request->validate([
                'frame_id' => 'required|exists:frames,id',
                'lens_id' => 'required|exists:lenses,id',
                'currency' => 'required|in:usd,gbp,eur,jod,jpy',
            ]);

            $frame = Frame::find($request->frame_id);
            $lens = Lens::find($request->lens_id);

            if (!$frame || !$lens) {
                return response()->json(['message' => 'Frame or lens not found'], 404);
            }

            if ($frame->stock < 1 || $lens->stock < 1) {
                return response()->json(['message' => 'Frame or lens is out of stock'], 400);
            }

            // Calculate the total price based on the user's currency
            $totalPrice = $frame->price + $lens->price;

            // Create a new order for the custom glasses
            $order = Order::create([
                'user_id' => $user->id,
                'frame_id' => $frame->id,
                'lens_id' => $lens->id,
                'total_price' => $totalPrice,
                'currency' => $request->currency,
            ]);

            // Update the stock of the frame and lens
            $frame->stock -= 1;
            $lens->stock -= 1;
            $frame->save();
            $lens->save();

            return response()->json(['message' => 'Custom glasses created successfully', 'order' => $order], 201);
        }
        return response()->json(['message' => 'Unauthorized'], 403);
    }
}
