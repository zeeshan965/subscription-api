<?php

namespace Database\Seeders;

use App\Models\Subscription;
use App\Models\User;
use App\Models\Website;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get user and website IDs
        $userIds = User::pluck('id');
        $websiteIds = Website::pluck('id');

        // Create sample subscriptions
        foreach ($userIds as $userId) {
            foreach ($websiteIds as $websiteId) {
                Subscription::create([
                    'user_id' => $userId,
                    'website_id' => $websiteId,
                ]);
            }
        }

    }
}
