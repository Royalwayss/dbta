<!DOCTYPE html>
<html lang="en">
<head>
	@include('front.elements.meta-tag')
	@include('front.elements.style')
</head>
<body>
	@include('front.elements.header')
	@yield('content')
	@include('front.elements.footer')
    @include('front.elements.script')
</body>
</html>