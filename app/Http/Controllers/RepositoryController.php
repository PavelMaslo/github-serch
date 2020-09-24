<?php

namespace App\Http\Controllers;

use App\Models\Repository;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RepositoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function searchFromGithub(Request $request)
    {
        $q = $request->input('q');
        $response = Http::get('https://api.github.com/search/repositories?q=' . $q);
        $response = $response->json();
        $data = $response["items"];

        return View("repositories/search/index", ['data' => $data, 'q' => $q]);
    }

    public function getFavorit()
    {
        $user = User::find(Auth::id());
        $repositories = $user->repositories()->get();

        return $repositories;
    }

    public function index()
    {
        $repositories = $this->getFavorit();
        return View("repositories/index", ['repositories' => $repositories]);
    }

    public function create(Request $request)
    {
        $user = User::find(Auth::id());

        $repository = Repository::where('url', '=', $request->input('url'))->first();
        if ($repository === null) {
            $input['url'] = $request->input('url');
            $input['name'] = $request->input('name');
            $input['description'] = $request->input('description');
            $input['owner_login'] = $request->input('ownerLogin');
            $input['stargazers_count'] = $request->input('stargazersCount');
            $repository = Repository::create($input);
        }

        if (!$user->repositories()->where('repository_id', $repository->id)->exists()) {
            $user->repositories()->attach($repository);
        }

        return $repository;
    }

    public function destroyByUrl(Request $request)
    {
        $user = User::find(Auth::id());
        $repository =  Repository::where('url', $request->input('url'))->first();
        $user->repositories()->wherePivot('repository_id', '=', $repository->id )->detach();

        return $request->input('url');
    }


}
