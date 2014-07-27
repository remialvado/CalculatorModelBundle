<?php

namespace Acme\CalculatorModelBundle\CompilerPass;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class OperatorCompilerPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (false === $container->hasDefinition('acme.calculator.operator.factory')) {
            return;
        }

        $definition = $container->getDefinition('acme.calculator.operator.factory');

        foreach ($container->findTaggedServiceIds('acme.calculator.operator') as $id => $attributes) {
            $definition->addMethodCall('addOperator', array(new Reference($id)));
        }
    }
}