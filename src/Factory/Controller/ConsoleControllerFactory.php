<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\Bernard\Factory\Controller;

use Bernard\Consumer;
use Bernard\QueueFactory;
use InteractiveSolutions\Bernard\BernardOptions;
use InteractiveSolutions\Bernard\Controller\ConsoleController;
use InteractiveSolutions\Bernard\Producer;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ConsoleControllerFactory implements FactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator):ConsoleController
    {
        $sl = $serviceLocator->getServiceLocator();

        /* @var $options BernardOptions */
        $options = $sl->get(BernardOptions::class);

        /* @var $consumer Consumer */
        $consumer = $sl->get(Consumer::class);

        /* @var $producer Producer */
        $producer = $sl->get(Producer::class);

        /* @var $queue QueueFactory */
        $queue = $sl->get($options->getQueueInstanceKey());

        return new ConsoleController($producer, $consumer, $queue);
    }
}
