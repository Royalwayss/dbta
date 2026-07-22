<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class CronController extends Controller
{
    public function taxfeed()
    {
        $SCRAPERAPI_KEY = env('SCRAPERAPI_KEY');

        // Use public_path() so this resolves to /public/front/tax-feeds
        // regardless of where the controller file lives.
        $dataDir = public_path('front/tax-feeds');

        $feeds = [
            'press-release' => 'https://www.incometaxindia.gov.in/press-release-rss-feed/-/asset_publisher/bxhj/rss',
            'circular'      => 'https://www.incometaxindia.gov.in/circular-rss-feed/-/asset_publisher/bxhj/rss',
            'notifications' => 'https://www.incometaxindia.gov.in/notification-rss-feed/-/asset_publisher/bxhj/rss',
        ];

        if (!is_dir($dataDir)) {
            mkdir($dataDir, 0755, true);
        }

        $isCli = (php_sapi_name() === 'cli');
        $log = [];

        foreach ($feeds as $key => $targetUrl) {
            $log[] = "Fetching $key ...";

            $apiUrl = 'https://api.scraperapi.com/?api_key=' . urlencode($SCRAPERAPI_KEY)
                . '&url=' . urlencode($targetUrl);
            // NOTE: render=true intentionally omitted — browser rendering wraps XML
            // responses in an HTML viewer, which breaks RSS parsing. Plain proxy
            // mode returns the raw XML bytes directly.

            $curl = curl_init($apiUrl);
            curl_setopt_array($curl, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 60,
            ]);
            $xml = curl_exec($curl);
            $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            $curlError = curl_error($curl);
            curl_close($curl);

            if ($xml === false) {
                $log[] = "  FAILED: cURL error: $curlError";
                continue;
            }
            if ($httpCode !== 200) {
                $log[] = "  FAILED: HTTP $httpCode. Response start: " . substr($xml, 0, 200);
                continue;
            }

            // Validate it's actually the RSS structure before overwriting saved file
            libxml_use_internal_errors(true);
            $rss = simplexml_load_string($xml);

            if ($rss === false || !isset($rss->channel) || !isset($rss->channel->item)) {
                $log[] = "  FAILED: Response was not valid RSS. Response start: " . substr($xml, 0, 200);
                continue; // Keep the previously saved XML file untouched
            }

            // Save raw XML
            file_put_contents("$dataDir/$key.xml", $xml);

            $itemCount = count($rss->channel->item);
            $log[] = "  OK: $itemCount items saved to $key.xml";
        }

        $log[] = 'Done at ' . gmdate('c');

        $output = implode("\n", $log) . "\n";

        // CLI (artisan/scheduler) just echoes; HTTP requests get a proper Response.
        if ($isCli) {
            echo $output;
            return;
        }

        return response($output, 200)
            ->header('Content-Type', 'text/plain; charset=UTF-8');
    }
}