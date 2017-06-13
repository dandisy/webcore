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

1. user, role and permission
2. artisan generate html input (select) with data from related model
    - define field option, 
    - add get option in Common\GeneratorField, 
    - add htmlvalue in Utils\HTMLFieldGenerator - and passing to template,
    - insert get repository in controller create and edit generator
3. page and template (front page)
4. component (admin and front page)

5. ui menu, like wordpress menu

6. personalization

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

### References

    * infyomlabs/laravel-generator
    * santigarcor/laratrust
    * tymon/jwt-auth
    * infinety-es/filemanager
    * barryvdh/laravel-debugbar
    * nwidart/laravel-modules
    * seguce92/laravel-dompdf
    * maatwebsite/excel
    * teepluss/laravel-theme
    * arrilot/laravel-widgets
    * khill/lavacharts
    * reportico-web/laravel-reportico

#
by dandi@redbuzz.co.id