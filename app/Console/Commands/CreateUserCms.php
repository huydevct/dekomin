<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUserCms extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create_user_cms';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->ask("Enter login_id login");
        $password = $this->ask("Enter password");
        $email = trim($email);
        $password = trim($password);

        $this->info("Email: $email");
        $this->info("Password: $password");
        if($this->confirm("Are you sure?")) {
            $user = new User();
            $user->name = $email;
//            $user->login_id = $email;
            $user->email = $email;
//            $user->role = 1;
            $user->password = Hash::make($password);
            $user->email_verified_at = date("Y-m-d H:i:s");
            $user->save();
            $this->info("Create user success!");
        }
    }
}
