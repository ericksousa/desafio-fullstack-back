<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use function Laravel\Prompts\form;
use function Laravel\Prompts\error;
use function Laravel\Prompts\info;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Registra um novo usuário na aplicação';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $responses = form()
            ->text(
                label: "Digite o endereço de e-mail",
                default: "joao@email.com",
                validate: ["email" => "required|email|unique:users"],
                name: "email",
            )
            ->text(
                label: "Digite o nome do usuário",
                default: "João Silva",
                validate: ["name" => "required"],
                name: "name",
            )
            ->password(
                label: "Crie uma senha para o usuário",
                validate: ["password" => "required"],
                name: "password",
            )
            ->submit();

        try {
            $input = $responses;
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);

            info('Usuário cadastrado com sucesso!');
        } catch (\Throwable $th) {
            error('Ocorreu um erro ao cadastrar o usuário');
        }
    }
}
