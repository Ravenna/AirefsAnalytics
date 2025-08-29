<?php
namespace Ravenna\AirefsAnalytics;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class AirefsClient
{
    protected $token;

    public function __construct()
    {
        $this->token = config('airefs-analytics.token');
    }

    public function sendEvent(array $data)
    {
        Log::info($data);
        if (!$this->token) return;

        return Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
            'Content-Type' => 'application/json',
        ])->post('https://api.getairefs.com/v1/events', $data);
    }
}