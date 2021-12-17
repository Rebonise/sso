<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use App\Services\Clients\SoftDeleteClientService;
use App\Services\Clients\StoreClientService;
use App\Services\Clients\UpdateClientService;
use Illuminate\Support\Facades\Gate;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('client.index', [
            'clients' => auth()->user()->clients()->with('project')->paginate(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.create', [
            'projects' => auth()->user()->projects->pluck('name', 'id'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientRequest $request)
    {
        try {
            $client_payload = [
                'project_id' => $request->project_id,
                'name' => $request->name,
            ];

            StoreClientService::store(new Client, $client_payload);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'New client has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        Gate::authorize('view', $client);

        return view('client.show', [
            'client' => $client->load('project'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        Gate::authorize('update', $client);

        return view('client.edit', [
            'projects' => auth()->user()->projects->pluck('name', 'id'),
            'client' => $client,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClientRequest  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        $project = $client->project;
        Gate::authorize('update', [$project, $client]);

        try {
            $client_payload = [
                'name' => $request->name,
            ];

            UpdateClientService::update($client, $client_payload);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Client has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        Gate::authorize('delete', $client);

        try {
            SoftDeleteClientService::delete($client);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Client has been deleted.');
    }
}
