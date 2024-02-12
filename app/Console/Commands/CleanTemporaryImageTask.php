<?php

namespace App\Console\Commands;

use App\Models\TemporaryFile;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CleanTemporaryImageTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clean-temporary-image-task';

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

        $temporaryFiles = TemporaryFile::whereDate('created_at', '<', $today)->delete();
    }
}
