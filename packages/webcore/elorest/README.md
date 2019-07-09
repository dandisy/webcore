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

##### Paste it (elorest route) to your laravel project (routes/api.php)

    Elorest::routes();

    or with middleware

    Elorest::routes([
        'middleware' => ['auth:api', 'throttle:60,1'],
        // 'only' => ['post', 'put', 'patch', 'delete'],
        'except' => ['get']
    ]);


##### Exception handling 

Using laravel errors handler (https://laravel.com/docs/5.8/errors)

Publish exception hendler class to your laravel webcore project

    php artisan vendor:publish --provider="Webcore\Elorest\ElorestServiceProvider" --force

##### Authentication
  
Using laravel passport (https://laravel.com/docs/5.8/passport)

##### Authorization

Using laravel gates & policies (https://laravel.com/docs/5.8/authorization)

##### Formatable JSON response (Beta)

see the sample/response_format.blade.php file

### Documentation

Get All

    https://your-domain-name/api/elorest/Models/Post

    for

    App\Models\Post::all();

Find By ID

    https://your-domain-name/api/elorest/Models/Post/7

    for

    App\Models\Post::find(7);

Get Where and First

    https://your-domain-name/api/elorest/Models/Author?where=name,like,%dandi setiyawan%&select=*&first=

    for

    App\Models\Author::where('name', 'like', '%dandi setiyawan%')->first();

Get Count (aggregate)

    https://your-domain-name/api/elorest/Models/Author?count=*

    for

    App\Models\Author::count();

Get Join (multi join)

    https://your-domain-name/api/elorest/Models/User?join[]=contacts,users.id,contacts.user_id&join[]=orders,users.id,orders.user_id&select=users.*,contacts.phone as user_phone,orders.price as order_price&get=

    for

    App\Model\User::join('contacts', 'users.id', '=', 'contacts.user_id')
        ->join('orders', 'users.id', '=', 'orders.user_id')
        ->select('users.*', 'contacts.phone', 'orders.price')
        ->get();

Get WhereIn

    https://your-domain-name/api/elorest/Models/Author?whereIn=id,[1,2,3]&get=*

    for

    App\Models\Author::whereNotIn('id', [1, 2, 3])
        ->get(*);

Get Multi With and Where (multi nested closure)

    https://your-domain-name/api/elorest/Models/Post?&with=author(with=city(where=name,like,%jakarta%)),comment&get=*

    for

    App\Models\Post::with(['author' => function($query) {
        $query->with(['city' => function($query) {
            $query->where('name', 'like', %jakarta%)
        }]);
    }])
    ->with('comment')
    ->get(*);

Update By ID

    var settings = {
        "async": true,
        "crossDomain": true,
        "url": "http://localhost/webcore/public/api/elorest/User/2",
        "method": "PUT",
        "headers": {
            "content-type": "application/json",
            "cache-control": "no-cache",
            "postman-token": "833c6c7e-87f7-e527-e1ba-62a21aa39aff"
        },
        "processData": false,
        "data": {votes: 1}
    }

    $.ajax(settings).done(function (response) {
        console.log(response);
    });

Update Where

    PUT /webcore/public/api/elorest/User?where=email,dandi.setiyawan@redtech.co.id&amp;select=*&amp;first= HTTP/1.1
    Host: localhost
    Content-Type: application/json
    Cache-Control: no-cache
    Postman-Token: fa3347b0-1f44-8622-a078-42b1369bbdd7

    {
        "votes": 1
    }

    or

    var data = JSON.stringify({
        "votes": 1
    });

    var xhr = new XMLHttpRequest();
    xhr.withCredentials = true;

    xhr.addEventListener("readystatechange", function () {
        if (this.readyState === 4) {
            console.log(this.responseText);
        }
    });

    xhr.open("PUT", "http://localhost/webcore/public/api/elorest/User?where=email,dandi.setiyawan@redtech.co.id&select=*&first=");
    xhr.setRequestHeader("content-type", "application/json");
    xhr.setRequestHeader("cache-control", "no-cache");
    xhr.setRequestHeader("postman-token", "0ea7fa6a-b7d2-73e2-81e6-10ca983de686");

    xhr.send(data);

    for

    App\Models\Author::where('email', 'dandi.setiyawan@redtech.co.id')
        ->update(['votes' => 1]);

### Extensible

    - create your classes inherit or implement from the Elorest artifacts
    - override or create new methods
    - register your route
