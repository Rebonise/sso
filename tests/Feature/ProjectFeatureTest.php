<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class ProjectFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_confirm_project_screen_can_be_rendered()
    {
        /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('dashboard.project.index'));

        $response->assertSeeText('My Projects');
        $response->assertSeeText("You haven't created any project.", false);
        $response->assertStatus(200);
    }

    public function test_user_can_see_the_project_after_being_created()
    {
        /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
        $user = User::factory()->hasProjects(1)->create();
        $this->actingAs($user);

        $response = $this->get(route('dashboard.project.index'));
        $project = $user->projects->first();
        $view_project = $response->viewData('projects');

        $response->assertSeeText($project->name);
        $response->assertDontSeeText("You haven't created any project.", false);
        $response->assertStatus(200);

        $this->assertEquals($project->name, $view_project->first()->name);
    }

    public function test_user_can_see_the_detail_project_after_being_created()
    {
        /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
        $user = User::factory()->hasProjects(1)->create();
        $this->actingAs($user);

        $project = $user->projects->first();
        $response = $this->get(route('dashboard.project.show', $project->id));
        $view_project = $response->viewData('project');

        $response->assertSeeText('Project Detail');
        $response->assertSeeText('Project Overview');
        $response->assertSeeText($project->name);
        $response->assertSeeText($project->key);
        $response->assertSeeText($project->descriptive_created_at);
        $response->assertStatus(200);

        $this->assertEquals($project->name, $view_project->first()->name);
    }

    public function test_confirm_project_create_screen_can_be_rendered()
    {
        /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('dashboard.project.create'));

        $response->assertSeeText('Create a new project');
        $response->assertStatus(200);
    }

    public function test_user_can_store_project_using_create_screen()
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

    public function test_confirm_project_edit_screen_can_be_rendered()
    {
        /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
        $user = User::factory()->hasProjects(1)->create();
        $project = $user->projects->first();
        $this->actingAs($user);

        $response = $this->get(route('dashboard.project.edit', $project));
        $view_project = $response->viewData('project');

        $response->assertSeeText('Edit a project');
        $response->assertStatus(200);

        $this->assertEquals($project->name, $view_project->name);
    }

    public function test_user_can_update_project_using_edit_screen()
    {
        /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
        $user = User::factory()->hasProjects(1)->create();
        $project = $user->projects->first();
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

    public function test_user_can_delete_projet_using_index_screen()
    {
        /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
        $user = User::factory()->hasProjects(1)->create();
        $project = $user->projects->first();
        $this->actingAs($user);
        $this->get(route('dashboard.project.index'));

        $response = $this->delete(route('dashboard.project.destroy', $project));

        $response->assertRedirect(route('dashboard.project.index'));
        $response->assertSessionHasNoErrors();
        $response->assertSessionHas('success');
    }
}
