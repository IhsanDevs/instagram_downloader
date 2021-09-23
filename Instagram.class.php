<?php  

namespace IhsanDevs\InstagramDownloader;

use simple_html_dom;

require __DIR__ . '/lib/simple_html_dom.php';
class InstagramDownloader {
    protected static $ModeJsonResults;

    // Set results mode. ['false' is default].
    public function __construct($ModeJsonResults = false)
    {
        self::$ModeJsonResults = $ModeJsonResults;
    }

    // Make Get Source Code Method
    private static function GetSource($url)
    {
        $ch = curl_init('https://downloadgram.org/');
        curl_setopt_array($ch, [
            CURLOPT_POST => TRUE,
            CURLOPT_POSTFIELDS => [
                'url' => $url
            ],
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_FOLLOWLOCATION => TRUE,
            CURLOPT_HTTPHEADER => [
                'content-type' => 'application/x-www-form-urlencoded',
                'user-agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.54 Safari/537.36',
                'accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
                'sec-fetch-site' => 'same-origin',
                'sec-fetch-mode' => 'navigate',
                'sec-fetch-user' => '?1',
                'sec-fetch-dest' => 'document',
                'referer' => 'https://downloadgram.org/',
                'accept-encoding' => 'gzip, deflate, br',
                'origin' => 'https://downloadgram.org/'
            ],
            CURLOPT_COOKIESESSION => TRUE
        ]);
        $results = curl_exec($ch);
        if (!curl_errno($ch)) {
            return $results;
        } else {
            return false;
        }
    }

    // Make Instagram Downloader
    public static function Download($url)
    {
        $GetSource = self::GetSource($url);
        $dom = new simple_html_dom();
        $dom = str_get_html($GetSource);
        
        $poster = $dom->find('video.control-video', 0)->getAttribute('poster');
        $source = $dom->find('source', 0)->getAttribute('src');
        $dl = $dom->find('div[id=downloadBox] a', 0)->getAttribute('href');
        return [
            'poster' => $poster,
            "source" => $source,
            "dl" => $dl
        ];
    }
}
?>