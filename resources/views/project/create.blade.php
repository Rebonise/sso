<x-app-layout>
    <h4 class="text-lg font-semibold">
        Create a new project
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
                <form action="{{ route('dashboard.project.store') }}" method="post">
                    @csrf
                    <div class="form-control">
                        <label for="name">
                            <span class="label-text">Project Name</span>
                        </label>
                        <input type="text" name="name" id="name" class="input input-bordered mt-4" value="{{ old('name') }}" />
                    </div>
                    <div class="flex justify-end mt-6">
                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>