<?php

namespace Acme\CalculatorModelBundle;

use Acme\CalculatorModelBundle\CompilerPass\OperatorCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AcmeCalculatorModelBundle extends Bundle
{
    /**
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new OperatorCompilerPass());
    }
}
