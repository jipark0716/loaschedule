if (sslUse && location.protocol == 'http:') {
    location.href = 'https://'+location.host+location.pathname
} else if (!sslUse && location.protocol == 'https:') {
    location.href = 'http://'+location.host+location.pathname
}

function openNewTab(url) {
    var win = window.open(url, '_blank');
    win.focus();
}

let setWork = (characterId, contentId, step) => {
    $.ajax({
        url: '/api/content/week',
        method: 'post',
        contentType: 'application/json',
        data: JSON.stringify({
            character: characterId,
            content: contentId,
            step: step,
        }),
    })
}

let setDay = (characterId, contentId, on, callback = null) => {
    $.ajax({
        url: '/api/content/day',
        method: 'post',
        contentType: 'application/json',
        data: JSON.stringify({
            character: characterId,
            content: contentId,
            on: on,
        }),
        success: (response) => {
            if (callback != null) {
                callback(response)
            }
        }
    })
}

let setRest = (characterId, contentId, val) => {
    $.ajax({
        url: '/api/content/rest',
        method: 'post',
        contentType: 'application/json',
        data: JSON.stringify({
            character: characterId,
            content: contentId,
            val: val,
        }),
    })
}

let copy = (val) => {
    const t = document.createElement("textarea")
    document.body.appendChild(t)
    t.value = val
    t.select()
    document.execCommand('copy')
    document.body.removeChild(t)
}

$('.character-button').click((event) => {
    let name = $(event.target).attr('data-nick-name')
    if (window.event.ctrlKey) {
        openNewTab(`https://lostark.game.onstove.com/Profile/Character/${name}`)
    } else {
        copy(name)
    }
})
