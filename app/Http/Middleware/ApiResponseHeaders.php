<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ApiResponseHeaders
{
    public function handle(Request $request, Closure $next): JsonResponse
    {
        // Get the initial method sent by client
        $initialMethod = $request->method();

        // Force to get in order to receive content
        $request->setMethod('get');

        // Get response
        $response = $next($request);

        // Generate Etag
        $etag = md5(json_encode($response->headers->get('origin')) . (string) $response->getContent());
        // Load the Etag sent by client
        $ifNoneMatchHeader = $request->headers->get('if-none-match');
        $requestIfNoneMatch = $ifNoneMatchHeader ? str_replace('"', '', $ifNoneMatchHeader) : null;
        // Check to see if Etag has changed
        if ($requestIfNoneMatch && $requestIfNoneMatch == $etag) {
            $response->setNotModified();
        }
        // Set Etag
        $response->setEtag($etag);

        $content = $response->getContent();
        if ($response->getStatusCode() < 300 && ! empty($content)) {
            $responseContent = json_decode($response->getContent(), true);
            $data = [];
            if (is_array($responseContent) && isset($responseContent['data'])) {
                $data = $responseContent['data'];
            }

            $lastModifiedString = null;
            if (is_array($data)) {
                if (isset($data['updated_at'])) {
                    $lastModifiedString = $data['updated_at'];
                } elseif (is_array($data)) {
                    $lastModifiedString = collect($data)->pluck('updated_at')->max();
                }
            }

            if ($lastModifiedString && is_string($lastModifiedString)) {
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
