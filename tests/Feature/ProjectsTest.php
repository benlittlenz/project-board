<?php

namespace Tests\Feature;

use App\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_only_auth_users_can_create_projects() {

        //$this->withoutExceptionHandling();

        $attributes = factory('App\Project')->raw();
        $this->post('/projects', $attributes)->assertRedirect('login');
    }

    public function test_only_auth_users_can_view_projects() {

        $this->get('/projects')->assertRedirect('login');
    }

    public function test_user_can_create_a_project()
    {
        //$this->withoutExceptionHandling();
        $this->signIn();

        $this->get('/projects/create')->assertStatus(200);

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'notes' => 'General Notes'
        ];

        $response = $this->post('/projects', $attributes);

        $project = Project::where($attributes)->first();
        
        $response->assertRedirect($project->path());
        $this->assertDatabaseHas('projects', $attributes);
        $this->get($project->path())->assertSee($attributes['title']);
    }

    public function test_guests_cannot_manage_project() {

        $project = factory('App\Project')->create();

        $this->get('/projects')->assertRedirect('login');
        $this->get('/projects/create')->assertRedirect('login');
        $this->get($project->path())->assertRedirect('login');
        $this->post('projects', $project->toArray())->assertRedirect('login');
    }


    public function test_auth_users_cannot_view_projects_of_others() {
        $this->be(factory('App\User')->create());
        //$this->withoutExceptionHandling();

        $project = factory('App\Project')->create();

        //if user tries to view project which is not theirs, it shouldnt work
        $this->get($project->path())->assertStatus(403);
    }

    public function test_user_can_update_a_project() {
        $this->signIn();

        $project = factory('App\Project')
            ->create(['owner_id' => auth()->id()]);

        $this->patch($project->path(), ['notes' => 'changed']);

        $this->assertDatabaseHas('projects', ['notes' => 'changed']);
    }


    public function test_project_belongs_to_owner() {
        $project = factory('App\Project')->create();

        $this->assertInstanceOf('App\User', $project->owner);
    }

    public function test_project_requires_title() {

        $this->actingAs(factory('App\User')->create());

        $attributes = factory('App\Project')->raw(['title' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    public function test_project_requires_description() {

        $this->actingAs(factory('App\User')->create());
        $attributes = factory('App\Project')->raw(['description' => '']);
        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }
}
