## Webcore Platform

### Single Platform can be used for Backend Admin Website or Website CMS (built according to your needs)

## 1. Webcore
### Concept

    Admin Page - UI Component - Front Page

1.  Backend Page (Admin)
    
    Scope of Admin Page :    
    preparing user admin input form, input data by writed or by data source referenced
    
2. UI Component (just a part of page)

    Scope of UI Component (widget) :    
    provide reusable part of UI (widget) to included in template of page,
    (*and defining tracking configuration user interaction for personalization)
         
    Scope of Page :    
    layout and styling UI Component generally to be a Page by incorporating a template
    
3. Frontend Page

    Scope of Front Page :    
    provide User Experience with content personalization using Persona and Pattern

### Installation

Copy and paste in terminal line by line, just hit Enter key

* Using Git

        git clone https://github.com/dandisy/webcore.git

        cd webcore

        composer install

        cp .env.example .env

Make sure your server, create "webcore" database, edit .env using your favorite editor, 
for example using nano editor copy and paste this in terminal, and hit Enter key

    sudo nano .env

then

    php artisan key:generate

* Using Composer

        composer create-project dandisy/webcore {your-project-name}

        cd {your-project-name}

then

    php artisan migrate --seed

    php artisan storage:link

then get its all on your favorite browser

    http://localhost/webcore/public

    and

    http://localhost/webcore/public/admin

Default users are

    - superadminstrator@app.com
    - administrator@app.com
    - user@app.com

    with default password is password

--OPTIONAL--

if you want to activated oauth,

edit the uri oauth in vue files in resources/assets/js/components/passport

    php artisan passport:keys

    npm install

    npm run dev

then you can access oauth admin panel 
to manage your oauth client in 

    http://localhost/webcore/public/oauth-admin

### Usage

* As Web CMS :

run these command in your terminal 

( for tidiness, webcore already prepared menu items, so you can use --skip=menu in generate command for Page, Post, Banner and Presentation)

    php artisan generate:api_scaffold Page --fieldsFile=Page.json --datatables=true --prefix=admin --logs

    php artisan generate:api_scaffold Post --fieldsFile=Post.json --datatables=true --prefix=admin --logs

    php artisan generate:api_scaffold Banner --fieldsFile=Banner.json --datatables=true --prefix=admin --logs

    php artisan generate:api_scaffold Presentation --fieldsFile=Presentation.json --datatables=true --prefix=admin --logs

then

    composer require dandisy/webcore-page:dev-master

    php artisan vendor:publish --provider="Webcore\Page\PageServiceProvider" --tag=config

if you want Webcore Page System themes & components sample code

download in https://github.com/dandisy/themes (don't clone)

then extract to your project root directory

see https://github.com/dandisy/webcore-page for more info

then run

    composer require dandisy/webcore-menu:dev-master

    php artisan vendor:publish --provider="Harimayco\Menu\MenuServiceProvider"

    php artisan vendor:publish --provider="Webcore\Menu\MenuServiceProvider" --tag=models

    php artisan migrate

see https://github.com/dandisy/webcore-menu for more info

for tidiness,

last, you can arrange Admin Page side menu in resources/views/layouts/menu.blade.php

    delete generated menu items in the end of menu.blade.php

    uncomment already prepared menu items for Pages, Posts, Banners, Presentations and Menus 

* As Admin App (no public site in frontend)

run these command in your terminal, if you have schema model file 

(change YourModel to the name of your model to be generate )

    php artisan generate:api_scaffold YourModel --fieldsFile=YourModel.json --datatables=true

or if you want to spesify field interactively in terminal

    php artisan generate:api_scaffold YourModel --datatables=true

### Running Example

    if you still confused with above usage instruction you can explore your self and try to install already running completely webcore platform as website cms

download it in https://github.com/dandisy/webcore-sample

### Features

1. Admin Template

    ![AdminLTE](https://camo.githubusercontent.com/e3bbc646d6ff473da2dd6cede2c968846a6982a6/68747470733a2f2f61646d696e6c74652e696f2f41646d696e4c5445322e706e67)

2. File Manager

    ![File Manager](https://cloud.githubusercontent.com/assets/74367/15646143/77016990-265c-11e6-9ecc-d82ae2c74f71.png)

3. Menu Manager

    ![Menu Manager](https://camo.githubusercontent.com/4da267766ad9a79696f8baf988115005ba8bfa9e/68747470733a2f2f7332382e706f7374696d672e6f72672f706678686e716367642f73637265656e73686f745f32303137303831315f3135303331332e706e67)

4. Image Manipulation

        to manipulate image use http://localhost/webcore/public/img/{path}?{param=value}

        default {path} is configured relative to public_path, see .env for FILESYSTEM_DRIVER and config/filesystems.php
        
    see Glide documentation in http://glide.thephpleague.com for manual guide

5. Laravel Generator based on infyomlabs/laravel-generator with Additional features

    - Date Time Picker (htmltype = date-picker, time-picker or datetime-picker)
    - Select2 (all select input will be select2)
    - HTML Text Editor (htmltype = text-editor)
    - File Manager (htmltype = file-manager or files-manager)
    - Nullable field in migration
    - Logged fields : created_by and updated_by (console option = --logs)

see sample model schema files in resources/model_schemas

6. Page System (support themes, template position and view components)

    Sample code can be download in https://github.com/dandisy/themes

7. Reusable Component

    - by Widget (Widget Class & Widget View) using arrilot/laravel-widgets for UI Component

        as much as possible the widget should have a loose coupled, bring data on the fly, avoid directly include / use in widget class

        webcore include a widget, with this you able to use shortcode on Page description field
        to get datasource from models, use syntax :
        [source=ModelName,where=some_field_name:value,position:some_theme_position,widget=some_widget_view]

    - by Laravel Package

        webcore include webcore-microsite package as sample code for basic package

8. Pre Configured Oauth using Laravel Passport (with RESTAPI resources example)

    - to login use http://localhost/webcore/public/oauth/token

            with params :

                - client_id
                - client_secret
                - grant_type
                - username
                - password
                - scope

    - to get resources example http://localhost/webcore/public/api/product

            with header Authorization = Bearer {token}

### Dependency

    * dandisy/adminlte-templates based on infyomlabs/adminlte-templates
    * dandisy/laravel-generator based on infyomlabs/laravel-generator
    * dandisy/swagger-generator based on infyomlabs/swagger-generator
    * dandisy/filemanager based on infinety-es/filemanager

    * arrilot/laravel-widgets
    * barryvdh/laravel-debugbar
    * league/glide-laravel
    * santigarcor/laratrust
    * harimayco/laravel-menu
    * atayahmet/laravel-nestable

    If you activated laravel passport use :
    * spatie/laravel-cors
    
    * pragmarx/tracker or jeremykenedy/laravel-logger
    * spatie/laravel-activitylog

    * fireguard/report or jimmyjs/laravel-report-generator

    * barryvdh/laravel-dompdf or seguce92/laravel-dompdf
    * maatwebsite/excel
    * khill/lavacharts
    
    if use additional jwt package
    * tymon/jwt-auth

    if use other theme package :
    facuz/laravel-themes based on thinhbuzz/laravel-theme
    or yaapis/Theme
    or teepluss/laravel-theme
    
    * nwidart/laravel-modules -> OPTIONAL
    * lavary/laravel-menu -> OPTIONAL
    * h4cc/wkhtmltopdf-amd64 -> OPTIONAL

    * toxic-lemurs/menu-builder -> ALTERNATIVE
    * mkdesignn/menubuilder -> ALTERNATIVE

//------------------------------------------------#


## 2. Laravel Generator

Webcore use infyomlabs/laravel-generator, with renamed artisan command for
more generic, to :

    php artisan generate[.command]:{command} {Model_name} [option]

See infyomlabs/laravel-generator documentation here http://labs.infyom.com/laravelgenerator

### Perspective :

    HUMAN
    Interface       -   Tools (Worker)              -   Executor
    Commands\*      -   Common\* and Utils\*        -   Generators\* 
    
    COMPUTER
    Interface       -   Tools (Worker)              -   Executor
    Generators\*    -   Common\* and Utils\*        -   Commands\*
    
### Guidance

1. To add HTML type definition, add and edit these :
    * add stub file in adminlte-templates\templates\scaffold\fields
    * add stub file in adminlte-templates\templates\vuejs\fields
    * edit Utils\HTMLFieldGenerator

    * edit Generators\ViewGenerator
    * edit Generators\VueJs\ViewGenerator

2. To add command, command option, or fields option
    * edit or add Common\\*
    * edit or add Commands\\* (BaseCommand, etc)
        
### Note

* Commands\\* : 
    
    use Common\CommandData, 
    use Utils\FileUtil,
    use Generator\\* 
    
    base Commands\BaseCommand

    - parsing console command
    - initializing commandData
    - execute Generators\\* to generating files and migrating database table

* Utils\GeneratorFieldsInputUtil : 
    
    use Common\GeneratorField

    - get fields specification from console command
    - return field specification by utilizing Common\GeneratorField

* Utils\HTMLFieldGenerator : 
    
    use Common\GeneratorField

    - return fieldTemplate will be used

* Common\GeneratorField : 

    - parsing parts of fields specification (db type, html input, option)
    - preparing migration

* Common\GeneratorConfig :
    
    - load, init and set config
    - get console command option

* Common\CommandData : 

    use Utils\GeneratorFieldsInputUtil,
    use Utils\TableFieldsGenerator
    
    - get and set commandData from config, file, and console

* Generators\\* : 

    use Utils\FileUtil,
    use Common\CommandData,
    use Utils\HTMLFieldGenerator in Generators\Scaffold\ViewGenerator
    
    base Generators\BaseGenerator

    - define generator functionality with data and template parameters to be used
    - define rollback

//------------------------------------------------#


## 3. Roadmap

Versions

    1.0.0 Single Platform
    1.1.0 Easy Platform
    1.2.0 In Context Platform
    1.3.0 Experience Platform
    1.4.0 Enterprise Platform
    1.5.0 Digital Solution


#
by dandi@redbuzz.co.id
