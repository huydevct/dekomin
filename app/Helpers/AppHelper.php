<?php

namespace App\Helpers;

use App\Jobs\SendMailRemind;
use App\Models\User;
use App\Models\Device;
use Illuminate\Support\Str;
use App\Services\Queues\QueueGet;
use App\Services\Devices\DeviceGet;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Jenssegers\Agent\Facades\Agent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Ngocnm\LaravelHelpers\jobs\SendMessageToSlack;

class AppHelper
{
    // static function formatNumber($number, $noLetter = false)
    // {
    //     if ($number < 1000) {
    //         return strval($number);
    //     } elseif ($number < 1000000) {
    //         $formattedNumber = number_format($number / 1000, ($number % 1000 !== 0) ? 1 : 0);
    //         return $formattedNumber . 'K';
    //     } else {
    //         // For millions and above, format to millions with one decimal place, if not a whole million
    //         $formattedNumber = number_format($number / 1000000, ($number % 1000000 !== 0) ? 1 : 0);
    //         return $formattedNumber . 'M';
    //     }
    // }
    static function formatNumber($number, $noLetter = false)
    {
        $n_format = number_format($number);

        return $n_format;
    }

    static function formatValue($html){
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

        return $html;
    }

    static function createPathSaveFileByUrl(string $url){
        $name_exp = explode(".", $url);
        $type = end($name_exp);
        $type = Str::slug($type, '');
        if (!empty($type) && strlen($type) < 6) {
            $type = "$type";
        } else {
            $type = '';
        }
        return self::createPathSaveFile($type);
    }

    static function createPathSaveFile(string $type = null)
    {
        if (!empty($type)) {
            $type = ".$type";
        }
        return date("y/m/d/H") . "/" . time() . "_" . Str::random(5) . $type;
    }


    static function HeadTag()
    {
        return HeadTag::getInstance();
    }

    static function generateUuid()
    {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),

            // 16 bits for "time_mid"
            mt_rand(0, 0xffff),

            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand(0, 0x0fff) | 0x4000,

            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand(0, 0x3fff) | 0x8000,

            // 48 bits for "node"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }

    static function encodeOpenSsl(string $string, $key = null): string
    {
        $ivSize = openssl_cipher_iv_length('AES-256-CBC');
        $iv = openssl_random_pseudo_bytes($ivSize);
        $key_verify = config('auth.openssl.device_secret');
        if (!empty($key)) {
            $key_verify = $key;
        }
        $encrypted = openssl_encrypt($string, 'AES-256-CBC', $key_verify, OPENSSL_RAW_DATA, $iv);
        $encoded = base64_encode($iv . $encrypted);
        return $encoded;
    }

    static function decodeOpenSsl(string $string, $key = null): string
    {
        $decoded = base64_decode($string);
        $ivSize = openssl_cipher_iv_length('AES-256-CBC');
        $iv = substr($decoded, 0, $ivSize);
        $encrypted = substr($decoded, $ivSize);
        $key_verify = config('auth.openssl.device_secret');
        if (!empty($key)) {
            $key_verify = $key;
        }
        $decrypted = openssl_decrypt($encrypted, 'AES-256-CBC', $key_verify, OPENSSL_RAW_DATA, $iv);
        return $decrypted;
    }

    static function AuthApi()
    {
        return AuthApi::getInstance();
    }

    static function createPathFileStorageTmp($type, $type_file)
    {
        return 'temp/' . date("H") . "/$type/" . time() . "_" . Str::random(10) . ".$type_file";
    }

    static function createFolderPathFileStorageTmp($type, $time = 0)
    {
        $time_now = $time == 0 ? time() : $time;
        return 'temp/' . date("H", $time_now) . "/$type/";
    }

    static function printLogQueue(string $string)
    {
        echo $string . PHP_EOL;
    }

    static function doc_to_text( $path_to_file )
    {
        $fileHandle = fopen($path_to_file, 'r');
        $line       = @fread($fileHandle, filesize($path_to_file));
        $lines      = explode(chr(0x0D), $line);
        $response   = '';

        foreach ($lines as $current_line) {

            $pos = strpos($current_line, chr(0x00));

            if ( ($pos !== FALSE) || (strlen($current_line) == 0) ) {

            } else {
                $response .= $current_line . ' ';
            }
        }

        $response = preg_replace('/[^a-zA-Z0-9\s\,\.\-\n\r\t@\/\_\(\)]/', '', $response);

        return $response;
    }

    static function get_valid_file_types()
    {
        return [
            'doc',
            'docx',
            'pptx',
            'xlsx',
            'pdf'
        ];
    }

    static function pdf_to_text( $path_to_file ) {

        if ( class_exists( '\\Smalot\\PdfParser\\Parser') ) {

            $parser   = new \Smalot\PdfParser\Parser();
            $pdf      = $parser->parseFile( $path_to_file );
            $response = $pdf->getText();

        } else {

            throw new \Exception('The library used to parse PDFs was not found.' );
        }

        return $response;

    }

    static function convert_to_text( $path_to_file )
    {
        if (isset($path_to_file) && file_exists($path_to_file)) {

            $valid_extensions = self::get_valid_file_types();

            $file_info = pathinfo($path_to_file);
            $file_ext  = strtolower($file_info['extension']);

            if (in_array( $file_ext, $valid_extensions )) {

                $method   = $file_ext . '_to_text';
                $response = self::$method( $path_to_file );

            } else {
                return 'Invalid file type provided. Valid file types are doc, docx, xlsx or pptx.';
            }
        } else {
            return 'Invalid file provided. The file does not exist.';
        }

        return $response;
    }

    static function docx_to_text( $path_to_file )
    {
        $response = '';
        $zip      = zip_open($path_to_file);

        if (!$zip || is_numeric($zip)) return false;

        while ($zip_entry = zip_read($zip)) {

            if (zip_entry_open($zip, $zip_entry) == FALSE)
                continue;

            if (zip_entry_name($zip_entry) != 'word/document.xml')
                continue;

            $response .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));

            zip_entry_close($zip_entry);
        }

        zip_close($zip);

        $response = str_replace('</w:r></w:p></w:tc><w:tc>', ' ', $response);
        $response = str_replace('</w:r></w:p>', "\r\n", $response);
        $response = strip_tags($response);

        return $response;
    }

    static function googleGetInfo($access_token)
    {
        try {
            $user_google_info = file_get_contents("https://www.googleapis.com/oauth2/v1/userinfo?access_token=" . $access_token);
            $user_google_info = json_decode($user_google_info, 1);
            if (isset($user_google_info['id'])) {
                $user_google_info['status_login'] = true;
            } else {
                $user_google_info['status_login'] = false;
            }
            return $user_google_info;
        } catch (\Exception $e) {
            Log::error("Google verify error: {$e->getMessage()}");
            return null;
        }
    }

    static function getClientIdAndNameDevice(): array
    {
        $name_device = Agent::platform() . ' ' . Agent::browser();
        $client_id = md5(Request::ip() . Request::userAgent());
        return [
            $name_device,
            $client_id
        ];
    }

    static function decreaseCoins()
    {
//        $word_count = str_word_count($sentence);
        $user_id = AppHelper::AuthApi()->getUserId();
        $coins = 0;
        if (!empty($user_id)) {
            $user = User::where('id', $user_id)->first();
//            $user->coins = $user->coins - ($word_count * config('coins.word'));
            $user->coins = $user->coins - config('coins.request');
            $coins = $user->coins;
            $user->save();
        } else {
            $device = Device::where('id', AppHelper::AuthApi()->getDeviceId())->first();
//            $device->coins = $device->coins - ($word_count * config('coins.word'));
            $device->coins = $device->coins - config('coins.request');
            $coins = $device->coins;
            $device->save();
        }
//        if (!empty($user_id) && $coins <= 1) {
//            dispatch(new SendMailRemind($user_id))->onQueue('send-mail-remind');
//        }
    }

    static function getAccessTokenAndSaveCookie($replace_cookie = false)
    {
        if (Agent::isRobot()) {
            return null;
        }
        list($name_device, $client_id) = self::getClientIdAndNameDevice();
        $device_id = 0;
        if (Cookie::has('access_token')) {
//            dd(Cookie::get('access_token'));
            //Kiểm tra và replace lại token nếu đã có device_id
//            $decode_token = AppHelper::AuthApi()->verifyToken(Cookie::get('access_token'));
//            if($decode_token){
//                $device_id_from_access_token = AppHelper::AuthApi()->getDeviceIdNoCreate();
//                if($device_id_from_access_token==0){
//                    $device = DeviceGet::getDeviceByClientId($client_id);
//                    if($device){
//                        $device_id = $device->id;
//                        $replace_cookie = true;
//                    }
//                }
//            }
            if (!$replace_cookie) {
                return [
                    'client_id' => $client_id,
                    'access_token' => Cookie::get('access_token')
                ];
            }
        }
        $device = DeviceGet::getDeviceByClientId($client_id);
        if ($device) {
            $device_id = $device->id;
        }
        $access_token = JwtHelper::createTokenDevice(
            [
                'user_id' => Auth::check() ? Auth::user()->id : 0,
                'device_id' => $device_id,
                'type' => 3,
                'client_id' => $client_id,
                'ip' => Request::ip(),
                'name' => $name_device,
                'coins' => $device->coins ?? 10,
            ],
            3,
        );
        Cookie::queue(cookie('access_token', $access_token, 150));
        return [
            'client_id' => $client_id,
            'access_token' => $access_token
        ];
    }

    static function getImageFromFileName($file_name)
    {
        $config = [
            'jpg' => '/assets/img/photo.png',
            'jpeg' => '/assets/img/photo.png',
            'png' => '/assets/img/photo.png',
            'doc' => '/assets/img/docx.png',
            'docx' => '/assets/img/docx.png',
            'pptx' => '/assets/img/ppt.png',
            'txt' => '/assets/img/txt.png',
            'xsl' => '/assets/img/excel.png',
            'pdf' => '/assets/img/pdf-file.png'

        ];
        $type_file = explode(".", $file_name);
        $type_file = end($type_file);
        if (isset($config[$type_file])) {
            return $config[$type_file];
        }
        return '/assets/img/file.png';
    }

    static function fileExistStorage($path)
    {
        return Storage::disk(config('filesystems.tmp_disk'))->exists($path);
    }

    static function getUrlWithLocale(string $url)
    {
        $locale = App::currentLocale();
        if ($locale == 'en') {
            return $url;
        }
        return "/$locale" . $url;
    }

    static function sendLog($message_log)
    {
        $ip = config('app.ip_server');
        $message = "- Source: " . config('app.name') . ": " . $ip;
        $message .= "\n- Path: " . url()->full();
        $message .= "\n- Method: " . Request::method();
        $message .= "\n- Client IP: " . Request::ip();
        $message .= "\n- User agent: " . Request::userAgent();
        if (isset($_SERVER['argv'])) {
            $command = '';
            if (is_string($_SERVER['argv'])) {
                $command = $_SERVER['argv'];
            } else if (is_array($_SERVER['argv'])) {
                $command = implode(' ', $_SERVER['argv']);
            }
            $message .= "\n- RunCommand : $command";
        }
        $message .= "\n- Error: " . $message_log;
        $message .= "\n- Date: " . date('H:i:s d/m/Y');
        dispatch(new SendMessageToSlack($message, 'error'))->onQueue('send-log');
    }

    static function getCoin()
    {
        $user = Auth::user();
        if (!empty($user)) {
            return $user->coins;
        }
        $client_id = self::getClientIdAndNameDevice();
        $device = Device::where('device_id', $client_id[1])->first();
        if (!empty($device)) {
            return $device->coins;
        }
        return config('coins.default');
    }
}
