<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Device;

class Tracking extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'track';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {
        $header = ['ID', 'Name', 'Location', 'DateCreated'];
        $results = DB::table('device')
                        ->join('report', 'Device_ID', '=', 'device.ID')
                        ->select('device.ID', 'Name', 'Location', 'DateCreated')
                        ->get()->map(function ($item) {
            return (array) $item;
        });
        $this->table($header, $results);
        return 0;
    }

}
