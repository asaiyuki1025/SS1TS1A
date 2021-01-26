<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <title>ログイン画面</title>
 　　 <meta name="viewport" content="width=device-width, inital-scale=1">
        <link rel="stylesheet" href="login.css">
        <!-- The core Firebase JS SDK is always required and must be listed first -->
        <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-app.js"></script>

        <!-- TODO: Add SDKs for Firebase products that you want to use
             https://firebase.google.com/docs/web/setup#available-libraries -->
        <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-analytics.js"></script>
        <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-auth.js"></script>
        <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-firestore.js"></script>
    </head>
    <body>
        <div class="zz">
        <h1>ログイン</h1>
            <br>
            <br>
            <p><label for="name">メールアドレス</label></p>
            <div class="a"><p><input id="txtEmail" type="email" placeholder=""></p></div>
            <br>
            <p><label for="password">パスワード</label></p>
            <div class="b"><p><input id="txtPassword" type="password" placeholder=""></p></div>
            <p id="text" class="warning"></p>
            <div class="button-area">
                <br>
                <br>
                <br>
                <p><button id="btnLogin" class="btn btn-action">
                ログイン
            </button></p>
            </div>
<!--
            <p><button id="btnLogout" class="btn btn-action hide">
                ログアウト
            </button></p>
-->
　　
       
        
        <script>
            (function(){
            // Your web app's Firebase configuration
            // For Firebase JS SDK v7.20.0 and later, measurementId is optional
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

            const txtEmail = document.getElementById('txtEmail');
            const txtPassword = document.getElementById('txtPassword');
            const btnLogin = document.getElementById('btnLogin');
            const btnLogout = document.getElementById('btnLogout');

            btnLogin.addEventListener('click', e => {
                const email = txtEmail.value;
                const pass = txtPassword.value;
                const auth = firebase.auth();
                const promise = auth.signInWithEmailAndPassword(email,pass);
                promise.catch(e => console.log(e.message));
                promise.catch(e => document.getElementById('text').textContent = e.message);
                document.getElementById('text').textContent = "ログインが完了しました。"
            });

//            btnLogout.addEventListener('click', e=>{
//               firebase.auth().signOut(); 
//            　　document.getElementById('text').textContent = "ログアウトが完了しました。"
//            });

            firebase.auth().onAuthStateChanged(firbaseUser => {
                if(firbaseUser){
                    //console.log(firbaseUser);
                    var user = firebase.auth().currentUser;
                    var uid, email;
                    uid = user.uid;
                    email = user.email;
                    console.log(email + 'でログインしています');
                    console.log('UID：' + uid);
                    //btnLogout.classList.remove('hide');
                }else{
                    console.log('ログインしていません');
		    document.getElementById('text').textContent = "ログインしていません。"
                    //btnLogout.classList.add('hide');
                };
            });
        }());
        </script>
        </div>
    </body>
</html>
