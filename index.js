(function(){
    // Your web app's Firebase configuration
    // For Firebase JS SDK v7.20.0 and later, measurementId is optional
    //Firebaseに接続
    var firebaseConfig = {
    apiKey: "AIzaSyDHJpC0mj3Vi9h3fQKbmFg1q9uEXNfnthU",
    authDomain: "developmentauth.firebaseapp.com",
    databaseURL: "https://developmentauth.firebaseio.com",
    projectId: "developmentauth",
    storageBucket: "developmentauth.appspot.com",
    messagingSenderId: "785254904382",
    appId: "1:785254904382:web:168ced64673e38e41d576f",
    measurementId: "G-RWFY3RCM39"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    firebase.analytics();
    
    //ログイン監視
    firebase.auth().onAuthStateChanged(firbaseUser => {
        if(firbaseUser){
            //ユーザがログインしているとき
            var user = firebase.auth().currentUser;
            var uid, email;
            uid = user.uid;
            email = user.email;
            console.log(email + 'でログインしています');
            console.log('UID：' + uid);
            //htmlファイルにuserIdを入れている
            document.getElementById('userId').value = uid;
        }else{
            //ユーザがログインしていないとき
            console.log('ログインしていません');
        };
    });
}());