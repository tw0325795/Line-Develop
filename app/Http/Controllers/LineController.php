<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DevelopLog;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
class LineController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('line.index');
    }

    public function getMessage(Request $request){
        $httpClient = new CurlHTTPClient(env('LINE_CHANNEL_ACCESS_TOKEN'));
        $bot = new LINEBot($httpClient, ['channelSecret' => env('LINE_SECRET')]);

        $textMessageBuilder = new TextMessageBuilder('伺服器收到:'.$request->event[0]->type);
        $response = $bot->replyMessage($request->event[0]->replyToken, $textMessageBuilder);
        if ($response->isSucceeded()) {
            $data = 'Succeeded!';
        }else{
            // Failed
            $data = $response->getHTTPStatus() . ' ' . $response->getRawBody();
        }

        DevelopLog::create([
            'data'=>json_encode($data)
        ]);
        return [];
    }

    public function saveToken(){

    }
}
