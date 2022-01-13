@extends('layout')

@section('title', Auth::user()->guild_name.' 길드팟')

@section('content')
<main>
    <div class="container-xl px-5">
        <div class="d-flex mt-10 mb-4 align-items-center">
            <h1 class="page-header mb-0">{{ Auth::user()->guild_name }}</h1>
        </div>
    </div>
    <div class="row">
        @foreach ($parties as $party)
            <div class="card card-raised mx-2 mb-2 col-md-4 col-sm-6">
                <div class="card-body">
                    <h2 class="card-title">{{ $party->name ?? $party->content->full_name }}</h2>
                    <p class="card-text">
                        @foreach ($party->member as $member)
                            <div class="col-12 mb-1">
                                <button class="btn btn-raised-dark btn-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="right" title="{{ $member->author->name }}님이 추가함">
                                    <img width="30" src="{{ $member->character->class_image }}" alt="{{ $member->character->class }}">
                                    {{ $member->character->name }}
                                </button>
                            </div>
                        @endforeach
                    </p>
                </div>
                <div class="card-actions">
                    <div class="card-action-icons">
                        <button class="btn btn-text-dark btn-icon btn-lg float-right" onclick="appendMember({{ $party->getKey() }})">
                            <i class="material-icons">add</i>
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</main>
<div class="fixed-bottom mb-3 mx-3">
    <button class="btn btn-outline-dark btn-icon float-right btn-lg" data-bs-toggle="modal" data-bs-target="#create-party" type="button">
        <i class="material-icons">add</i>
    </button>
</div>
<div class="modal fade" id="create-party" tabindex="-1" aria-labelledby="create-party" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">파티 생성</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="javascript:void(0)" id="create-party-form">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">제목</label>
                        <input type="text" class="form-control" id="title" name="title">
                    </div>
                    <div class="mb-3">
                        <label for="content-id" class="form-label">컨텐츠</label>
                        <select class="selectpicker form-control" id="content-id" name="content_id">
                            @foreach ($categories as $category)
                                <optgroup label="{{ $category->name }}">
                                    @foreach ($category->content as $content)
                                        <option value="{{ $content->getKey() }}" title="{{ $category->name }} - {{ $content->name }}">{{ $content->name }}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">날짜</label>
                        <input type="date" class="form-control" id="date" name="date" value="{{ now()->format('Y-m-d') }}">
                    </div>
                    <div class="mb-3">
                        <label for="time" class="form-label">시간</label>
                        <input type="time" class="form-control" id="time" name="time">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-text-primary" type="submit">생성</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="add-party-member" tabindex="-1" aria-labelledby="create-party" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">맴버 추가</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="javascript:void(0)" id="add-party-member-form">
                <div class="modal-body">
                    <div class="mb-3 account-select"></div>
                    <div class="mb-3 character-select"></div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-text-primary" type="submit">추가</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
let partyId
$('#create-party-form').submit((event) => {
    $.ajax({
        url: @json(route('party.create')),
        method: 'post',
        data: new FormData(event.target),
        contentType: false,
        processData: false,
        success: (response) => {
            event.target.reset()
            $('[name=content_id]').selectpicker('refresh')
            $('#create-party').modal('hide')
        }
    })
})
$('#add-party-member').submit((event) => {
    $.ajax({
        url: `/party/${partyId}/member`,
        method: 'post',
        data: new FormData(event.target),
        contentType: false,
        processData: false,
        success: (response) => {
            $('#add-party-member').modal('hide')
        }
    })
})
appendMember = (id) => {
    partyId = id
    $.ajax({
        url: `/party/account/${partyId}`,
        success: (response) => {
            $('.account-select').html(response)
            $('.selectpicker').selectpicker()
            $('.character-select').html('')
            $('#add-party-member').modal('show')
        }
    })
}
selectAccount = (id) => {
    $.ajax({
        url: `/party/account/${partyId}/character/${id}`,
        success: (response) => {
            $('.character-select').html(response)
            $('.selectpicker').selectpicker()
        }
    })
}
</script>
@endsection
