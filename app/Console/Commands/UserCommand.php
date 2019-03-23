<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create {email}';

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
     * @return mixed
     */
    public function handle()
    {
        $arguments = $this->arguments();

        if (!empty($arguments['email'])) {
            $validator = Validator::make($arguments, [
                'email' => 'email'
            ]);

            if($validator->fails()) {
                $arguments['email'] = $this->ask('Enter email');
            }
            else {
                $arguments['email'] = $arguments['email'];

                $validator = Validator::make($arguments, [
                    'email' => 'email'
                ]);
                if($validator->fails()) {
                    $this->line('not valid Email!');
                    return false;
                }
            }

            $arguments['password'] = $this->secret('Enter password');
            $passwordConfirm = $this->secret('Re-enter password');
            if($arguments['password'] != $passwordConfirm) {
                $this->line('Wrong password!');
                return false;
            }

            $user = User::updateOrCreate(['email' => $arguments['email']], [
                'email' => $arguments['email'],
                'password' => Hash::make($arguments['password'])
            ]);

            print_r($arguments);
            return true;
        }

    }
}
