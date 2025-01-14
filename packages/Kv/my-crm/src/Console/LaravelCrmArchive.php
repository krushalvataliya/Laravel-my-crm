<?php

namespace Kv\MyCrm\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Composer;
use Kv\MyCrm\Services\SettingService;

class LaravelCrmArchive extends Command
{
    /**
     * @var SettingService
     */
    private $settingService;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravelcrm:archive';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Archiving Laravel CRM data';

    /**
     * The Composer instance.
     *
     * @var \Illuminate\Foundation\Composer
     */
    protected $composer;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Composer $composer, SettingService $settingService)
    {
        parent::__construct();
        $this->composer = $composer;
        $this->settingService = $settingService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Laravel CRM archiving...');

        //

        $this->info('Archive CRM archiving complete.');
    }
}
