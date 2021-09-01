firebase.initializeApp({
    apiKey: "AIzaSyA5CyOdFWtrOOm3XF2hDpTW4LSaRRm66xM",
    authDomain: "loaschedule.firebaseapp.com",
    projectId: "loaschedule",
    storageBucket: "loaschedule.appspot.com",
    messagingSenderId: "463637313678",
    appId: "1:463637313678:web:3b7f234713ab4e139f31df",
    measurementId: "G-6PC53SN5RY"
})

const messaging = firebase.messaging();
messaging.getToken({vapidKey: 'BFfjRFRx2IxCTwYT9l39m7eekc7q9WSxuicuTpwowydDr8V6Aaj32-fzJvkpA4DQwyBfNnZJTHZfTVEwUH3Ph00'}).then((currentToken) => {
    if (currentToken) {
        $.ajax({
            url: '/api/fcm/init',
            method: 'post',
            data: {
                token: currentToken,
                topic: 'all',
            }
        })
    }
})

messaging.onMessage((payload) => {
    console.log('Message received. ', payload);
    if ('data' in payload && 'event_type' in payload.data && messaging.event[payload.data.event_type]) {
        messaging.event[payload.data.event_type].forEach((item, i) => {
            item(payload.data)
        })
    }
})

messaging.event = {}
messaging.addEventListener = (eventType, action) => {
    if (messaging.event[eventType] === undefined) {
        messaging.event[eventType] = []
    }
    messaging.event[eventType].push(action)
}
