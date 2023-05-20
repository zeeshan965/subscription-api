<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\Website;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * @param Request $request
     * @param Website $website
     * @return JsonResponse
     */
    public function subscribe(Request $request, Website $website): JsonResponse
    {
        // Validate the request data
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id'
        ]);

        // Check if the user is already subscribed to the website
        $existingSubscription = Subscription::where('user_id', $validatedData['user_id'])
            ->where('website_id', $website->id)->first();

        if ($existingSubscription) {
            return response()->json(['error' => 'User is already subscribed to this website'], 400);
        }

        // Create the subscription
        $subscription = new Subscription([
            'user_id' => $validatedData['user_id'],
        ]);

        $website->subscriptions()->save($subscription);

        // Return a response indicating success
        return response()->json(['message' => 'User subscribed successfully', 'subscription' => $subscription], 201);
    }
}
