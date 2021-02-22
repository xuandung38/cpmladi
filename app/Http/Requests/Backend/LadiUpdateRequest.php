<?php

namespace App\Http\Requests\Backend;

use App\Http\Requests\BaseRequest;

class LadiUpdateRequest extends BaseRequest
{
	public function rules()
	{
		return array_merge(parent::rules(), [
			'code' => 'required'
		]);
	}

	/**
	 * Prepare parameters from Form Request.
	 *
	 * @return array
	 */
	public function parameters()
	{
		return [
			'code' => $this->has('code')
		];
	}
}