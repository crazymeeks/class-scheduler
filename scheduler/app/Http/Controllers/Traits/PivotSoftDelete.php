<?php

namespace Scheduler\App\Http\Controllers\Traits;

use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
trait PivotSoftDelete
{

	/**
	 * Mark pivot as soft deleted by inserting
	 * data to deleted_at column
	 * 
	 * @param  string $table       The name of the table
	 * @param  string $whereColumn The column to check using where()
	 * @param  mixed $value       The column value
	 * 
	 * @return void
	 */
	public function softDelete($table, $whereColumn, $value)
	{

		if ($this->columnExist($table)) {
			DB::transaction(function() use($table, $whereColumn, $value){

				DB::table($table)->where($whereColumn, '=', $value)->update(['deleted_at' => Carbon::now()]);
			});
		}
	}

	/**
	 * Check if deleted_at column exist in pivot table
	 * 
	 * @param  string $table     The name of the table
	 * 
	 * @return bool
	 */
	public function columnExist($table)
	{
		return Schema::hasColumn($table, 'deleted_at');
	}


}