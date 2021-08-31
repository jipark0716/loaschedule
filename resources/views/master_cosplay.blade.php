@extends('layout')

@section('title', '숙코노트')

@section('content')
<main>
    <div class="border-0 bg-white p-2 h-100">
        <form onsubmit="search(this.name.value)" action="javascript:void(0)">
            <div class="row">
                <div class="col-md-8 col-4">
                    <div class="btn-group">
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#pin-modal">박제</button>
                    </div>
                </div>
                <div class="col-md-4 col-8">
                    <input class="form-control" type="text" name="name" placeholder="Default input" aria-label="default input example">
                </div>
            </div>
        </form>
        <div id="result">

        </div>
    </div>
</main>

<div class="modal fade" id="pin-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenteredLabel">박제</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <form action="javascript:void(0)" id="pin-form">
                        <mwc-textfield label="범인" class="col-12 mb-3" name="name"></mwc-textfield>
                        <mwc-textfield label="제보자" class="col-12 mb-3" name="author"></mwc-textfield>
                        <mwc-textarea label="사유" class="col-12 mb-3" name="why"></mwc-textarea>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-text-primary me-2" type="button" data-bs-dismiss="modal">참기</button>
                <button class="btn btn-text-primary" type="button" onclick="pin()">참지않기</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
let pin = () => {
    $.ajax({
        url: @json(route('master.cosplay.pin')),
        method: 'put',
        data: {
            name: document.querySelector('#pin-form [name=name]').value || '',
            author: document.querySelector('#pin-form [name=author]').value || '',
            why: document.querySelector('#pin-form [name=why]').value || '',
        },
        success: (response) => {
            $('#pin-modal').modal('hide')
            console.log(response);
        }
    })
}
let search = (name) => {
    $.ajax({
        url: @json(route('master.cosplay.search')),
        data: {
            name: name,
        },
        success: (response) => {
            console.log(response);
        }
    })
}
</script>
@endsection
