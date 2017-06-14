<?php

namespace App\Console\Commands;
use App\Http\Controllers\CronController;
use Illuminate\Console\Command;

class UpdateInventory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'UpdateInventory:UpdateInventory';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cron Job to update amazon inventory';

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
        $controller->update_inventory();
    }
}
