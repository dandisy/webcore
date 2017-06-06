<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateArticle2Request;
use App\Http\Requests\UpdateArticle2Request;
use App\Repositories\Article2Repository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class Article2Controller extends AppBaseController
{
    /** @var  Article2Repository */
    private $article2Repository;

    public function __construct(Article2Repository $article2Repo)
    {
        $this->article2Repository = $article2Repo;
    }

    /**
     * Display a listing of the Article2.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->article2Repository->pushCriteria(new RequestCriteria($request));
        $article2s = $this->article2Repository->all();

        return view('article2s.index')
            ->with('article2s', $article2s);
    }

    /**
     * Show the form for creating a new Article2.
     *
     * @return Response
     */
    public function create()
    {
        return view('article2s.create');
    }

    /**
     * Store a newly created Article2 in storage.
     *
     * @param CreateArticle2Request $request
     *
     * @return Response
     */
    public function store(CreateArticle2Request $request)
    {
        $input = $request->all();

        $article2 = $this->article2Repository->create($input);

        Flash::success('Article2 saved successfully.');

        return redirect(route('article2s.index'));
    }

    /**
     * Display the specified Article2.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $article2 = $this->article2Repository->findWithoutFail($id);

        if (empty($article2)) {
            Flash::error('Article2 not found');

            return redirect(route('article2s.index'));
        }

        return view('article2s.show')->with('article2', $article2);
    }

    /**
     * Show the form for editing the specified Article2.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $article2 = $this->article2Repository->findWithoutFail($id);

        if (empty($article2)) {
            Flash::error('Article2 not found');

            return redirect(route('article2s.index'));
        }

        return view('article2s.edit')->with('article2', $article2);
    }

    /**
     * Update the specified Article2 in storage.
     *
     * @param  int              $id
     * @param UpdateArticle2Request $request
     *
     * @return Response
     */
    public function update($id, UpdateArticle2Request $request)
    {
        $article2 = $this->article2Repository->findWithoutFail($id);

        if (empty($article2)) {
            Flash::error('Article2 not found');

            return redirect(route('article2s.index'));
        }

        $article2 = $this->article2Repository->update($request->all(), $id);

        Flash::success('Article2 updated successfully.');

        return redirect(route('article2s.index'));
    }

    /**
     * Remove the specified Article2 from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $article2 = $this->article2Repository->findWithoutFail($id);

        if (empty($article2)) {
            Flash::error('Article2 not found');

            return redirect(route('article2s.index'));
        }

        $this->article2Repository->delete($id);

        Flash::success('Article2 deleted successfully.');

        return redirect(route('article2s.index'));
    }
}
