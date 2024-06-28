<?php

namespace ContainerWOjLbvS;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getConsole_Command_CachePoolPruneService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'console.command.cache_pool_prune' shared service.
     *
     * @return \Symfony\Bundle\FrameworkBundle\Command\CachePoolPruneCommand
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/console/Command/Command.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/framework-bundle/Command/CachePoolPruneCommand.php';

        $container->privates['console.command.cache_pool_prune'] = $instance = new \Symfony\Bundle\FrameworkBundle\Command\CachePoolPruneCommand(new RewindableGenerator(function () use ($container) {
            yield 'cache.app' => ($container->services['cache.app'] ?? self::getCache_AppService($container));
            yield 'cache.system' => ($container->services['cache.system'] ?? self::getCache_SystemService($container));
            yield 'cache.validator' => ($container->privates['cache.validator'] ?? self::getCache_ValidatorService($container));
            yield 'cache.serializer' => ($container->privates['cache.serializer'] ?? self::getCache_SerializerService($container));
            yield 'cache.annotations' => ($container->privates['cache.annotations'] ?? self::getCache_AnnotationsService($container));
            yield 'cache.property_info' => ($container->privates['cache.property_info'] ?? self::getCache_PropertyInfoService($container));
        }, 6));

        $instance->setName('cache:pool:prune');
        $instance->setDescription('Prune cache pools');

        return $instance;
    }
}
