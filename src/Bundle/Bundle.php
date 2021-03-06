<?php
namespace Simovative\Zeus\Bundle;

use Simovative\Zeus\Command\CommandRequestRouterChain;
use Simovative\Zeus\Http\Get\HttpGetRequestRouterChain;
use Simovative\Zeus\Command\ApplicationController;
use Simovative\Zeus\Dependency\MasterFactory;
use Simovative\Zeus\Dependency\FactoryInterface;

/**
 * @author mnoerenberg
 */
abstract class Bundle implements BundleInterface {
	
	/**
	 * @var FactoryInterface
	 */
	protected $bundleFactory;
	
	/**
	 * @author mnoerenberg
	 * @return FactoryInterface
	 */
	abstract protected function createBundleFactory();
	
	/**
	 * @author mnoerenberg
	 * @return FactoryInterface
	 */
	protected function getBundleFactory() {
		if (! $this->bundleFactory instanceof FactoryInterface) {
			$this->bundleFactory = $this->createBundleFactory();
		}
		return $this->bundleFactory;
	}
	
	/**
	 * @inheritdoc
	 * @author mnoerenberg
	 * @param MasterFactory $masterFactory
	 */
	public function registerFactories(MasterFactory $masterFactory) {
		$masterFactory->register($this->getBundleFactory());
	}
	
	/**
	 * @inheritdoc
	 * @author mnoerenberg
	 * @param HttpGetRequestRouterChain $router
	 */
	public function registerGetRouters(HttpGetRequestRouterChain $router) {}
	
	/**
	 * @inheritdoc
	 * @author mnoerenberg
	 * @param CommandRequestRouterChain $router
	 */
	public function registerPostRouters(CommandRequestRouterChain $router) {}
	
	/**
	 * @inheritdoc
	 * @author mnoerenberg
	 * @param ApplicationController $applicationController
	 */
	public function registerBundleController(ApplicationController $applicationController) {}
}
