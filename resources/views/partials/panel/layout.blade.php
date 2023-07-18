@include('partials.panel.head')
@include('partials.panel.header')
<main style="margin-top: 58px;">
    <!-- p-5 -->
    <div id="removecontainerpadding" class="container-fluid">
        @yield('content')
    </div>
</main>
@include('partials.panel.footer')
