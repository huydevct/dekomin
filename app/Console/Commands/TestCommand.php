<?php

namespace App\Console\Commands;

use App\Helpers\AppHelper;
use App\Helpers\JwtHelper;
use App\Models\Queue;
use App\Services\Devices\DeviceSet;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Ngocnm\LaravelHelpers\StringHelper;
use OpenAI\Laravel\Facades\OpenAI;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test_command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $function = $this->choice("Choice Function", [
            'createTokenDevice',
            'createAccessToken',
            'checkToken',
            'testSplitSentences',
            'genTokenAppHelper',
            'testAssistant',
            'testChatgpt4o',
            'formatValue'
        ]);

        $this->{$function}();
    }

    public function testChatgpt4o()
    {
//        $resutl = OpenAI::chat()->create([
//            'model' => 'gpt-4o',
//            'messages' => [
//                [
//                    "role" => "user",
//                    "content" => [
//                        [
//                            "type" => "text",
//                            "text" => 'Giải bài toán sau'
//                        ],
//                        [
//                            "type" => "image_url",
//                            "image_url" => [
//                                "url" => "data:image/png;base64,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"
//                            ]
//                        ]
//                    ]
//                ]
//            ],
//            'max_tokens' => config('openai.max_tokens'),
//            'temperature' => config('openai.temperature')
//        ]);
//        $content = $resutl['choices'][0]['message']['content'];
//        Storage::put(time() . 'test.txt', $content);
//        dd($content);
        $stream = OpenAI::completions()->createStreamed([
//            'model' => 'gpt-4o',
//            'messages' => [
//                ['role' => 'user', 'content' => 'giải bài toán định dạng latex  này "giải phương trình 6x+2 \sqrt{ 5  }  = \displaystyle\int_{ 5  }^{ 6  } 6x  d x"'],
//            ],
            'model' => 'gpt-3.5-turbo-instruct-0914',
            'prompt' => 'giải bài toán định dạng latex  này "giải phương trình 6x+2 \sqrt{ 5  }  = \displaystyle\int_{ 5  }^{ 6  } 6x  d x"',
            'max_tokens' => 3000,
        ]);

        $result = "";
        foreach ($stream as $response) {
            $this->info(time() . ": " . $response->choices[0]->text);
            $result = $result . $response->choices[0]->text;
        }
        $this->info('Finish! ' . $result);
    }

    public function testAssistant()
    {
//        $assistant = OpenAI::assistants()->create([
//            'instructions' => 'You are my cute girlfriend. You will chat with me so cute, lovely and romantic',
//            'name' => 'Cute GirlFriend',
//            'model' => 'gpt-4',
//        ]);
//        dd($assistant);
        // assistant id: asst_kQteIfvIs2rdCHbsZMXqYwz0
        // thread id: thread_tqI781W44v23xxoRls4UEIPW


//        $thread = OpenAI::threads()->createAndRun([
//            'assistant_id' => 'asst_kQteIfvIs2rdCHbsZMXqYwz0',
//            'thread' => [
//                'messages' =>
//                    [
//                        [
//                            'role' => 'user',
//                            'content' => 'Hello',
//                        ],
//                    ],
//            ],
//        ]);
//        dd($thread);


//        $thread = OpenAI::threads()->retrieve('thread_tqI781W44v23xxoRls4UEIPW');
//        dd($thread);

//        $message = OpenAI::threads()->messages()->create('thread_tqI781W44v23xxoRls4UEIPW',[
//            'role' => 'user',
//            'content' => 'Hello',
//        ]);

        $message = OpenAI::threads()->messages()->list('thread_yBkIuX4KYnK3lucOLN2e4R55', [
            "assistant_id" => "asst_iJv9FktEjuavS4mA6jhU0AN5Run"
        ]);
        $run_retrieve = OpenAI::threads()->runs()->retrieve('thread_yBkIuX4KYnK3lucOLN2e4R55', 'run_dkiimf65srzY2JGXcPEUsRn0');

        dd($message['data'][0], $run_retrieve);

//          run id: run_YeFgZDxojP4I6UPx42vEPTvG
//        $run = OpenAI::threads()->runs()->create("thread_tqI781W44v23xxoRls4UEIPW", [
//            "assistant_id" => "asst_kQteIfvIs2rdCHbsZMXqYwz0"
//        ]);
//        dd($run);

//        $run = OpenAI::threads()->runs()->retrieve("thread_tqI781W44v23xxoRls4UEIPW", "run_YeFgZDxojP4I6UPx42vEPTvG");
//        dd($run);

    }

    public function createAccessToken()
    {
        $client_id = $this->ask("Client ID");
        $name = $this->ask("Name");
        $type = $this->ask("Type");
        $ads = $this->ask("Ads");
        $data = [
            'device_id' => StringHelper::filter($client_id),
            'name' => StringHelper::filter($name),
            'type' => $type,
            'active' => 1,
//            'coins' => 10,
        ];
        $device = DeviceSet::createOrFind($data);
        $access_token = JwtHelper::createTokenDevice([
            'user_id' => 0,
            'device_id' => $device != null ? $device->id : 0,
            'type' => $type,
//            'ads' => $ads,
            'name' => StringHelper::filter($name),
//            'coins' => $device->coins,
            'client_id' => StringHelper::filter($client_id)
        ], 1);
        $this->info($access_token);
    }

    public function formatValue()
    {
//        $html = file_get_contents(base_path('text.txt'));
        $queue = Queue::where('id', 3)->first();
        $html = $queue->value['choices'][0]['message']['content'];
        $regex = '/\\\\\((.*?)\\\\\)|\\\\\[(.*?)\\\\\]/s';
// Tìm tất cả các biểu thức toán học trong chuỗi
        preg_match_all($regex, $html, $matches);
        $mathExpressions = $matches[0];

// Hiển thị các biểu thức toán học
        $maths = [];
        foreach ($mathExpressions as $index => $expression) {
            $maths[] = $expression;
//        echo "Biểu thức " . ($index + 1) . ": " . $expression . "\n";
        }
        $maths_md5 = array_map(function ($item) {
            return [
                'value' => $item,
                'md5' => md5($item)
            ];
        }, $maths);
        //Math to md5
        foreach ($maths_md5 as $index => $math) {
            $html = str_replace($math['value'], $math['md5'], $html);
        }
        $html = \Illuminate\Support\Str::markdown($html);
        foreach ($maths_md5 as $index => $math) {
            $html = str_replace($math['md5'], $math['value'], $html);
        }

        Storage::disk('public')->put('text.html', $html);
    }

    public function createTokenDevice()
    {
        $device_id = $this->ask("Device ID :");
        $name = $this->ask("Name: ");
        $type = (int)$this->ask("Type: ");
        $data = [
            'device_id' => $device_id,
            'name' => $name,
            'type' => $type
        ];
        $token_new = JwtHelper::createTokenDevice($data);
        $this->info("Token New: $token_new");

        print_r($data);
        $data = json_encode($data);
        $token = AppHelper::encodeOpenSsl($data);
        $this->info("Token: $token");
        $decode = AppHelper::decodeOpenSsl($token);
        dd($decode, json_decode($decode, 1));
    }

    function checkToken()
    {
        $token = $this->ask("Access Token:");
        $secret = $this->ask("Key");
        $token_info = JWT::decode($token, new Key($secret, 'HS256'));
        dd($token_info);
    }

    function genTokenAppHelper()
    {
        $token = AppHelper::getAccessTokenAndSaveCookie(true);
        dd($token);
    }
}
