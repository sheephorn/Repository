<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
/**
 * Class BaseRepository
 */
class BaseRepository
{
    /**
     * ページ表示クエリ取得関数
     * 子クラスでオーバーライドさせる
     * @param  Object $condition Request
     * @return Object            Query
     */
    protected function createQuery($condition)
    {
        //
    }

	/**
	 * ページデータ取得
	 *
	 * @param Request $condition POSTデータ
	 * @param int $page 表示ページナンバー
	 * @param int $show １ページあたりの最大表示数
	 * @return データ配列
	 **/
	public function getPage($condition, $page, $show)
	{
		$data = $this
					->createQuery($condition)
					->forpage($page, $show)
					->get();
		return $data;
	}

	/**
	 * 全データ件数取得
	 *
	 * @param Request $condition POSTデータ
	 * @return 全データ件数
	 **/
	public function getCount($condition)
	{
		$totalcount = $this
						->createQuery($condition)
						->count();
		return $totalcount;
	}

	/**
	 * 条件によるデータ取得
	 *
	 * @param  Array $attrs 取得レコードの検索条件
     * @return Object        取得レコード
	 **/
	public function find($attrs)
	{
        $result = $this->model;
        foreach($attrs as $col => $attr) {
            $result = $result->where($col, $attr);
        }
		return $result;
	}

    /**
     * 条件によるデータ取得　ロックを同時に行う
     * @param  Array $attrs 取得レコードの検索条件
     * @return Object        取得レコード
     */
    public function findForUpdate($attrs)
    {
        $result = $this->model;
        foreach($attrs as $col => $attr) {
            $result = $result->where($col, $attr);
        }
		$result = $result
                ->lockForUpdate();
		return $result;
    }

	/**
	 * プライマリキーによるデータ取得
	 *
	 * @param $id プライマリキー
	 * @return データ
	 **/
	public function findById($id)
	{
		$result = $this->model
						->find($id);
		return $result;
	}

	/**
	 * プライマリキーによるデータ取得(ロック用)
	 *
	 * @param $id プライマリキー
	 * @return データ
	 **/
	public function findByIdForUpdate($id)
	{
		$result = $this->model
						->lockForUpdate()
						->find($id);
		return $result;
	}

	/**
	 * 全データ取得
	 *
	 * @return データ
	 **/
	public function findAll()
	{
		$result = $this->model
						->get();
		return $result;
	}

	/**
	 * 保存(updateOrCreate)
	 *
	 * @param array $attributes 対象を選択するための属性の配列
	 * @param array $params 対象を更新するための値の配列
	 * @return 対象データ
	 **/
	public function save($attributes, $params)
	{
		$instance = $this->model
						->updateOrCreate($attributes, $params);
		return $instance;
	}
}
