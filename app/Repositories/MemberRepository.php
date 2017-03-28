<?php

namespace App\Repositories;

use App\Repositories\Eloquents\Member;

/**
 * Class MemberRepository
 */
class MemberRepository extends BaseRepository
{
	protected $model;

	public function __construct(Member $member)
	{
		$this->model = $member;
	}
}
