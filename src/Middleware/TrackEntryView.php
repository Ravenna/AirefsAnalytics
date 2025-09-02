<?php
namespace Ravenna\AirefsAnalytics\Middleware;

use Closure;
use Statamic\Facades\Entry;
use Ravenna\AirefsAnalytics\AirefsClient;
use Statamic\Facades\Site;

class TrackEntryView
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $entry = Entry::findByUri('/' . ltrim($request->path(), '/'), Site::current()->handle());


        if ($entry && method_exists($entry, 'id')) {
            $client = new AirefsClient();
            $client->sendEvent([
                'name' => 'pageview',
                'url' => $request->fullUrl(),
                'headers' => [
                    'user-agent' => $request->userAgent(),
                    'referer' => $request->header('referer', ''),
                ],
                'entry' => [
                    'id' => $entry->id(),
                    'slug' => $entry->slug(),
                    'title' => $entry->get('title'),
                ]
            ]);
        }
        return $response;
    }
}
