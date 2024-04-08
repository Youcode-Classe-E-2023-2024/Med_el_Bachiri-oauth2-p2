@extends('layouts.app')
@section('content')

    <div id="view" class="h-full w-screen flex flex-row" x-data="{ sidenav: true }">
        @include('layouts.dash-sidebar')

        <div>
            div 1
        </div>

    </div>
@endsection
