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
    
    const sellerUserId = document.getElementById('sellerUserId').value;
    const userId = document.getElementById('userId').value;
    const roomNum = sellerUserId + userId;
     
    //Get a reference to the database service
    //var database = firebase.database();
    
    //---------------------------------------
    // チャット初期処理
    //---------------------------------------
    // ユーザー名をランダムに決める
    var uname = document.getElementById("userName").innerHTML;
    //document.getElementById("uname").innerHTML = uname;

    // テキストボックスにfocus
    // document.getElementById("msg").focus();

    //---------------------------------------
    // Firestoreの準備
    //---------------------------------------
    // Firestoreのインスタンス作成
    var db = firebase.firestore();

    // チャットルームのリファレンス取得
    var messagesRef = db.collection("chatroom").doc(roomNum).collection("messages");
    
    //同期処理
    messagesRef.orderBy("date", "asc").limit(100).onSnapshot( (snapshot) => {
        snapshot.docChanges().forEach((change) => {
            // 追加
            if ( change.type === 'added' ) {
              addLog(change.doc.id, change.doc.data());
            }
            // 更新
            else if( change.type === 'modified' ){
              modLog(change.doc.id, change.doc.data());
            }
            // 削除
            else if ( change.type === 'removed' ) {
              removeLog(change.doc.id);
            }
        });
    });

    //送信ボタン押下
    document.getElementById("sbmt").addEventListener("click", ()=>{
        let msg = document.getElementById("msg").value;
            if( msg.length === 0 ){
                return(false);
            }
        // メッセージをfirestoreへ送信
        messagesRef.add({
            name: uname,
            msg: msg,
            date: new Date().getTime()
        })
        .then(()=>{
        let msg = document.getElementById("msg");
        msg.focus();
        msg.value = "";
        })
    });
    // submitイベントは（いったん）無視する
    document.getElementById("form1").addEventListener("submit", (e)=>{
        e.preventDefault();
    });
    
    //ログに追加
    function addLog(id, data){
        // 追加するHTMLを作成
        let log = `${data.name}: ${data.msg} (${getStrTime(data.date)})`;
        let li  = document.createElement('li');
        li.id   = id;
        li.appendChild(document.createTextNode(log));

        // 表示エリアへ追加
        let chatlog = document.getElementById("chatlog");
        chatlog.insertBefore(li, chatlog.firstChild);
    }

    //ログを更新
    function modLog(id, data){
        let log = document.getElementById(id);
        if( log !== null ){
            log.innerText = `${data.name}: ${data.msg} (${getStrTime(data.date)})`;
        }
    }

    //ログを削除
    function removeLog(id){
        let log = document.getElementById(id);
        if( log !== null ){
            log.parentNode.removeChild(log);
        }
    }

    //ユーザー名をランダムに決定
//    function getUName(){
//        let master = ["キティ", "マイメロ", "プリン", "ぐでたま", "烈子", "シナモン", "たあ坊", "キキ", "ララ"];
//        let i      = Math.floor( Math.random() * master.length );
//        return( master[i] );
//    }

    //UNIX TIME => MM-DD hh:mm
    function getStrTime(time){
        let t = new Date(time);
        return(
            ("0" + (t.getMonth() + 1)).slice(-2) + "-" +
            ("0" + t.getDate()       ).slice(-2) + " " +
            ("0" + t.getHours()      ).slice(-2) + ":" +
            ("0" + t.getMinutes()    ).slice(-2)
        );
    }
    
    firebase.auth().onAuthStateChanged(firbaseUser => {
        if(firbaseUser){
            //console.log(firbaseUser);
            var user = firebase.auth().currentUser;
            var uid, email;
            uid = user.uid;
            email = user.email;
            console.log(email + 'でログインしています');
            console.log('UID：' + uid);
            //document.getElementById('userId').value = uid;
            //btnLogout.classList.remove('hide');
        }else{
            console.log('ログインしていません');
            //btnLogout.classList.add('hide');
        };
    });
}());