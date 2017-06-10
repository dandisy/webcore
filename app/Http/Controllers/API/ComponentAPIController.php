<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateComponentAPIRequest;
use App\Http\Requests\API\UpdateComponentAPIRequest;
use App\Models\Component;
use App\Repositories\ComponentRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ComponentController
 * @package App\Http\Controllers\API
 */

class ComponentAPIController extends AppBaseController
{
    /** @var  ComponentRepository */
    private $componentRepository;

    public function __construct(ComponentRepository $componentRepo)
    {
        $this->componentRepository = $componentRepo;
    }

    /**
     * Display a listing of the Component.
     * GET|HEAD /components
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->componentRepository->pushCriteria(new RequestCriteria($request));
        $this->componentRepository->pushCriteria(new LimitOffsetCriteria($request));
        $components = $this->componentRepository->all();

        return $this->sendResponse($components->toArray(), 'Components retrieved successfully');
    }

    /**
     * Store a newly created Component in storage.
     * POST /components
     *
     * @param CreateComponentAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateComponentAPIRequest $request)
    {
        $input = $request->all();

        $components = $this->componentRepository->create($input);

        return $this->sendResponse($components->toArray(), 'Component saved successfully');
    }

    /**
     * Display the specified Component.
     * GET|HEAD /components/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Component $component */
        $component = $this->componentRepository->findWithoutFail($id);

        if (empty($component)) {
            return $this->sendError('Component not found');
        }

        return $this->sendResponse($component->toArray(), 'Component retrieved successfully');
    }

    /**
     * Update the specified Component in storage.
     * PUT/PATCH /components/{id}
     *
     * @param  int $id
     * @param UpdateComponentAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateComponentAPIRequest $request)
    {
        $input = $request->all();

        /** @var Component $component */
        $component = $this->componentRepository->findWithoutFail($id);

        if (empty($component)) {
            return $this->sendError('Component not found');
        }

        $component = $this->componentRepository->update($input, $id);

        return $this->sendResponse($component->toArray(), 'Component updated successfully');
    }

    /**
     * Remove the specified Component from storage.
     * DELETE /components/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Component $component */
        $component = $this->componentRepository->findWithoutFail($id);

        if (empty($component)) {
            return $this->sendError('Component not found');
        }

        $component->delete();

        return $this->sendResponse($id, 'Component deleted successfully');
    }
}
