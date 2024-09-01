<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Persona;
use Illuminate\Support\Facades\Hash;

class EncryptPasswords extends Command
{
    protected $signature = 'encrypt:passwords';
    protected $description = 'Encrypt passwords of existing users';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $personas = Persona::all();

        foreach ($personas as $persona) {
            if (!Hash::needsRehash($persona->clave)) {
                continue;
            }

            $persona->clave = Hash::make($persona->clave);
            $persona->save();
        }

        $this->info('Passwords encrypted successfully.');
    }
}
