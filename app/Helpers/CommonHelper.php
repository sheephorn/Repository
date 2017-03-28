<?php

use App\Definitions\FunctionsDefinition;

/**
 * Pathを取得する
 * 引数がある場合はそのＵＲＬのpath
 * なければ現在のＵＲＬのpath
 *
 * @param  String $url URL
 * @return String      Path
 */
function getPath($url = null)
{
    if ($url === null) {
        $fullpath = $_SERVER["REQUEST_URI"];
    } else {
        $fullpath = $url;
    }
    $path = explode("/", $fullpath);
    $path = array_slice($path, -2);
    $path = implode("/", $path);
    return $path;
}

/**
 * 現在時間のDateTimeオブジェクトを返す
 * @return Object 現在時間のDateTimeオブジェクト
 */
function getCurrentTime()
{
    return date_create();
}

/**
 * 現在時刻を返す　yyyy/mm/dd hh:ii:ss
 * @return [type] [description]
 */
function getAccessTime()
{
    return getCurrentTime()->format('Y/m/d H:i:s');
}

/**
 * Exceptionが発生した場合のエラーログの出力
 * 出力内容： エラーメッセージ、エラー行、ファイル名
 * @param Exception $exception
 **/
function createErrorLog($exception, $condition = null)
{
	\Log::error($exception->getMessage()." line:".$exception->getLine()." in: ".$exception->getFile() );
	if($condition !== null){

		\Log::error("PATH IS  ");
		\Log::error($condition->path());
		\Log::error("REQUEST IS  ");
		\Log::error($condition->all());
	}
	return true;
}
