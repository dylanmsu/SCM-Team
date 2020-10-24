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
        echo "deploying laravel... \n";
        # Turn on maintenance mode
        shell_exec('php artisan down || true');

        # Pull the latest changes from the git repository
        # git reset --hard
        # git clean -df
        echo "pulling changes from github...";
        shell_exec('git pull origin master');

        # Install/update composer dependecies
        shell_exec('composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev');

        # Run database migrations
        shell_exec('php artisan migrate');

        # Clear caches
        shell_exec('php artisan cache:clear');

        # Clear expired password reset tokens
        shell_exec('php artisan auth:clear-resets');

        # Clear and cache routes
        shell_exec('php artisan route:cache');

        # Clear and cache config
        shell_exec('php artisan config:cache');

        # Clear and cache views
        shell_exec('php artisan view:cache');

        # Install node modules
        # npm ci

        # Build assets using Laravel Mix
        shell_exec('npm run production');

        # Turn off maintenance mode
        shell_exec('php artisan up');

        return 0;
    }
}
