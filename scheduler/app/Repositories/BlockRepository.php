<?php

namespace Scheduler\App\Repositories;

use DB;
use Scheduler\App\Models\Block;
use Scheduler\App\Http\Requests\BlockFormRequest;
use Scheduler\App\Exceptions\DBTransactionException;

class BlockRepository
{

	/**
	 * Save or update data from request
	 *
	 * @param  BlockFormRequest $request
	 * 
	 * @return bool
	 */
	public function saveFromRequest(BlockFormRequest $request, Block $block)
	{
		try {
			DB::transaction(function() use ($block, $request){

				$block->fill($request->toArray());

				$block->save();

				$block->levels()->sync($request->levels);

			});

		} catch (\Exception $e) {
			throw new DBTransactionException($e->getMessage(), $e->getCode());
		}

		return true;
	}

	/**
	 * Delete block
	 *
	 * @param  int $id      The model id
	 *
	 * @return  bool
	 *
	 * @todo  Check if model successfully deleted
	 */
	public function delete($id)
	{
		Block::find($id)->delete();

		return true;
	}
}