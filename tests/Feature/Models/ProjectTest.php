<?php

namespace Tests\Feature\Models;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_page_can_be_rendered()
    {
        /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('dashboard.project.index'));

        $response->assertSeeText('My Projects');
        $response->assertSeeText("You haven't created any project.", false);
        $response->assertStatus(200);
    }

    public function test_data_can_be_rendered_through_index()
    {
        $project = Project::factory()->create();
        $user = $project->user;
        $this->actingAs($user);

        $response = $this->get(route('dashboard.project.index'));
        $project = $user->projects->first();
        $view_project = $response->viewData('projects');

        $this->assertEquals($project->name, $view_project->first()->name);
        $response->assertSeeText($project->name);
        $response->assertDontSeeText("You haven't created any project.", false);
        $response->assertStatus(200);
    }

    public function test_show_page_can_be_rendered()
    {
        $project = Project::factory()->create();
        $user = $project->user;
        $this->actingAs($user);

        $project = $user->projects->first();
        $response = $this->get(route('dashboard.project.show', $project));
        $view_project = $response->viewData('project');

        $this->assertEquals($project->name, $view_project->first()->name);
        $response->assertSeeText('Project Detail');
        $response->assertSeeText('Project Overview');
        $response->assertSeeText($project->name);
        $response->assertSeeText(Crypt::decryptString($project->key));
        $response->assertSeeText($project->descriptive_created_at);
        $response->assertStatus(200);
    }

    public function test_create_page_can_be_rendered()
    {
        $project = Project::factory()->create();
        $user = $project->user;
        $this->actingAs($user);

        $response = $this->get(route('dashboard.project.create'));

        $response->assertSeeText('Create a new project');
        $response->assertStatus(200);
    }

    public function test_user_can_store_project_through_create_page()
    {
        /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->get(route('dashboard.project.create'));

        $response = $this->post(route('dashboard.project.store'), [
            'name' => 'Shiroyuki',
            'key' => Str::random(),
        ]);

        $response->assertRedirect(route('dashboard.project.create'));
        $response->assertSessionHasNoErrors();
        $response->assertSessionHas('success');
    }

    public function test_edit_page_can_be_rendered()
    {
        $project = Project::factory()->create();
        $user = $project->user;
        $this->actingAs($user);

        $response = $this->get(route('dashboard.project.edit', $project));
        $view_project = $response->viewData('project');

        $this->assertEquals($project->name, $view_project->name);
        $response->assertSeeText('Edit a project');
        $response->assertStatus(200);
    }

    public function test_user_can_update_project_through_edit_page()
    {
        $project = Project::factory()->create();
        $user = $project->user;
        $this->actingAs($user);

        $this->get(route('dashboard.project.edit', $project));
        $response = $this->put(route('dashboard.project.update', $project), [
            'name' => 'Shiroyuki',
            'key' => Str::random(),
        ]);

        $response->assertRedirect(route('dashboard.project.edit', $project));
        $response->assertSessionHasNoErrors();
        $response->assertSessionHas('success');
    }

    public function test_user_can_delete_project_through_index_page()
    {
        $project = Project::factory()->create();
        $user = $project->user;
        $this->actingAs($user);

        $this->get(route('dashboard.project.index'));
        $response = $this->delete(route('dashboard.project.destroy', $project));

        $response->assertRedirect(route('dashboard.project.index'));
        $response->assertSessionHasNoErrors();
        $response->assertSessionHas('success');
    }

    public function test_user_can_not_see_other_user_project()
    {
        $project = Project::factory()->create();
        $other_project = Project::factory()->create();
        $user = $project->user;
        $this->actingAs($user);

        $response = $this->get(route('dashboard.project.show', $other_project));
        $response->assertStatus(403);
    }

    public function test_user_can_not_edit_other_user_project()
    {
        $project = Project::factory()->create();
        $other_project = Project::factory()->create();
        $user = $project->user;
        $this->actingAs($user);

        $response = $this->get(route('dashboard.project.edit', $other_project));
        $response->assertStatus(403);
    }
}
