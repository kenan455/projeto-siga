<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      \DB::table('users')->insert([
        'id' => 1,
        'name' => 'Julio Silva',
        'email' => 'professor_teste1@sistema.com',
        'password' => Hash::make('asheww123'),
        'created_at' => now(),
        'updated_at' => now(),
        'ativo' => 1,
        'nivel' => 1
      ]);

      \DB::table('users')->insert([
        'id' => 2,
        'name' => 'João Bandeira',
        'email' => 'professor_teste2@sistema.com',
        'password' => Hash::make('asheww123'),
        'created_at' => now(),
        'updated_at' => now(),
        'ativo' => 1,
        'nivel' => 1
      ]);

      \DB::table('users')->insert([
        'id' => 3,
        'name' => 'João Vitor Da Silva',
        'email' => 'aluno_teste1@gmail.com',
        'password' => Hash::make('asheww123'),
        'ano_turma' => '2° ano 5',
        'created_at' => now(),
        'updated_at' => now(),
        'ativo' => 1,
        'nivel' => 2
      ]);

      \DB::table('users')->insert([
        'id' => 4,
        'name' => 'Maria Setembrina Pinto',
        'email' => 'aluno_teste2@gmail.com',
        'password' => Hash::make('asheww123'),
        'ano_turma' => '2° ano 6',
        'created_at' => now(),
        'updated_at' => now(),
        'ativo' => 1,
        'nivel' => 2
      ]);

      \DB::table('users')->insert([
        'id' => 5,
        'name' => 'Kenan Fintelman',
        'email' => 'aluno_teste3@gmail.com',
        'password' => Hash::make('asheww123'),
        'ano_turma' => '3° ano 7',
        'created_at' => now(),
        'updated_at' => now(),
        'ativo' => 1,
        'nivel' => 2
      ]);

      \DB::table('atividades')->insert([
        'id' => 1,
        'arquivo' => 'arquivos/arquivos/trigonometria.jpg',
        'titulo' => 'Atividade de matemática',
        'descricao' => 'Atividade sobre trigonometria',
        'ano_turma' => '1° ano 5',
        'ativo' => 1,
        'created_at' => now(),
        'updated_at' => now(),
      ]);

      \DB::table('atividades')->insert([
        'id' => 2,
        'arquivo' => 'arquivos/arquivos/portuguesSintaxeSemantica.jpg',
        'titulo' => 'Atividade de português',
        'descricao' => 'Atividade sobre sintaxe e semântica ',
        'ano_turma' => '2° ano 3',
        'ativo' => 1,
        'created_at' => now(),
        'updated_at' => now(),
      ]);

      \DB::table('atividades')->insert([
        'id' => 3,
        'arquivo' => 'arquivos/arquivos/FuncoesOrganicas.jpg',
        'titulo' => 'Atividade de química',
        'descricao' => 'Atividade sobre Funções Orgânica',
        'ano_turma' => '3° ano 2',
        'ativo' => 1,
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    }
}
