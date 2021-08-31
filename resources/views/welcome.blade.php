@extends('layout')

@section('content')
<div class="col-md-4">
    <div class="card card-raised">
        <div class="card-body">
            <h2 class="card-title">계정추가</h2>
        </div>
        <div class="card-actions">
            <form action="javascript:void(0)" onsubmit="addAccount($(this).find('[name=name]').val())">
                <div class="row">
                    <div class="col-8">
                        <mwc-textfield name="name" label="닉네임"></mwc-textfield>
                    </div>
                    <div class="col-4" style="text-align: right;">
                        <button type="submit" class="btn btn-text-dark btn-icon btn-lg"><i class="material-icons">add</i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
