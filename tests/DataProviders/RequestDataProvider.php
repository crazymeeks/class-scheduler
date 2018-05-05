<?php


namespace Tests\DataProviders;


use Scheduler\App\Http\Requests\BlockFormRequest;

class RequestDataProvider
{

	/**
	 * @var Scheduler\App\Http\Requests\BlockFormRequest
	 */
	protected $request;

	public function __construct()
	{
		$this->request = new BlockFormRequest;
	}

	/**
	 * Blocks module data provider
	 * 
	 * @return array
	 */
	public function blockModuleCreateRequest()
	{

		$this->request->replace([
			'code' => $this->getBlockCode(),
			'levels' => [1,2],
		]);

		return [
			array($this->request, $this->apiUrl())
		];
	}

	/**
	 * Update module data provider
	 * 
	 * @return
	 */
	public function blockModuleUpdateRequest()
	{

		$request = new BlockFormRequest;
		$request->replace([
			'code' => $this->getBlockCode(),
			'levels' => [1,2],
		]);

		$this->request->replace([
			'id'  => 1,
			'code' => $this->getBlockCode(),
			'levels' => [1,2,3],
		]);

		return [
			array($request, $this->request, $this->apiUrl())
		];
	}

	/**
	 * Generate test block code
	 * 
	 * @return string
	 */
	private function getBlockCode()
	{
		$name = ['COP', 'BSIT'];

		for($a = 1; $a <= 6; $a++){
			$blocks[] = $a;
		}

		$block = $name[rand(0,1)] . rand(1,6) . 'BLK' . $blocks[rand(1,5)];

		return $block;
	}

	private function apiUrl()
    {
        return '/admin/blocks/';
    }
	
}