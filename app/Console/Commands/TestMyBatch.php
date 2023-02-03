<?php

namespace App\Console\Commands;

use App\Models\Pokemon;
use Illuminate\Console\Command;
use Google\Cloud\Translate\TranslateClient;
class TestMyBatch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:translate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $projectId = 'symmetric-core-376507';    
        
        $apiKey = 'AIzaSyDqmo3t1eWWtWayg-2hPBbqUVyn1PVqE0A';
        
        $translate = new TranslateClient([
            'projectId' => $projectId,
            'key' => $apiKey,
        ]);
        $lang = "ja";
        
        $poke_en_name = Pokemon::where('p_id', 1)->get();
        $poke = $poke_en_name->pluck("en_name")[0];
        $result = $translate->translate($poke, [
                    'target' => $lang,
                    "source" =>"en"
                ]);
            dd($result);    
    }
}
