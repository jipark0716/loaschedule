@extends('layout')

@section('title', '도서관')

@section('content')
<main>
    <div class="container-xl px-5">
        <div class="d-flex mt-10 mb-4 align-items-center">
            <h1 class="page-header mb-0">도서관</h1>
        </div>
    </div>
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#week" type="upgrade" role="tab" aria-controls="upgrade" aria-selected="false">장인의기운</button>
        </li>
    </ul>
    <div class="tab-content border border-top-0 p-3 bg-white scrollbar-primary" style="height:calc(100vh - 300px); overflow-y: auto;">
        <mwc-textfield label="성공률" value="0.5" onchange="setUpgradeChart(this.value)" outlined></mwc-textfield>
        <div id="upgrade-chart"></div>
    </div>
</main>
@endsection

@section('scripts')
<script type="text/javascript">
let upgradeChart = null;
let setUpgradeChart = (successR) => {
    successR *= 1
    let successRoriginal = successR
    let upgradeR = 0
    let playerR = 100
    let successA = []
    let playerA = []
    let sys = true
    do {
        playerR = playerR - (playerR * successR / 100)
        playerA.push(Math.round((100 - playerR) * 1000) / 1000)
        successA.push(upgradeR > 100 ? 100 : Math.round(upgradeR * 1000) / 1000)
        upgradeR += successR * 0.465
        if (successR < (successRoriginal * 2)) {
            successR += successRoriginal / 10
        }
    } while (upgradeR < 100)
    
    playerR = playerR - (playerR * successR / 100)
    playerA.push(Math.round((100 - playerR) * 1000) / 1000)
    successA.push(upgradeR > 100 ? 100 : Math.round(upgradeR * 1000) / 1000)
    upgradeR += successR * 0.465

    if (successR < (successRoriginal * 2)) {
        successR += successRoriginal / 10
    }
    if (upgradeChart == null) {
        upgradeChart = bb.generate({
            data: {
                columns: [
                    ["장인의기운", 0, ...successA],
                    ["누적성공률", 0, ...playerA]
                ],
                type: "line",
            },
            bindto: "#upgrade-chart",
        });
    } else {
        upgradeChart.load({
            columns: [
                ["장인의기운", 0, ...successA],
                ["누적성공률", 0, ...playerA]
            ],
        })
    }
}
setUpgradeChart(0.5)
</script>
@endsection
