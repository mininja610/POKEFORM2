<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pokemon;

class micriAPI extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:micro';

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
    public function handle(Pokemon $pokemon)
    {

// cURLの初期化
for( $i=1;;$i++ ){
    


$ch = curl_init();

// キーとリージョンの指定
$key = "49fe64d420704143b6416db28152dc47";
$region = "japanwest";
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  "Ocp-Apim-Subscription-Key: " . $key,
  "Ocp-Apim-Subscription-Region: " . $region,
  "Content-Type: application/json; charset=UTF-8"
));

// URLと翻訳言語の指定
$from = 'en';
$to = 'ja';
$url = "https://api.cognitive.microsofttranslator.com/translate?api-version=3.0&from=".$from."&to=".$to;
curl_setopt($ch, CURLOPT_URL, $url);

// 翻訳テキストの指定
// json_encodeには角カッコ2つのデータを渡してJSON配列を作る点に注意
$pokemon = Pokemon::where('p_id', $i)->get();
        $poke = $pokemon->pluck("en_name")[0];
//$text = "Hello, what is your name?";
$json = json_encode([['Text' => $poke]]);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// 送信と応答
$result = curl_exec($ch);

// レスポンスをデコード
$decode = json_decode($result);


// エラーチェック
if (isset($decode->error)) {
  throw new Exception("翻訳に失敗しました。code:". $decode->error->code . " message:" . $decode->error->message);
}

// 翻訳結果表示
echo $poke."\n";
echo $decode[0]->translations[0]->text."\n";

$pokemon->jp_name = $decode[0]->translations[0]->text;
foreach($pokemon as $pname){
    $pname->jp_name = $decode[0]->translations[0]->text;
    $pname->save();
}
if( $i===5 ){
    echo "ループ抜けるよ\n";
    break;
  }


}


}

}