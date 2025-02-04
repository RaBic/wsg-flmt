<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ApiResponseHeaders
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request); // ->header('Content-Encoding', 'deflate, gzip');

        // Get the initial method sent by client
        $initialMethod = $request->method();

        // Force to get in order to receive content
        $request->setMethod('get');

        // Get response
        /** @var Response $response */
        $response = $next($request);

        // Generate Etag
        $etag = md5(json_encode($response->headers->get('origin')) . (string) $response->getContent());
        // Load the Etag sent by client
        $requestIfNoneMatch = str_replace('"', '', $request->headers->get('if-none-match'));
        // Check to see if Etag has changed
        if ($requestIfNoneMatch && $requestIfNoneMatch == $etag) {
            $response->setNotModified();
        }
        // Set Etag
        $response->setEtag($etag);

        $content = $response->getContent();
        if ($response->getStatusCode() < 300 && ! empty($content)) {
            $data = json_decode($response->getContent(), true)['data'];
            $lastModifiedString = $data['updated_at'] ?? (collect($data)->pluck('updated_at')->max() ?? null);

            if ($lastModifiedString) {
                // Load the IfModifiedSince sent by client
                $requestIfModifiedSinceString = $request->headers->get('if-modified-since');

                $lastModified = Carbon::parse($lastModifiedString);

                if ($requestIfModifiedSinceString && Carbon::parse($requestIfModifiedSinceString) > $lastModified) {
                    $response->setNotModified();
                }

                $response->setLastModified($lastModified);
            }
        }

        // Set back to original method
        $request->setMethod($initialMethod); // set back to original method

        return $response;
    }
}
