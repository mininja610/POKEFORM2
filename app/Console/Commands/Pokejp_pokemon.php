<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pokemon;
use App\Models\Pokejp;

class Pokejp_pokemon extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:pokejp';

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
        for( $i=1;$i<891;$i++ ){

    $poke_jp_name =  Pokejp:: where('p_id', $i)->get();
    $jp_poke = $poke_jp_name->pluck("jp_name")[0];
    
    
     $poke_en_name = Pokemon::where('p_id', $i)->get();
     
     foreach($poke_en_name as $en_poke){
        $en_poke->jp_name = $jp_poke;
        $en_poke->save();
     
       echo $en_poke->jp_name."\n";
     }
       
    }
}
}
