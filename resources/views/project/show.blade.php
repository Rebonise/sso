<x-app-layout>
    <h4 class="text-lg font-semibold">
        Project Detail
    </h4>

    <x-alerts />

    <div class="card bg-base-100 bordered mt-6 shadow">
        <div class="card-body">
            <div class="flex">
                <a href="{{ route('dashboard.project.index') }}" class="btn btn-secondary">
                    Back
                </a>
            </div>
            <div class="mt-6">
                <h4 class="text-lg font-semibold">
                    Project Overview
                </h4>
                <table class="table table-compact mt-4">
                    <tr>
                        <td>Name</td>
                        <td>:</td>
                        <td>{{ $project->name }}</td>
                    </tr>
                    <tr>
                        <td>Key</td>
                        <td>:</td>
                        <td>{{ $decryptor::decryptString($project->key) }}</td>
                    </tr>
                    <tr>
                        <td>Created at</td>
                        <td>:</td>
                        <td>{{ $project->descriptive_created_at }} ({{ $project->created_at_difference }})</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>