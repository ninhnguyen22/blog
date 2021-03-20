<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class NBlogGenerate extends Command
{
    protected $root = '/var/www/blog/';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'n:generate';

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
        $output = null;
        $command = 'cd ' . $this->root . ' & touch a.txt';
        exec($command);
        return 0;
    }
}
