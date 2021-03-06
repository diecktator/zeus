<?php
namespace Simovative\Zeus\Http\Get;

use Simovative\Zeus\Exception\IncompleteSetupException;
use Simovative\Zeus\Exception\RouteNotFoundException;
use Simovative\Zeus\Content\Content;

/**
 * @author mnoerenberg
 */
class HttpGetRequestRouterChain {
	
	/**
	 * @var HttpGetRequestRouterInterface[]
	 */
	private $routers = array();

	/**
	 *
	 * @author mnoerenberg
	 * @param HttpGetRequestRouterInterface $router
	 * @return void
	 */
	public function register(HttpGetRequestRouterInterface $router) {
		$this->routers[] = $router;
	}
	
	/**
	 * @author mnoerenberg
	 * @author shartmann
	 * @param HttpGetRequest $request
	 * @throws RouteNotFoundException|IncompleteSetupException
	 * @return Content
	 */
	public function route(HttpGetRequest $request) {
		foreach ($this->routers as $router) {
			$result = $router->route($request);
			if ($result !== null) {
				return $result;
			}
		}
		if (empty($this->routers)) {
			throw new IncompleteSetupException('No routers registred!');
		}
		throw new RouteNotFoundException($request->getUrl());
	}
}
