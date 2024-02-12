<?php

namespace App\Console\Commands;

use Exception;
use Carbon\Carbon;
use App\Models\Room;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateRoomStatusTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-room-status-task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = date('Y-m-d', strtotime(Carbon::today()));

        $rooms = Room::whereDate('starting_date', '=', $today)
            ->where('status', Room::STATUS_PAID)
            ->update(['status' => Room::STATUS_ACTIVE]);

        $expiredRooms = Room::whereDate('expiration_date', '=', $today)
            ->where('status', Room::STATUS_ACTIVE)
            ->update(['status' => Room::STATUS_EXPIRED]);
    }
}
