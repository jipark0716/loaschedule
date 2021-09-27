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
                                @foreach ($activeBuff as $buff => $l)
                                    <th scope="col">{{ $buff }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td scope="row">각인서</td>
                                @foreach ($activeBuff as $buff => $l)
                                    <td class="p-0 px-4 text-center">
                                        <mwc-slider
                                         pin
                                         markers
                                         class="w-100"
                                         type="range"
                                         step="3"
                                         value="{{ $buffs['book'][$buff] ?? 0 }}"
                                         min="0"
                                         max="12">
                                        </mwc-slider>
                                    </td>
                                @endforeach
                            </tr>
                            <tr>
                                <td scope="row">돌</td>
                                @foreach ($activeBuff as $buff => $l)
                                    <td class="p-0 px-4 text-center">
                                        <mwc-slider
                                         pin
                                         markers
                                         class="w-100"
                                         type="range"
                                         step="1"
                                         value="{{ $buffs['stone'][$buff] ?? 0 }}"
                                         min="0"
                                         max="10">
                                        </mwc-slider>
                                    </td>
                                @endforeach
                            </tr>
                            @foreach (['목걸이', '귀걸이', '귀걸이', '반지', '반지'] as $i => $name)
                                <tr>
                                    <td scope="row">{{ $name }}</td>
                                    @foreach ($activeBuff as $buff => $l)
                                        <td>{{ isset($buffs['accessory'][$i][$buff]) ? $buffs['accessory'][$i][$buff] : '-' }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th scope="col">등급</th>
                                @foreach ($activeBuff as $buff => $level)
                                    <th scope="col">{{ $level }}</th>
                                @endforeach
                            </tr>
                            <tr>
                                <th scope="col">레벨</th>
                                @foreach ($activeBuff as $buff => $level)
                                    <th scope="col">{{ floor($level / 5) > 3 ? 3 : floor($level / 5) }}</th>
                                @endforeach
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
