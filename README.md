## 1. webCore Platform
### The Concept

    Admin Page - UI Component - Front Page

1. Admin Page (CMS)
    
    Scope of CMS :    
    preparing user input, and then for input data manually or by data source
    
2. UI Component (just a part of page)

    Scope of UI Component :    
    provide reusable part of UI (complete laravel module) to glue in template of page,
    and defining tracking configuration user interaction for personalization
         
    Scope of Page :    
    layout and styling UI Component generally to be a Page by incorporating a template
    
3. Front Page

    Scope of Front Page :    
    provide User Experience with content personalization using Persona and Pattern

### Installation

Copy and paste in terminal line by line, just hit Enter key

    git clone https://github.com/dandisy/webCore.git

    composer install

    rm -r vendor/infyomlabs
    
    cp -r infyomlabs vendor

    cp .env.example .env

Make sure your server, create "core" database, edit .env using your favorite editor, 
for example using nano editor copy and paste this in terminal, and hit Enter key

    sudo nano .env

Again copy and paste in terminal line by line, and hit Enter key

    php artisan key:generate

    php artisan migrate --seed

then get it all on your favorite browser,

### Todo

1. GUI for manage Admin Menu
2. GUI for define form
3. GUI for create widget component
3. artisan generate html input (select) with data from related model
    - define field option, 
    - add get option in Common\GeneratorField, 
    - add htmlvalue in Utils\HTMLFieldGenerator - and passing to template,
    - insert get repository in controller create and edit generator

4. ui menu, like wordpress menu

5. personalization

//------------------------------------------------#

## 2. Laravel Generator
### Perspective :

    HUMAN
    Interface       -   Middle Tools (Definition)   -   Executor
    Commands\*      -   Common\* and Utils\*        -   Generators\* 
    
    COMPUTER
    Interface       -   Middle Tools (Definition)   -   Executor
    Generators\*    -   Common\* and Utils\*        -   Commands\*    
    
### Guidance

    *   To add HTML type definition, edit this :
        Utils\HTMLFieldGenerator and ViewGenerator Generators\VueJs
        
### Note

* Generators\\* : 

    - generate file with passing dynamic variables from CommandData to template
    - rollback

    use Utils\FileUtil, Common\CommandData    
    use Utils\HTMLFieldGenerator in Generators\Scaffold\ViewGenerator
    
    base Generators\BaseGenerator

* Common\commonData : 
    
    - get model spec from console, json, or table 
    - set commandObj
    - get config
    - get and set option
    - set dynamic variable

    use Utils\GeneratorFieldsInputUtil, Utils\TableFieldsGenerator

* Common\GeneratorConfig : 
    
    - load and add dynamic variables.
    - get or load config
    - set option

* Common\GeneratorField : 

    - parse parts of fields spec (db type, html input, option)

* Utils\GeneratorFieldsInputUtil : 

    - get fields spec from command line input
    - prepare array
    
    use Common\GeneratorField

* Utils\SchemaUtil : 

    - create model fields schema

* Utils\HTMLFieldGenerator : 

    - generate html field with parameter $templateType
    
    use Common\GeneratorField

* Utils\TableFieldsGenerator : 

    - get fields spec from table
    - detect relation from table
    
    use Common\GeneratorField, Common\GeneratorFieldRelation

* Commands\\* : 

    - init commonData
    - set model name from console to commonData
    - execute generator function including get argument model, and options skip, save from console
    
    use Common\CommandData, Utils\FileUtil, Generator\* 
    
    base Commands\BaseCommand


### Todo:

- create function in Generators\BaseGenerator with create utils class in Utils\ for delete table and 
migration data on database

//------------------------------------------------#

### Dependency

    * infyomlabs/laravel-generator
    * santigarcor/laratrust
    * tymon/jwt-auth
    * atayahmet/laravel-nestable
    * infinety-es/filemanager
    * barryvdh/laravel-debugbar
    * nwidart/laravel-modules
    * seguce92/laravel-dompdf
    * maatwebsite/excel
    * arrilot/laravel-widgets
    * khill/lavacharts
    * spatie/laravel-activitylog

    For theme use :
    facuz/laravel-themes based on thinhbuzz/laravel-theme
    or yaapis/Theme
    instead teepluss/laravel-theme

//------------------------------------------------#

### List of Packages

    * infyomlabs/laravel-generator
        - laracasts/flash
        - prettus/l5-repository
            - prettus/laravel-validation
    * barryvdh/laravel-ide-helper
        - barryvdh/reflection-docblock
        - symfony/class-loader
    * jlapp/swaggervel
        - zircote/swagger-php
            - doctrine/annotations
            - symfony/finder
    * yajra/laravel-datatables-oracle
        - league/fractal
        - laravelcollective/html
        - maatwebsite/excel
            - phpoffice/phpexcel
            - tijsverkoyen/css-to-inline-styles
                - symfony/css-selector
            - nesbot/carbon
                - symfony/translation
        - dompdf/dompdf
            - phenx/php-font-lib
            - phenx/php-svg-lib
    * barryvdh/laravel-debugbar
        - maximebf/debugbar
            - symfony/var-dumper
            - psr/log
        - symfony/finder
    * santigarcor/laratrust
        - kkszymanowski/traitor
            - nikic/php-parser
    * teepluss/laravel-theme
        - twig/twig
    * atayahmet/laravel-nestable
    * nwidart/laravel-modules
    * infinety-es/filemanager
        - chumper/zipper
    * seguce92/laravel-dompdf
        - dompdf/dompdf
            - phenx/php-font-lib
            - phenx/php-svg-lib
    * khill/lavacharts
        - nesbot/carbon
            - symfony/translation
    * tymon/jwt-auth
        - namshi/jose
            - phpseclib/phpseclib
        - nesbot/carbon
            - symfony/translation
    * arrilot/laravel-widgets
    
    * lavary/laravel-menu -> OPTIONAL

#
by dandi@redbuzz.co.id