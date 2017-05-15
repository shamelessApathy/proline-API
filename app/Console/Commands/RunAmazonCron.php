<?php

namespace App\Console\Commands;
use App\Http\Controllers\CronController;
use Illuminate\Console\Command;

class RunAmazonCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'RunAmazonCron:RunAmazonCron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cron Job to run amazon api request for retrieving _GET_ORDERS_DATA_';

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
     * @return mixed
     */
    public function handle()
    {
        $controller = new CronController();
        $controller->get_amazon_orders();
    }
}
