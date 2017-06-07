<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePageAPIRequest;
use App\Http\Requests\API\UpdatePageAPIRequest;
use App\Models\Page;
use App\Repositories\PageRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class PageController
 * @package App\Http\Controllers\API
 */

class PageAPIController extends AppBaseController
{
    /** @var  PageRepository */
    private $pageRepository;

    public function __construct(PageRepository $pageRepo)
    {
        $this->pageRepository = $pageRepo;
    }

    /**
     * Display a listing of the Page.
     * GET|HEAD /pages
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->pageRepository->pushCriteria(new RequestCriteria($request));
        $this->pageRepository->pushCriteria(new LimitOffsetCriteria($request));
        $pages = $this->pageRepository->all();

        return $this->sendResponse($pages->toArray(), 'Pages retrieved successfully');
    }

    /**
     * Store a newly created Page in storage.
     * POST /pages
     *
     * @param CreatePageAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePageAPIRequest $request)
    {
        $input = $request->all();

        $pages = $this->pageRepository->create($input);

        return $this->sendResponse($pages->toArray(), 'Page saved successfully');
    }

    /**
     * Display the specified Page.
     * GET|HEAD /pages/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Page $page */
        $page = $this->pageRepository->findWithoutFail($id);

        if (empty($page)) {
            return $this->sendError('Page not found');
        }

        return $this->sendResponse($page->toArray(), 'Page retrieved successfully');
    }

    /**
     * Update the specified Page in storage.
     * PUT/PATCH /pages/{id}
     *
     * @param  int $id
     * @param UpdatePageAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePageAPIRequest $request)
    {
        $input = $request->all();

        /** @var Page $page */
        $page = $this->pageRepository->findWithoutFail($id);

        if (empty($page)) {
            return $this->sendError('Page not found');
        }

        $page = $this->pageRepository->update($input, $id);

        return $this->sendResponse($page->toArray(), 'Page updated successfully');
    }

    /**
     * Remove the specified Page from storage.
     * DELETE /pages/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Page $page */
        $page = $this->pageRepository->findWithoutFail($id);

        if (empty($page)) {
            return $this->sendError('Page not found');
        }

        $page->delete();

        return $this->sendResponse($id, 'Page deleted successfully');
    }
}
