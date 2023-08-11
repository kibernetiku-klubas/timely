<?php

namespace App\Console\Commands;

use App\Models\Meeting;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DeleteExpiredMeetings extends Command
{
    protected $signature = 'meetings:delete-expired';
    protected $description = 'Deletes expired meetings';

    public function handle(): void
    {
        $now = now()->addDay();
        Meeting::where('created_at', '<', $now->subDays(DB::table('meetings')->value('delete_after')))
           ->delete();
        $this->info('Expired meetings deleted successfully.');
    }
}
