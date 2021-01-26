<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <title>新規登録</title>
        <meta name="viewport" content="width=device-width, inital-scale=1">
        <link rel="stylesheet" href="account.css">
        <!-- The core Firebase JS SDK is always required and must be listed first -->
        <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-app.js"></script>

        <!-- TODO: Add SDKs for Firebase products that you want to use
             https://firebase.google.com/docs/web/setup#available-libraries -->
        <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-analytics.js"></script>
        <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-auth.js"></script>
        <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-firestore.js"></script>
    </head>
    <style>
        @media screen and (max-width: 480px) {
input[id="submit"]{
     width: auto;
    /* 文字サイズを1.4emに指定 */
    font-size: 30px;

    /* 文字の太さをboldに指定 */
    font-weight: bold;

    /* 縦方向に10px、
     * 横方向に30pxの余白を指定 */
    padding: 8px 9px;

    /* 背景色を濃い青色に指定 */
    background-color: #248;

    /* 文字色を白色に指定 */
    color: #fff;

    /* ボーダーをなくす */
    border-style: none;
    
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius: 5px;
    
    text-align: center;
    
}
        }
    </style>
    <body>
        <div class="zz">
            <h1>新規登録</h1>
            <br>
            <br>
            <p><label for="name">メールアドレス</label></p>
            <div class="a"><p><input id="txtEmail" type="email" placeholder=""></p></div>
            <br>
            <p><label for="password">パスワード</label></p>
            <div class="b"><p><input id="txtPassword" type="password" placeholder="※6文字以上"></p></div>
            <p id="text" class="warning"></p>
            <br>
            <br>
            <br>
            <div class="button-area">
                <p><button id="btnSignUp" class="btn btn-secondary">
                新規登録
                    </button></p>
            
            <br>
            <form action="userinfo.php" method="post">
                <p><input type="submit" value="ユーザー情報登録へ" id="submit"></p>
            </form>
                </div>
	
	    
        
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
            const sendMail = document.getElementById('sendMail');

            //ログインボタンを押したときの処理
            btnSignUp.addEventListener('click', e => {
                const email = txtEmail.value;
                const pass = txtPassword.value;
                const auth = firebase.auth();
                //アカウントの新規登録
                const promise = auth.createUserWithEmailAndPassword(email,pass);
                
                var user = firebase.auth().currentUser;  
                user.sendEmailVerification().then(function() {
                      // Email sent.
                        console.log('確認メールを送信しました');
                        document.getElementById('text').textContent = "メールアドレスが登録されました。確認メールが送信されました。";
                    }).catch(function(error) {
                      // An error happened.
                        console.log('確認メールが送信されませんでした');
                    });
		promise.catch(e => console.log(e.message));
                promise.catch(e => document.getElementById('text').textContent = e.message);
            });

            firebase.auth().onAuthStateChanged(firbaseUser => {
                if(firbaseUser){
                    var user = firebase.auth().currentUser;
                    var uid, email;
                    uid = user.uid;
                    email = user.email;
                    console.log(email + 'でログインしています');
                    console.log('UID：' + uid);
                }else{
                    console.log('ログインしていません');
                };
            });
        }());
        </script>
        </div>
    </body>
</html>
