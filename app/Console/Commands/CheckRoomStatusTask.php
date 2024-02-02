<?php

namespace App\Console\Commands;

use Exception;
use App\Models\Room;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CheckRoomStatusTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-room-status-task';

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
        try {
            $rooms = Room::whereDate('starting_date', '=', date('Y-m-d'))->get();
            $rooms->status = Room::STATUS_ACTIVE;
            $rooms->save();
        } catch (Exception $exception) {
            Log::info('==============TASK-ROOM-STATUS: ' . $exception);
        }
    }
}
