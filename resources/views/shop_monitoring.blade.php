@extends('layout')

@section('title', '경매장')

@section('content')
<main>
    <div class="container-xl px-5">
        <div class="d-flex mt-10 mb-4 align-items-center position-relative">
            <h1 class="page-header mb-0">경매장</h1>
            <button class="btn btn-primary position-absolute end-0" type="button" data-bs-toggle="modal" data-bs-target="#create-modal">추가</button>
        </div>
    </div>
    <div class="row">

    </div>
</main>


<div class="modal fade" id="create-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">추가</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <form action="javascript:void(0)" id="create-form">
                        <div class="row">
                            <div class="col-md-3">
                                <label>프리셋 이름</label>
                            </div>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="name">
                            </div>
                        </div>
                        <hr>
                        @include('form.select', [
                            'class' => 'col-12 mb-3',
                            'label' => '카테고리',
                            'name' => 'cate',
                            'options' => config('shop.search.cate'),
                        ])
                        @include('form.select', [
                            'class' => 'col-12 mb-3',
                            'label' => '등급',
                            'name' => 'grade',
                            'options' => config('shop.search.grade'),
                        ])
                        @include('form.select', [
                            'class' => 'col-12 mb-3',
                            'label' => '품질',
                            'name' => 'quality',
                            'options' => config('shop.search.quality'),
                        ])
                        @for ($i=0; $i < 4; $i++)
                            <hr>
                            @include('form.select', [
                                'class' => 'col-6 mb-3',
                                'label' => '기타',
                                'name' => 'etc['.$i.']',
                                'on' => [
                                    'change' => 'console.log($(this).next())'
                                ],
                                'options' => config('shop.search.etc'),
                                'optionSub' => config('shop.search.etc_sub'),
                                'optionGroup' => true,
                            ])
                            <div class="row">
                                <div class="col-md-3">
                                    <label>수치</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <input class="form-control" type="number" name="etcmin[{{ $i }}]">
                                        <span class="input-group-text">~</span>
                                        <input class="form-control" type="number" name="etcmax[{{ $i }}]">
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-text-primary me-2" type="button" data-bs-dismiss="modal">닫기</button>
                <button class="btn btn-text-primary" type="button" onclick="$('#create-form').submit()">추가</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
$('#create-form').submit((event) => {
    let request = new FormData(event.target)
    $.ajax({
        url: @json(route('shop.monitoring.create')),
        method: 'post',
        contentType: false,
        processData: false,
        data: request,
        success: (response) => {
            console.log(response);
        }
    })
})
</script>
@endsection
