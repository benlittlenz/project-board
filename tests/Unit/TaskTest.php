<?php

namespace Tests\Unit;

use App\Project;
use App\Task;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_task_has_a_path()
    {
        $task = factory('App\Task')->create();

        $this->assertEquals('/projects/' . $task->project->id . '/tasks/' . $task->id, $task->path());
    }

        function test_it_can_be_completed()
    {
        $task = factory(Task::class)->create();
        $this->assertFalse($task->completed);
        $task->complete();
        $this->assertTrue($task->fresh()->completed);
    }
}
