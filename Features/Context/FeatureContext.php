<?php

namespace Rithis\SkeletonBundle\Features\Context;

use Behat\Symfony2Extension\Context\KernelDictionary,
    PHPUnit_Framework_Assert as Assert,
    Behat\Behat\Context\BehatContext;

use Symfony\Component\HttpKernel\Bundle\BundleInterface;

class FeatureContext extends BehatContext
{
    use KernelDictionary;

    /**
     * @var array
     */
    private $bundles;

    /**
     * @Given /^список зарегистрированных бандлов$/
     */
    public function bundlesList()
    {
        $this->bundles = $this->getContainer()->get('kernel')->getBundles();
    }

    /**
     * @Then /^должен быть зарегистрирован "([^"]*)"$/
     */
    public function mustBeRegistered($bundleName)
    {
        $bundles = array_filter($this->bundles, function (BundleInterface $bundle) use($bundleName) {
            return $bundle->getName() == $bundleName;
        });

        Assert::assertCount(1, $bundles, "Бандл не зарегистрирован");
    }
}
