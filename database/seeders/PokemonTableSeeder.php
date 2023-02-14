<?php

namespace Database\Seeders;

use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\LexerConfig;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PokemonTableSeeder extends Seeder
{
     const CSV_FILENAME = '/../database/seeders/pokemon_names.tsv';
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
        $config->setDelimiter("\t");
        // 1行目をスキップ
        $config->setIgnoreHeaderLine(true);
        $lexer = new Lexer($config);
        $interpreter = new Interpreter();
        $interpreter->addObserver(function(array $row) {
            // 登録処理
            $pokemon = \App\Models\Pokejp::create([
                    'jp_name' => $row[3],
                   'p_id' =>$row[1],
               ]);
        });

        $lexer->parse(app_path() . self::CSV_FILENAME, $interpreter);

        $this->command->info('[End] import data.');
    }
}
