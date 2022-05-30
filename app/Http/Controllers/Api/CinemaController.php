<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cinema\CreateCinemaRequest;
use App\Http\Requests\Cinema\UpdateCinemaRequest;
use App\Http\Resources\CinemaResource;
use App\Models\Cinema;
use App\Repositories\Eloquent\Repository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CinemaController extends Controller
{

    protected Repository $model;

    public function __construct(Cinema $cinema)
    {
        $this->model = new Repository($cinema);
    }

    public function index(): JsonResponse
    {
        return $this->successCall(CinemaResource::collection($this->model->with('movies')));
    }

    public function store(CreateCinemaRequest $request): JsonResponse
    {
        $cinema = $this->model->create($request->validated());

        return $this->successCall(new CinemaResource($cinema));
    }

    public function edit(Cinema $cinema): JsonResponse
    {
        $findCinema = $this->model->show($cinema->id);

        if (!$findCinema) {
            return $this->badCall(404, 'error', 'not found');
        }

        return $this->successCall(new CinemaResource($findCinema));
    }

    public function update(UpdateCinemaRequest $request, Cinema $cinema): JsonResponse
    {
        $updateCinema = $this->model->update($request->validated(), $cinema->id);
        if (!$updateCinema) {
            return $this->badCall(503, 'error', 'unable to update');
        }

        return $this->successCall(new CinemaResource($cinema));

    }

    public function destroy(Cinema $cinema): Response|JsonResponse
    {
        if (!$this->model->delete($cinema->id)) {
            return $this->badCall(404, 'error', 'not found');
        }

        return response()->noContent();

    }
}
