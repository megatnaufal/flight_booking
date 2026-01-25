<?php
declare(strict_types=1);

namespace App\Middleware;

use App\Service\FlightScheduleService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Cake\Log\Log;

/**
 * FlightScheduleMiddleware
 * 
 * Automatically checks and regenerates flight schedules when needed.
 * Uses caching to minimize performance impact.
 */
class FlightScheduleMiddleware implements MiddlewareInterface
{
    /**
     * Process method.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request The request.
     * @param \Psr\Http\Server\RequestHandlerInterface $handler The request handler.
     * @return \Psr\Http\Message\ResponseInterface A response.
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        // Only check on GET requests to avoid slowing down form submissions
        if ($request->getMethod() === 'GET') {
            try {
                $service = new FlightScheduleService();
                $regenerated = $service->checkAndRegenerate();
                
                if ($regenerated) {
                    Log::info('Flight schedules automatically regenerated.');
                }
            } catch (\Exception $e) {
                // Log error but don't break the request
                Log::error('Flight schedule regeneration failed: ' . $e->getMessage());
            }
        }
        
        return $handler->handle($request);
    }
}
