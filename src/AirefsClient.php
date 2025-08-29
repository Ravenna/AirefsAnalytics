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
        if (!$this->token) {
            Log::warning('AirefsClient: Missing API token, event not sent.');
            return null;
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->token,
                'Accept'        => 'application/json',
                'Content-Type'  => 'application/json',
            ])->post('https://api.getairefs.com/v1/events', $data);

            // Log status and body for debugging
            Log::info('AirefsClient response', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);
            
            return $response;
        } catch (\Exception $e) {
            Log::error('AirefsClient error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);
            return null;
        }
    }
}
