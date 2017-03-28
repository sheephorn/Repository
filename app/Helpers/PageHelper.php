<?php

use App\Definitions\FunctionsDefinition;

/**
 * ページタイトルを取得する
 * @return String ページタイトル
 */
function getTitle()
{
    return FunctionsDefinition::TITLE[array_search(getPath(), FunctionsDefinition::URL)];
}
