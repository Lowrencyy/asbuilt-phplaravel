<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class PurgeDeletedUsers extends Command
{
    protected $signature   = 'users:purge-deleted';
    protected $description = 'Permanently delete soft-deleted users whose 90-day retention period has expired.';

    public function handle(): int
    {
        $count = User::onlyTrashed()
            ->whereNotNull('permanently_delete_at')
            ->where('permanently_delete_at', '<=', now())
            ->get()
            ->each(fn ($user) => $user->forceDelete())
            ->count();

        $this->info("Purged {$count} user(s).");

        return self::SUCCESS;
    }
}
