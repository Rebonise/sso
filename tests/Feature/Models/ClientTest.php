<?php

namespace Tests\Feature\Models;

use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_page_can_be_rendered()
    {
        /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get(route('dashboard.client.index'));
        $response->assertSeeText('My Users');
        $response->assertSeeText("You haven't created any user.", false);
        $response->assertStatus(200);
    }

    public function test_data_can_be_rendered_through_index()
    {
        $client = Client::factory()->create();
        $user = $client->project->user;
        $this->actingAs($user);

        $response = $this->get(route('dashboard.client.index'));
        $view_project = $response->viewData('clients');

        $response->assertSeeText($client->name);
        $response->assertDontSeeText("You haven't created any user.", false);
        $response->assertStatus(200);

        $this->assertEquals($client->name, $view_project->first()->name);
    }

    public function test_show_page_can_be_rendered()
    {
        $client = Client::factory()->create();
        $user = $client->project->user;

        $this->actingAs($user);

        $response = $this->get(route('dashboard.client.show', $client));
        $response->assertSeeText('User Detail');
        $response->assertSeeText('User Overview');
        $response->assertSeeText($client->name);
        $response->assertSeeText($client->project->name);
        $response->assertSeeText($client->descriptive_created_at);
        $response->assertStatus(200);
    }

    public function test_create_page_can_be_rendered()
    {
        /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get(route('dashboard.client.create'));
        $response->assertSeeText('Add a new User');
        $response->assertSeeText('User Name');
        $response->assertStatus(200);
    }

    public function test_user_can_store_client_through_create_page()
    {
        $project = Project::factory()->create();
        $user = $project->user;

        $this->actingAs($user);
        $this->get(route('dashboard.client.create'));

        $client_payload = [
            'project_id' => $project->id,
            'name' => 'Shiroyuki',
        ];

        $response = $this->post(route('dashboard.client.store'), $client_payload);
        $response->assertRedirect(route('dashboard.client.create'));
        $response->assertSessionHas('success');
        $response->assertStatus(302);
    }

    public function test_edit_page_can_be_rendered()
    {
        $client = Client::factory()->create();
        $user = $client->project->user;

        $this->actingAs($user);

        $response = $this->get(route('dashboard.client.edit', $client->id));
        $view_data = $response->viewData('client');

        $this->assertEquals($client->name, $view_data->name);
        $response->assertSeeText('Edit a User');
        $response->assertStatus(200);
    }

    public function test_user_can_update_client_through_edit_page()
    {
        $client = Client::factory()->create();
        $user = $client->project->user;

        $this->actingAs($user);
        $this->get(route('dashboard.client.edit', $client));

        $client_payload = [
            'name' => 'Shiroyuki',
        ];

        $response = $this->put(route('dashboard.client.update', $client), $client_payload);
        $response->assertRedirect(route('dashboard.client.edit', $client));
        $response->assertSessionHas('success');
        $response->assertStatus(302);
    }

    public function test_user_can_delete_client_through_index_page()
    {
        $client = Client::factory()->create();
        $user = $client->project->user;

        $this->actingAs($user);
        $this->get(route('dashboard.client.index'));

        $response = $this->delete(route('dashboard.client.destroy', $client));
        $response->assertRedirect(route('dashboard.client.index'));
        $response->assertSessionHas('success');
        $response->assertStatus(302);
    }

    public function test_user_can_not_see_other_user_client()
    {
        $client = Client::factory()->create();
        $other_client = Client::factory()->create();
        $user = $client->project->user;
        $this->actingAs($user);

        $response = $this->get(route('dashboard.client.show', $other_client));
        $response->assertStatus(403);
    }

    public function test_user_can_not_edit_other_user_project()
    {
        $client = Client::factory()->create();
        $other_client = Client::factory()->create();
        $user = $client->project->user;
        $this->actingAs($user);

        $response = $this->get(route('dashboard.client.edit', $other_client));
        $response->assertStatus(403);
    }
}
