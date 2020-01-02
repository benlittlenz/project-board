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
    }
}
