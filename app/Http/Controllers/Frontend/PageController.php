<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Page;
use App\Models\Admin\Menu;

class PageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        $menu = Menu::nested()->get();
        $pageSource = Page::where('slug', $slug)->first();

        $pageContent = $pageSource ? \Widget::webCore(['pageContent' => $pageSource->content]) : NULL;

        return view('page')
            ->with('slug', $slug)
            ->with('menu', $menu)
            ->with('pageContent', $pageContent);
    }
}
