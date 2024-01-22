<?

namespace App\Decorators;

use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Log\LoggerInterface;

class LoggingEventDispatcherDecorator implements EventDispatcherInterface
{
    protected $eventDispatcher;
    protected $logger;

    public function __construct(EventDispatcherInterface $eventDispatcher, LoggerInterface $logger)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->logger = $logger;
    }

    public function dispatch(object $event)
{
    $eventName = get_class($event);

    $this->logger->info("Dispatching event: {$eventName}");

    try {
        $result = $this->eventDispatcher->dispatch($event);
        $this->logger->info("Event dispatched successfully: {$eventName}");
        return $result;
    } catch (\Exception $e) {
        $this->logger->error("Error dispatching event: {$eventName}. Error: {$e->getMessage()}");
        throw $e;
    }
}
}
    