<?php

return array(


    /*
    |--------------------------------------------------------------------------
    | Path home for your file manager
    |--------------------------------------------------------------------------
    |
    */
    'homePath'  => storage_path('app/public'),

    /*
    |--------------------------------------------------------------------------
    | Default routes for your file manager. You can modify here:
    |--------------------------------------------------------------------------
    |
    */
    'defaultRoute'  => 'assets',

    /*
    |--------------------------------------------------------------------------
    | Directory for your assets, relative to laravel public directory:
    |--------------------------------------------------------------------------
    |
    */
    'assetsDirectory'  => '/storage',


    /*
    |--------------------------------------------------------------------------
    | User middleware. You can use or single string or array based
    |--------------------------------------------------------------------------
    |
    */
    'middleware'  => ['web', 'auth'],


    /*
    |--------------------------------------------------------------------------
    | Use this options if you want to sanitize file and folder names
    |--------------------------------------------------------------------------
    |
    */
    'validName'  => true,

    /*
    |--------------------------------------------------------------------------
    | Files You don't want to show on File Manager
    |--------------------------------------------------------------------------
    |
    */
    'exceptFiles'   => array( 'robots.txt', 'index.php', '.DS_Store', '.Thumbs.db'),


    /*
    |--------------------------------------------------------------------------
    | Folders names you don't want to show on File Manager
    |--------------------------------------------------------------------------
    |
    */
    'exceptFolders' => array( 'vendor', 'thumbs', 'filemanager_assets', 'microsite'),


    /*
    |--------------------------------------------------------------------------
    | Extensions you don't want to show on File Manager
    |--------------------------------------------------------------------------
    |
    */
    'exceptExtensions'  => array( 'php', 'htaccess', 'gitignore'),

    /*
    |--------------------------------------------------------------------------
    | Append tu url. For if you use a custom service to load assets by url. Example here: http://stackoverflow.com/a/36351219/4042595
    |--------------------------------------------------------------------------
    |
    */
    'appendUrl'  => null,

    /*
    |--------------------------------------------------------------------------
    | If optimizeImages is set tu true, action to optimize images will be available under contextualMenu.
    | Images will be also optimized by method upload
    | False by default
    |--------------------------------------------------------------------------
    |
    */
    'optimizeImages' => false,

    /*
    |--------------------------------------------------------------------------
    | Path for pngquant. This is used to auto optimize png files. If set to null, FileManager will not optimize png files.
    | You must install pngquant in your host. https://pngquant.org
    | Must have optimizeImages option set to true
    | Null by default
    |--------------------------------------------------------------------------
    |
    */
    'pngquantPath'  => null,

    /*
    |--------------------------------------------------------------------------
    | Path for pngquant. This is used to auto optimize jpg files. If set to null, FileManager will not optimize jpg files.
    | You must install JPEG Archive in your host. https://github.com/danielgtaylor/jpeg-archive
    | Must have optimizeImages option set to true
    | Null by default
    |--------------------------------------------------------------------------
    |
    */
    'jpegRecompressPath'  => null,


);