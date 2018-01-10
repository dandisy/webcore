<?php

Route::get('microsite/{slug}', function($slug) {
    return view($slug);
});