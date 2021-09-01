importScripts('https://www.gstatic.com/firebasejs/8.9.1/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.9.1/firebase-messaging.js');

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

messaging.onBackgroundMessage((payload) => {
    console.log('[firebase-messaging-sw.js] Received background message ', payload);
});
