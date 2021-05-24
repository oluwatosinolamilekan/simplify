<?php

namespace App\Console\Commands;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

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
        $attributes['password'] = $this->ask('Enter password (leave blank for random generated)', Str::random(10));

        $role = Role::fromValue(Role::Administrator);
        $attributes['role'] = $role->value;

        if (User::where('email', $attributes['email'])->exists()) {
            $this->error('User with given email already exists!');
            return 0;
        }

        // Confirm
        $summary = "Last name: {$attributes['last_name']} | First name: {$attributes['first_name']} | Email: {$attributes['email']} | Password: {$attributes['password']} | Role: {$role->key}";

        $this->line('Please review user account details');
        $this->line($summary);

        if ($this->confirm('Do you wish to continue?', true))
        {
            if (!User::create($attributes)) {
                $this->error('Something went wrong while trying to create user!');
                return 0;
            }

            $this->info('User successfully created!');
        }

        $this->info('All done.');

        return 0;
    }
}
