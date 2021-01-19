<?php

namespace Tests\Unit\Models;

use PHPUnit\Framework\TestCase;
use App\VacancyLevel;

class VacancyLevelTest extends TestCase
{

      /**
     * @param int $remainingCount
     * @param string $expectedMark
     * @dataProvider dataMark
     */
    public function testMaker(int $remainingCount, string $expectedMark)
    {
        //ここのモデルで求められる要件としては空き状況を表す記号を残り枠数に応じて表示する
        //コンストラクターに数字を入れたら、レッスン予約の状態を確認して、文字列として記号投げる。
        $level = new VacancyLevel($remainingCount);
        $this->assertSame($expectedMark, $level->mark());
    }
    public function dataMark()
    {
        return [
            '空きなし' => [
                'remainingCount' => 0,
                'expectedMark' => '×',
            ],
            '残りわずか' => [
                'remainingCount' => 4,
                'expectedMark' => '△',
            ],
            '空き十分' => [
                'remainingCount' => 5,
                'expectedMark' => '◎',
            ],
        ];
    }
}
