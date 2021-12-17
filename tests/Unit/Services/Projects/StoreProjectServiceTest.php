<?php

namespace Tests\Unit\Services\Projects;

use App\Models\Project;
use App\Models\User;
use App\Services\Projects\StoreProjectService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Tests\TestCase;

class StoreProjectServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_project_service_can_store_project()
    {
        $user = User::factory()->create();

        StoreProjectService::store(new Project, [
            'user_id' => $user->id,
            'name' => 'Shiroyuki',
            'key' => Crypt::encryptString(Str::random()),
        ]);

        $this->assertGreaterThan(0, $user->projects->count());
    }
}
