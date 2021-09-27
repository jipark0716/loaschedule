@extends('layout')

@section('title', $account->nick_name)

@section('content')
<main>
    <div class="container-xl px-5">
        <div class="d-flex mt-10 mb-4 align-items-center">
            <h1 class="page-header mb-0">{{ $account->nick_name }}</h1>
        </div>
    </div>
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#week" type="button" role="tab" aria-controls="week" aria-selected="false">주간</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#day" type="button" role="tab" aria-controls="day" aria-selected="true">일간</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">메모</button>
        </li>
    </ul>
    <div class="tab-content border border-top-0 p-3 bg-white scrollbar-primary" style="height:calc(100vh - 300px); overflow-y: auto;">
        <div class="tab-pane fade show active" id="week" role="tabpanel" aria-labelledby="week-tab">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        @foreach ($contents as $content)
                            <th scope="col">{{ $content->name }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($characters as $character)
                        <tr>
                            <th scope="row">
                                <button
                                 class="btn btn-text-primary"
                                 type="button"
                                 data-bs-toggle="tooltip"
                                 data-bs-placement="top"
                                 onclick='copy(@json($character->name))'
                                 title="{{ $character->class }} / {{ number_format($character->item_level) }}">
                                    {{ $character->name }}
                                </button>
                            </th>
                            @foreach ($contents as $content)
                                <th class="text-center p-0 px-2 {{ $character->item_level < $content->min_level ? 'not-active' : '' }}" style="vertical-align: middle;{{ $character->item_level >= $content->max_level ? 'background: #ff9999;' : '' }}">
                                    @if ($content->step == 1)
                                        <input
                                         class="form-check-input week-content-checkbox"
                                         data-character-id="{{ $character->getKey() }}"
                                         data-content-id="{{ $content->getKey() }}"
                                         type="checkbox"
                                         value=""
                                         {{ $character->week->where('content_id', $content->getKey())->count() == 1 ? 'checked' : '' }}
                                         {{ $character->item_level < $content->min_level ? 'disabled' : '' }}>
                                    @else
                                        @mobile()
                                            <select
                                             class="week-content-checkbox"
                                             data-character-id="{{ $character->getKey() }}"
                                             data-content-id="{{ $content->getKey() }}"
                                             {{ $character->item_level < $content->min_level ? 'disabled' : '' }}>
                                                @for ($i=0; $i <= $content->step; $i++)
                                                    <option value="{{ $i }}" {{ (($work = $character->week->where('content_id', $content->getKey())->first()) ? $work->step : 0) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                @endfor
                                            </select>
                                        @else
                                            <mwc-slider
                                             class="w-100 week-content-checkbox"
                                             min="0"
                                             value="{{ ($work = $character->week->where('content_id', $content->getKey())->first()) ? $work->step : 0 }}"
                                             max="{{ $content->step }}"
                                             data-character-id="{{ $character->getKey() }}"
                                             data-content-id="{{ $content->getKey() }}"
                                             step="1"
                                             {{ $character->item_level < $content->min_level ? 'disabled' : '' }}
                                             pin
                                             markers>
                                            </mwc-slider>
                                        @endmobile
                                    @endif
                                </th>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="day" role="tabpanel" aria-labelledby="day-tab">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">카던</th>
                        <th scope="col">가디언</th>
                        <th scope="col">에포나</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($characters as $character)
                        <tr>
                            <th scope="row" rowspan="2">
                                <button
                                 class="btn btn-text-primary"
                                 type="button"
                                 data-bs-toggle="tooltip"
                                 data-bs-placement="top"
                                 onclick='copy(@json($character->name))'
                                 title="{{ $character->class }} / {{ number_format($character->item_level) }}">
                                    {{ $character->name }}
                                </button>
                            </th>
                            <td class="text-center">
                                <input
                                 class="form-check-input day-content-checkbox"
                                 data-character-id="{{ $character->getKey() }}"
                                 data-content-id="카던"
                                 {{ $character->day->where('content', '카던')->count() == 1 ? 'checked' : '' }}
                                 type="checkbox">
                            </td>
                            <td class="text-center">
                                <input
                                 class="form-check-input day-content-checkbox"
                                 data-character-id="{{ $character->getKey() }}"
                                 data-content-id="가디언"
                                 {{ $character->day->where('content', '가디언')->count() == 1 ? 'checked' : '' }}
                                 type="checkbox">
                            </td>
                            <td class="text-center">
                                <input
                                 class="form-check-input day-content-checkbox"
                                 data-character-id="{{ $character->getKey() }}"
                                 data-content-id="에포나"
                                 {{ $character->day->where('content', '에포나')->count() == 1 ? 'checked' : '' }}
                                 type="checkbox">
                            </td>
                        </tr>
                        <tr class="day-work-rest" data-character-id="{{ $character->getKey() }}">
                            <td class="text-center" data-content-id="카던">
                                <input class="form-control form-control-sm" type="number" value="{{ $character->c_rest }}">
                            </td>
                            <td class="text-center" data-content-id="가디언">
                                <input class="form-control form-control-sm" type="number" value="{{ $character->g_rest }}">
                            </td>
                            <td class="text-center" data-content-id="에포나">
                                <input class="form-control form-control-sm" type="number" value="{{ $character->a_rest }}">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
            <table class="table mb-0">
                <colgroup>
                    <col width="150"/>
                    <col>
                </colgroup>
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">메모</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($characters as $character)
                        <tr>
                            <th scope="row">
                                <button
                                 class="btn btn-text-primary"
                                 type="button"
                                 data-bs-toggle="tooltip"
                                 data-bs-placement="top"
                                 onclick='copy(@json($character->name))'
                                 title="{{ $character->class }} / {{ number_format($character->item_level) }}">
                                    {{ $character->name }}
                                </button>
                            </th>
                            <td><textarea class="form-control description" data-character-id="{{ $character->getKey() }}" rows="2">{{ $character->description }}</textarea></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>
@endsection

@section('scripts')
<script type="text/javascript">
try {
    messaging.addEventListener('week-work', (data) => {
        let work = JSON.parse(data.work)
        let obj = $(`[data-character-id=${work.character}][data-content-id=${work.content}]`)
        if (obj.is('input[type=checkbox]')) {
            obj.prop('checked', work.step)
        } else {
            obj.val(work.step)
        }
    })
    messaging.addEventListener('day-work', (data) => {
        let work = JSON.parse(data.work)
        $(`.day-content-checkbox[data-character-id=${work.character}][data-content-id=${work.content}]`).prop('checked', work.on)
        setRestView(work.character, work.content, data.rest)
    })
} catch (e) {
    console.error('is not https');
}
let restUse = {
    카던: 40,
    가디언: 40,
    에포나: 60,
}
let setActive = () => {
    $.each($(`input[data-character-id][data-content-id].day-content-checkbox`), (i, item) => {
        let contentId = item.getAttribute('data-content-id')
        let characterId = item.getAttribute('data-character-id')
        let restObj = $(`.day-work-rest[data-character-id=${characterId}]>[data-content-id=${contentId}]>input`)
        let rest = restObj.val()
        let active = !item.checked && restUse[contentId] <= rest
        $(item).parents('td').toggleClass('not-active', !active)
        $(restObj).parents('td').toggleClass('not-active', !active)
    })
}
setActive()
let setRestView = (character, content, number) => {
    $(`.day-work-rest[data-character-id=${character}] [data-content-id=${content}] input`).val(number)
    setActive()
}
$('.week-content-checkbox').change((event) => {
    setWork($(event.target).data().characterId, $(event.target).data().contentId, $(event.target).val() || ($(event.target).is(':checked') ? 1 : 0))
})
$('.day-content-checkbox').change((event) => {
    setDay(
        $(event.target).data().characterId,
        $(event.target).data().contentId,
        $(event.target).is(':checked'),
        (response) => {
            setRestView($(event.target).data().characterId, $(event.target).data().contentId, response.rest)
        }
    )
})
$('.day-work-rest input').change((event) => {
    setRest(
        $(event.target).parents('.day-work-rest').data().characterId,
        $(event.target).parents('[data-content-id]').data().contentId,
        $(event.target).val()
    )
})
$('.description').change((event) => {
    $.ajax({
        url: `/api/character/${$(event.target).data().characterId}/description`,
        method: 'post',
        data: {
            content: event.target.value
        }
    })
})
</script>
@endsection
