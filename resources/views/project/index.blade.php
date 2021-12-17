<x-app-layout>
    <h4 class="text-lg font-semibold">
        My Projects
    </h4>

    <x-alerts />

    <div
        class="card bg-base-100 bordered mt-6 shadow"
        x-data="{
            deleteProjectId: null,
            deleteProjectName: null,
            deleteProjectUrl: null,
        }"
    >
        <div class="card-body">
            <div class="flex justify-end">
                <a href="{{ route('dashboard.project.create') }}" class="btn btn-primary">
                    New
                </a>
            </div>
            <div class="mt-6">
                <table class="table table-zebra table-compact w-full">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($projects as $project)
                        <tr>
                            <td>{{ $projects->firstItem() + $loop->index }}</td>
                            <td>{{ $project->name }}</td>
                            <td>
                                <a href="{{ route('dashboard.project.show', $project->id) }}" class="button btn btn-sm btn-primary">
                                    View
                                </a>
                                <a href="{{ route('dashboard.project.edit', $project->id) }}" class="button btn btn-sm btn-secondary">
                                    Edit
                                </a>
                                <label
                                    for="deletionModal"
                                    class="btn btn-sm btn-error"
                                    @click="
                                        deleteProjectId = {{ $project->id }},
                                        deleteProjectName = '{{ $project->name }}',
                                        deleteProjectUrl = '{{ route('dashboard.project.destroy', $project) }}'"
                                >
                                    Delete
                                </label>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center">You haven't created any project.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-6">
                {{ $projects->links() }}
            </div>
        </div>

        <input type="checkbox" id="deletionModal" class="modal-toggle">
        <div class="modal">
            <div class="modal-box">
                <p>
                    Are you sure want to delete <span class="font-bold" x-text="deleteProjectName"></span>?
                    All of the users, groups/teams, roles, and permissions
                    registered within will lost their access.
                </p>
                <div class="modal-action">
                    <form x-bind:action="deleteProjectUrl" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-error">
                            Yes
                        </button>
                    </form>
                    <label for="deletionModal" class="btn btn-ghost">Cancel</label>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>