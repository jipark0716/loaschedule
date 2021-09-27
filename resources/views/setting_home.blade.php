@extends('layout')

@section('title', '세팅도우미')

@section('content')
<main>
    <div class="container-xl px-5">
        <div class="d-flex mt-10 mb-4 align-items-center">
            <h1 class="page-header mb-0">세팅도우미</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 p-2">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">서버</th>
                                <th scope="col">직업</th>
                                <th scope="col">템랩</th>
                                <th scope="col">닉네임</th>
                                <th scope="col">-</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($characters as $character)
                                <tr>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $character->server }}</td>
                                    <td>{{ $character->class }}</td>
                                    <td>{{ $character->item_level }}</td>
                                    <td>{{ $character->name }}</td>
                                    <td>
                                        <a href="{{ route('character.accessory', $character) }}" class="btn btn-primary btn-icon">
                                            <i class="material-icons">list</i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
