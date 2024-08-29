<?php

namespace Modules\Login\app\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Modules\Login\app\Models\User;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CreateUserCms extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'login:create-user';

    /**
     * The console command description.
     */
    protected $description = 'Create user cms in module login';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->ask("Enter email login");
        $password = $this->ask("Enter password");
        $email = trim($email);
        $password = trim($password);

        $this->info("Email: $email");
        $this->info("Password: $password");
        if($this->confirm("Are you sure?")) {
            $user = new User();
            $user->name = $email;
            $user->email = $email;
            $user->login_name = $email;
            $user->password = Hash::make($password);
            $user->email_verified_at = date("Y-m-d H:i:s");
            $user->save();
            $this->info("Create user success!");
        }
    }

    /**
     * Get the console command arguments.
     */
    protected function getArguments(): array
    {
        return [
            ['example', InputArgument::REQUIRED, 'An example argument.'],
        ];
    }

    /**
     * Get the console command options.
     */
    protected function getOptions(): array
    {
        return [
            ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }
}
