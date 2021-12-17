<x-app-layout>
    <h4 class="text-lg font-semibold">
        User Detail
    </h4>

    <x-alerts />

    <div class="card bg-base-100 bordered mt-6 shadow">
        <div class="card-body">
            <div class="flex">
                <a href="{{ route('dashboard.client.index') }}" class="btn btn-secondary">
                    Back
                </a>
            </div>
            <div class="mt-6">
                <h4 class="text-lg font-semibold">
                    User Overview
                </h4>
                <table class="table table-compact mt-4">
                    <tr>
                        <td>Name</td>
                        <td>:</td>
                        <td>{{ $client->name }}</td>
                    </tr>
                    <tr>
                        <td>From</td>
                        <td>:</td>
                        <td>
                            <a href="{{ route('dashboard.project.show', $client->project) }}" class="underline decoration-primary">
                                {{ $client->project->name }}</td>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>Created at</td>
                        <td>:</td>
                        <td>{{ $client->descriptive_created_at }} ({{ $client->created_at_difference }})</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>