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
        $now = Carbon::now();
        $meetings = Meeting::all();

        foreach ($meetings as $meeting) {
            $expirationDate = $meeting->created_at->copy()->addDays($meeting->delete_after)->addDay();

            if ($now->greaterThanOrEqualTo($expirationDate)) {
                $meeting->delete();
                $this->info("Meeting with ID {$meeting->id} deleted.");
            }
        }

        $this->info('Expired meetings deleted successfully.');
    }
}
