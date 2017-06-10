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
    to format a layout and styling its generally by incorporating a template
    
3. Front Page

    Scope of Front Page :    
    provide User Experience with content personalization using Persona & Pattern


### Todo

1. user, role and permission
2. page and template
3. component
4. personalization

5. artisan generate import excel
6. artisan generate select2 with data from related model
7. ui menu, like wordpress menu

//------------------------------------------------#

## 2. Laravel Generator
###Perspective :

    HUMAN
    Interface       -   Middle Tools (Definition)   -   Executor
    Commands\*      -   Common\* and Utils\*        -   Generators\* 
    
    COMPUTER
    Interface       -   Middle Tools (Definition)   -   Executor
    Generators\*    -   Common\* and Utils\*        -   Commands\*    
    
### Guidance

    *   Edit : to add HTML type definition
        Utils\HTMLFieldGenerator and ViewGenerator Generators\VueJs
        
### Note

* Generators\* : 

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

* Commands\* : 

    - init commonData
    - set model name from console to commonData
    - execute generator function including get argument model, and options skip, save from console
    
    use Common\CommandData, Utils\FileUtil, Generator\* 
    
    base Commands\BaseCommand


### Todo:

- create function in Generators\BaseGenerator  or Commands\RollbackGeneratorCommand
with create utils class in Utils\
for delete table and migration data on db

#
by dandi@redbuzz.co.id