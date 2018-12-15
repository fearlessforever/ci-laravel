<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        @component('layouts.header') 
			@slot('title',$title)
		@endcomponent
		@stack('styles')
    </head>
<body>

@yield('content')
@component('layouts.js')@endcomponent

@stack('scripts')
	</body>
</html>
