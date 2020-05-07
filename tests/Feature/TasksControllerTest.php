<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\TasksController;
use Illuminate\Redis\Connections\PhpRedisClusterConnection;
use Tests\TestCase;

class TasksControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('一覧');
    }

    public function testCreate()
    {
        $response = $this->get(route('task.create'));

        $response->assertStatus(200);
        $response->assertSee('追加');
    }

    public function testStore()
    {
        $response = $this->post(route('task.store',[
            'content' => 'にょろろー'
        ])
    );
        // $response = assertredirect('/');

        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

    public function testShow()
    {
        $response = $this->get(route('task.show',[
            'task' => 2
        ])
    );

        $response->assertStatus(200);
        $response->assertSee('詳細ページ');
    }

    public function testEdit()
    {
        $response = $this->get(route('task.edit',[
            'task' => 2
        ])
    );

        $response->assertStatus(200);
        $response->assertSee('編集ページ');
    }

    public function testUpdate()
    {
        $response = $this->put(route('task.update',[
            'content' => 'サブミット',
            'task' => 2
        ])
    );

        $response->assertStatus(302);
        $response->assertRedirect('/');
    }

    public function testDestroy()
    {
        $response = $this->delete(route('task.destroy',[
            'task' => 29
        ])
    );

        $response->assertStatus(302);
    }

    public function testNotFoundShow()
    {
        $response = $this->get(route('task.show',[
            'task' => 100
        ])
    );

        $response->assertStatus(500);
    }
}
