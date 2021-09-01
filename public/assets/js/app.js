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
