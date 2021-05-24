<?php

namespace App\Console\Commands;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Console\Command;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates administrator users.';

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
        $attributes = [];

        $attributes['first_name'] = $this->ask('Enter first name');
        $attributes['last_name'] = $this->ask('Enter last name');
        $attributes['email'] = $this->ask('Enter email');
        $attributes['password'] = $this->ask('Enter password');

        $attributes['role'] = Role::Administrator;

        if (!User::create($attributes)) {
            $this->error('Something went wrong while trying to create user!');
        }

        $this->info('User successfully created!');

        return 0;
    }
}
