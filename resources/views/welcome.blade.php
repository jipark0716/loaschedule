@extends('layout')

@section('title', 'ㅇㅇ')

@section('content')
<main>
    <div class="row">
        <div class="col-md-12 p-2">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <colgroup>
                            <col width="20%">
                            <col width="80%">
                        </colgroup>
                        <thead>
                            <tr>
                                <th scope="col">DATE</th>
                                <th scope="col">Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2021-09-23</td>
                                <td>
                                    닉네임 툴팁 직업명 추가 및 클릭시 캐릭터명 복사 <br>
                                    내 숙제만 수정하도록 변경 <br>
                                    도서관에 장인의 기운에 따른 성공률 그래프 추가
                                </td>
                            </tr>
                            <tr>
                                <td>2021-09-22</td>
                                <td>다른 계정 검색</td>
                            </tr>
                            <tr>
                                <td>2021-09-17</td>
                                <td>
                                    캐릭터별 메모 추가 </br>
                                    일간숙제 레이아웃 변경
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
