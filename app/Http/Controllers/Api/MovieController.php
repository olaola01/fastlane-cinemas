<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Movie\CreateMovieRequest;
use App\Http\Requests\Movie\UpdateMovieRequest;
use App\Http\Resources\MovieResource;
use App\Models\Movie;
use App\Repositories\Eloquent\Repository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class MovieController extends Controller
{
    protected Repository $model;

    public function __construct(Movie $movie)
    {
        $this->model = new Repository($movie);
    }

    public function index(): JsonResponse
    {
        return $this->successCall(MovieResource::collection($this->model->with('cinema')));
    }

    public function store(CreateMovieRequest $request): JsonResponse
    {
        $movie = $this->model->create($request->validated());

        return $this->successCall(new MovieResource($movie));
    }

    public function edit(Movie $movie): JsonResponse
    {
        $findMovie = $this->model->show($movie->id);

        if (!$findMovie) {
            return $this->badCall(404, 'error', 'not found');
        }

        return $this->successCall(new MovieResource($findMovie));
    }

    public function update(UpdateMovieRequest $request, Movie $movie): JsonResponse
    {
        $updateMovie = $this->model->update($request->validated(), $movie->id);
        if (!$updateMovie) {
            return $this->badCall(503, 'error', 'unable to update');
        }

        return $this->successCall(new MovieResource($movie));

    }

    public function destroy(Movie $movie): Response|JsonResponse
    {
        if (!$this->model->delete($movie->id)) {
            return $this->badCall(404, 'error', 'not found');
        }

        return response()->noContent();

    }
}
