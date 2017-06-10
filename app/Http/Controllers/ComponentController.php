<?php

namespace App\Http\Controllers;

use App\DataTables\ComponentDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateComponentRequest;
use App\Http\Requests\UpdateComponentRequest;
use App\Repositories\ComponentRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ComponentController extends AppBaseController
{
    /** @var  ComponentRepository */
    private $componentRepository;

    public function __construct(ComponentRepository $componentRepo)
    {
        $this->componentRepository = $componentRepo;
    }

    /**
     * Display a listing of the Component.
     *
     * @param ComponentDataTable $componentDataTable
     * @return Response
     */
    public function index(ComponentDataTable $componentDataTable)
    {
        return $componentDataTable->render('components.index');
    }

    /**
     * Show the form for creating a new Component.
     *
     * @return Response
     */
    public function create()
    {
        return view('components.create');
    }

    /**
     * Store a newly created Component in storage.
     *
     * @param CreateComponentRequest $request
     *
     * @return Response
     */
    public function store(CreateComponentRequest $request)
    {
        $input = $request->all();

        $component = $this->componentRepository->create($input);

        Flash::success('Component saved successfully.');

        return redirect(route('components.index'));
    }

    /**
     * Display the specified Component.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $component = $this->componentRepository->findWithoutFail($id);

        if (empty($component)) {
            Flash::error('Component not found');

            return redirect(route('components.index'));
        }

        return view('components.show')->with('component', $component);
    }

    /**
     * Show the form for editing the specified Component.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $component = $this->componentRepository->findWithoutFail($id);

        if (empty($component)) {
            Flash::error('Component not found');

            return redirect(route('components.index'));
        }

        return view('components.edit')->with('component', $component);
    }

    /**
     * Update the specified Component in storage.
     *
     * @param  int              $id
     * @param UpdateComponentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateComponentRequest $request)
    {
        $component = $this->componentRepository->findWithoutFail($id);

        if (empty($component)) {
            Flash::error('Component not found');

            return redirect(route('components.index'));
        }

        $component = $this->componentRepository->update($request->all(), $id);

        Flash::success('Component updated successfully.');

        return redirect(route('components.index'));
    }

    /**
     * Remove the specified Component from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $component = $this->componentRepository->findWithoutFail($id);

        if (empty($component)) {
            Flash::error('Component not found');

            return redirect(route('components.index'));
        }

        $this->componentRepository->delete($id);

        Flash::success('Component deleted successfully.');

        return redirect(route('components.index'));
    }
}
