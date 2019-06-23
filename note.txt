swaggervel
	if error
	Temporary solution
	Go to vendor/jlapp/swaggervel/src/Jlapp/Swaggervel/routes.php

	Remove this two line

	Blade::setEscapedContentTags('{{{', '}}}');
	Blade::setContentTags('{{', '}}');