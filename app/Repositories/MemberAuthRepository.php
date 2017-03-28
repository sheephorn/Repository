<?php

namespace App\Repositories;

use App\Repositories\Eloquents\Member_auth;

/**
 * Class MemberAuthRepository
 */
class MemberAuthRepository extends BaseRepository
{
	protected $model;

	public function __construct(Member_auth $memberAuth)
	{
		$this->model = $memberAuth;
	}
}
