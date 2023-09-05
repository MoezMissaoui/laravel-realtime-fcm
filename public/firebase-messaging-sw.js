// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here. Other Firebase libraries
// are not available in the service worker.
importScripts('https://www.gstatic.com/firebasejs/7.9.1/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.9.1/firebase-messaging.js');

// Initialize the Firebase app in the service worker by passing in
// your app's Firebase config object.
// https://firebase.google.com/docs/web/setup#config-object
firebase.initializeApp({
    apiKey: "AIzaSyCxVN2gj-K4XFYrcP65V4O74HW9UcRzFSE",
    authDomain: "laravel-realtime-fcm.firebaseapp.com",
    projectId: "laravel-realtime-fcm",
    storageBucket: "laravel-realtime-fcm.appspot.com",
    messagingSenderId: "265349239131",
    appId: "1:265349239131:web:d993260ac566a31bef8a7e"
});

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();


messaging.setBackgroundMessageHandler((payload) => {
    console.log(
      '[firebase-messaging-sw.js] Received background message ',
      payload
    );
    const {notificationTitle , notificationBody} = payload.notification;
    // Customize notification here
    const notificationOptions = {
      body: notificationBody
    };
  
    self.registration.showNotification(notificationTitle, notificationOptions);
  });