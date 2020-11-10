<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DeployCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deploy';

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
        echo "\n";
        echo "deploying laravel... and fetching freshly baked cookies \n";
        # Turn on maintenance mode
        exec('php artisan down || true');

        # Pull the latest changes from the git repository
        # git reset --hard
        # git clean -df
        echo "\n";
        echo "pulling changes from github... or somewhere else \n";
        shell_exec('git pull origin master');

        # Install/update composer dependecies
        echo "\n";
        echo "Installing and/or updating underwear drawer preferences \n";
        shell_exec('composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev --quiet');

        # Run database migrations
        exec('php artisan migrate');

        # Clear caches
        exec('php artisan cache:clear');

        # Clear expired password reset tokens
        exec('php artisan auth:clear-resets');

        # Clear and cache routes
        exec('php artisan route:cache');

        # Clear and cache config
        exec('php artisan config:cache');

        # Clear and cache views
        exec('php artisan view:cache');

        # Install node modules
        # npm ci

        # Build assets using Laravel Mix
        exec('npm run production');

        # Turn off maintenance mode
        exec('php artisan up');
        
        
        echo "\n";
        echo "All done, goodnight zzz... \n";
        echo "\n";
        
        # Going to bed
        exec('exit');
        
        return 0;
    }
}
