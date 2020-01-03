<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ActivityFeedTest extends TestCase
{
    use RefreshDatabase;
    public function test_creating_project_generates_activity()
    {
        $project = factory('App\Project')->create();

        $this->assertCount(1, $project->activity);
        $this->assertEquals('created', $project->activity[0]->description);
    }

    public function test_updating_project_generates_activity() {
        $project = factory('App\Project')->create();

        $project->update(['title' => 'Changed']);

        $this->assertCount(2, $project->activity);
    }
}
