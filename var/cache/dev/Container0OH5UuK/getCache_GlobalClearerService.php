<?php

namespace Container0OH5UuK;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getCache_GlobalClearerService extends App_KernelDevDebugContainer
{
    /**
     * Gets the public 'cache.global_clearer' shared service.
     *
     * @return \Symfony\Component\HttpKernel\CacheClearer\Psr6CacheClearer
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/http-kernel/CacheClearer/CacheClearerInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/http-kernel/CacheClearer/Psr6CacheClearer.php';

        return $container->services['cache.global_clearer'] = new \Symfony\Component\HttpKernel\CacheClearer\Psr6CacheClearer(['cache.app' => ($container->services['cache.app'] ?? self::getCache_AppService($container)), 'cache.system' => ($container->services['cache.system'] ?? self::getCache_SystemService($container)), 'cache.validator' => ($container->privates['cache.validator'] ?? self::getCache_ValidatorService($container)), 'cache.serializer' => ($container->privates['cache.serializer'] ?? self::getCache_SerializerService($container)), 'cache.annotations' => ($container->privates['cache.annotations'] ?? self::getCache_AnnotationsService($container)), 'cache.property_info' => ($container->privates['cache.property_info'] ?? self::getCache_PropertyInfoService($container))]);
    }
}
