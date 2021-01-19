<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\Response;
use App\Lesson;


class LessonControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testShow()
    {
        //routringアクセスして、statuscode200が返ってくること。
        //レスポンスデータに指定の文字列があること
        $lesson = factory(Lesson::class)->create(['name' => '楽しいヨガレッスン']);

        $response = $this->get("/lessons/{$lesson->id}");

        $response->assertStatus(200);
        $response->assertSee($lesson->name);
        $response->assertSee('空き状況: ×');
    }
}
