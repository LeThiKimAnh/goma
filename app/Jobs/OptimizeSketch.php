<?php

namespace App\Jobs;

use Log;
use DB;
use App\Jobs\Optimzer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OptimizeSketch extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    
    protected $session;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($session)
    {
        $this -> session = $session;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info("Starting optimze the session");
        $recyclees = GoThua::all();
		$donhang_id = $session->donhang_id;
				
		$sql_query = "";
		$res = DB::raw($sql_query);
		$optimizer = new Optimizer();
				
        Log::info("Done!");
    }
}
