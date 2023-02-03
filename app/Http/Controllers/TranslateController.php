<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Cloud\Translate\V2\TranslateClient;


class TranslateController extends Controller

{
    public function __construct()
{ $this->api_key = env("AIzaSyDqmo3t1eWWtWayg-2hPBbqUVyn1PVqE0A");
}
  //config/services.phpに設定したAPIキーを読み込む
 
        public function translate(Request $request)
{
   if(!empty($request->translate)) {
        //TranslateClientクラスの呼び出し
        $translate = new TranslateClient();
        
        //翻訳したい言語を指定。今回は「日本語→英語」
        $lang = "ja";
        
        //翻訳開始
        $result = $translate->translate($request->translate, [
           'target' => $lang,
        ]);
        
        //翻訳結果を取得   
        $translation = $result['text'];
        
        //レスポンスをJSONで返すように設定
        return response()->json(['translation'=>$translation]);
   } else {
        return redirect()->back();
   }
}


}
