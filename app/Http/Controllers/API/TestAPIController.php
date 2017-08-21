<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTestAPIRequest;
use App\Http\Requests\API\UpdateTestAPIRequest;
use App\Models\Test;
use App\Repositories\TestRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class TestController
 * @package App\Http\Controllers\API
 */

class TestAPIController extends AppBaseController
{
    /** @var  TestRepository */
    private $testRepository;

    public function __construct(TestRepository $testRepo)
    {
        $this->testRepository = $testRepo;
    }

    /**
     * Display a listing of the Test.
     * GET|HEAD /tests
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->testRepository->pushCriteria(new RequestCriteria($request));
        $this->testRepository->pushCriteria(new LimitOffsetCriteria($request));
        $tests = $this->testRepository->all();

        return $this->sendResponse($tests->toArray(), 'Tests retrieved successfully');
    }

    /**
     * Store a newly created Test in storage.
     * POST /tests
     *
     * @param CreateTestAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateTestAPIRequest $request)
    {
        $input = $request->all();

        $tests = $this->testRepository->create($input);

        return $this->sendResponse($tests->toArray(), 'Test saved successfully');
    }

    /**
     * Display the specified Test.
     * GET|HEAD /tests/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Test $test */
        $test = $this->testRepository->findWithoutFail($id);

        if (empty($test)) {
            return $this->sendError('Test not found');
        }

        return $this->sendResponse($test->toArray(), 'Test retrieved successfully');
    }

    /**
     * Update the specified Test in storage.
     * PUT/PATCH /tests/{id}
     *
     * @param  int $id
     * @param UpdateTestAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTestAPIRequest $request)
    {
        $input = $request->all();

        /** @var Test $test */
        $test = $this->testRepository->findWithoutFail($id);

        if (empty($test)) {
            return $this->sendError('Test not found');
        }

        $test = $this->testRepository->update($input, $id);

        return $this->sendResponse($test->toArray(), 'Test updated successfully');
    }

    /**
     * Remove the specified Test from storage.
     * DELETE /tests/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Test $test */
        $test = $this->testRepository->findWithoutFail($id);

        if (empty($test)) {
            return $this->sendError('Test not found');
        }

        $test->delete();

        return $this->sendResponse($id, 'Test deleted successfully');
    }
}
