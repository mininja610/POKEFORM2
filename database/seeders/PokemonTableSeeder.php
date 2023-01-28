<?php

namespace Database\Seeders;

use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\LexerConfig;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PokemonTableSeeder extends Seeder
{
     const CSV_FILENAME = '/../database/seeders/Pokedex_Cleaned.csv';
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('[Start] import data.');

        $config = new LexerConfig();
        // セパレーター指定、"\t"を指定すればtsvファイルとかも取り込めます
        $config->setDelimiter(",");
        // 1行目をスキップ
        $config->setIgnoreHeaderLine(true);
        $lexer = new Lexer($config);
        $interpreter = new Interpreter();
        $interpreter->addObserver(function(array $row) {
            // 登録処理
            $pokemon = \App\Models\Pokemon::create([
                    'name' => $row[1],
                    'primary_type' => $row[2],
                    'secondary_type' => $row[3],
                    'hp' => $row[5],
                    'attack_power' => $row[6],
                    'defensive_power' => $row[7],
                    'special_attack_power' => $row[8],
                    'special_defensive_power' => $row[9],
                    'speed' => $row[10],
                    'total' => $row[4],
                    //
               ]);
        });

        $lexer->parse(app_path() . self::CSV_FILENAME, $interpreter);

        $this->command->info('[End] import data.');
    }
}
