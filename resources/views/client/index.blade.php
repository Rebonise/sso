<x-app-layout>
    <h4 class="text-lg font-semibold">
        My Users
    </h4>

    <x-alerts />

    <div
        class="card bg-base-100 bordered mt-6 shadow"
        x-data="{
            deleteClientName: null,
            deleteClientUrl: null,
        }"
    >
        <div class="card-body">
            <div class="flex justify-end">
                <a href="{{ route('dashboard.client.create') }}" class="btn btn-primary">
                    New
                </a>
            </div>
            <div class="mt-6">
                <table class="table table-zebra table-compact w-full">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>From Project</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($clients as $client)
                        <tr>
                            <td>{{ $clients->firstItem() + $loop->index }}</td>
                            <td>{{ $client->name }}</td>
                            <td>
                                <a href="{{ route('dashboard.project.show', $client->project) }}" class="underline decoration-primary">
                                    {{ $client->project->name }}</td>
                                </a>
                            <td>
                                <a href="{{ route('dashboard.client.show', $client->id) }}" class="button btn btn-sm btn-primary">
                                    View
                                </a>
                                <a href="{{ route('dashboard.client.edit', $client->id) }}" class="button btn btn-sm btn-secondary">
                                    Edit
                                </a>
                                <label
                                    for="deletionModal"
                                    class="btn btn-sm btn-error"
                                    @click="
                                        deleteClientName = '{{ $client->name }}',
                                        deleteClientUrl = '{{ route('dashboard.client.destroy', $client) }}'"
                                >
                                    Delete
                                </label>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center">You haven't created any user.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-6">
                {{ $clients->links() }}
            </div>
        </div>

        <input type="checkbox" id="deletionModal" class="modal-toggle">
        <div class="modal">
            <div class="modal-box">
                <p>
                    Are you sure want to delete <span class="font-bold" x-text="deleteClientName"></span>?
                    This user won't be able to logged in to your application later.
                </p>
                <div class="modal-action">
                    <form x-bind:action="deleteClientUrl" method="post">
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