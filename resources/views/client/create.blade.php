<x-app-layout>
    <h4 class="text-lg font-semibold">
        Add a new User
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
                <form action="{{ route('dashboard.client.store') }}" method="post">
                    @csrf
                    <div class="form-control">
                        <label for="project_id">
                            <span class="label-text">Choose Project</span>
                        </label>
                        <select name="project_id" id="project_id" class="select select-bordered w-full max-w xs mt-4" required>
                            @foreach ($projects as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-control mt-6">
                        <label for="name">
                            <span class="label-text">User Name</span>
                        </label>
                        <input type="text" name="name" id="name" class="input input-bordered mt-4" value="{{ old('name') }}" required />
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