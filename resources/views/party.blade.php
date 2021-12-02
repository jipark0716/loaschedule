@extends('layout')

@section('title', Auth::user()->guild_name.' 길드팟')

@section('content')
<main>
    <div class="container-xl px-5">
        <div class="d-flex mt-10 mb-4 align-items-center">
            <h1 class="page-header mb-0">{{ Auth::user()->guild_name }}</h1>
        </div>
    </div>
</main>
@endsection

@section('scripts')
@endsection
