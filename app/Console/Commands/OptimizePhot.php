<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\OptimizePhoto;

class OptimizePhot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'optimize:photo';

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
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
     $new = new OptimizePhoto;


     $new->optimize_photo();
    }
}
