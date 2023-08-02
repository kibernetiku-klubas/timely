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

    public function handle()
    {
        $now = now()->addDay(); // adds one day to the current one using carbon, to prevent accidental deletion due to timezone differences
        Meeting::where(DB::raw("DATE(created_at, '+' || delete_after || ' day')"), '<', $now)->delete();
        $this->info('Expired meetings deleted successfully.');
    }
}
