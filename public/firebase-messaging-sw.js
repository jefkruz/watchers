importScripts('https://www.gstatic.com/firebasejs/7.14.6/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.14.6/firebase-messaging.js');

  const firebaseConfig = {
        apiKey: "AIzaSyCfI0RjtLBUiBH5_5z_uYBzIIOmnNDsW28",
        authDomain: "ylwsin.firebaseapp.com",
        projectId: "ylwsin",
        storageBucket: "ylwsin.appspot.com",
        messagingSenderId: "910184955626",
        appId: "1:910184955626:web:a10a3fde7ff25ff98ca193",
        measurementId: "G-WB5DJKF9JY"
    };

firebase.initializeApp(firebaseConfig);
const messaging=firebase.messaging();

messaging.setBackgroundMessageHandler(function (payload) {
    console.log(payload);
    const notification=JSON.parse(payload);
    const notificationOption={
        body:notification.body,
        icon:notification.icon
    };
    return self.registration.showNotification(payload.notification.title,notificationOption);
});
