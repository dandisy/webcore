# Elorest
Laravel eloquent REST API package

With it we can query the restapi using the laravel eloquent commands (methods & params)

Borrow the laravel eloquent syntax (methodes & params), including laravel pagination.

please check the laravel's eloquent documentation https://laravel.com/docs/5.8

Example queries :

    if model namespace is App\Models
    https://your-domain-name/api/elorest/Models/Post?leftJoin=comments,posts.id,comments.post_id&whereIn=category_id,[2,4,5]&select=*&get=
    https://your-domain-name/api/elorest/Models/Post?join[]=authors,posts.id,authors.author_id&join[]=comments,posts.id,comments.post_id&whereIn=category_id,[2,4,5]&select=posts.*,authors.name as author_name,comments.title as comment_title&get=
    https://your-domain-name/api/elorest/Models/Post?&with=author,comment&get=*
    https://your-domain-name/api/elorest/Models/Post?&with=author(where=name,like,%dandisy%),comment&get=*
    multi first nested closure deep
    https://your-domain-name/api/elorest/Models/Post?&with=author(where=name,like,%dandisy%)(where=nick,like,%dandisy%),comment&get=*
    second nested closure deep
    https://your-domain-name/api/elorest/Models/Post?&with=author(with=city(where=name,like,%jakarta%)),comment&get=*
    https://your-domain-name/api/elorest/Models/Post?&with[]=author(where=name,like,%dandisy%)&with[]=comment(where=title,like,%test%)&get=*
    https://your-domain-name/api/elorest/Models/Post?paginate=10&page=1

    if model namespace only App 
    https://your-domain-name/api/elorest/User?paginate=10&page=1

### Installation

    composer require dandisy/elorest

### Usage

Add elorest route in your laravel project (routes/api.php)

    Elorest::routes();

    or with middleware

    Elorest::routes([
        'middleware' => ['auth:api', 'throttle:60,1'],
        // 'only' => ['post', 'put', 'patch', 'delete'],
        'except' => ['get']
    ]);

### Extensible

    - create class inherit from Webcore\Elorest\Elorest class
    - override or create static route methods
    - register your route methods
