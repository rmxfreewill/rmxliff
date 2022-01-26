async function initializeLiff(myLiffId,type) {

    function typeMenu(type){
        if(type=='LOGOUT'){
            liff.isLoggedIn() ? liff.closeWindow() : alert('Thx');
        }else if(type=='REGISTER'){
            liff.isLoggedIn() ? getProfileLiffUserId() : liff.login();
        }
    }
    
    await liff.init({
            liffId: myLiffId
        })
        .then(() => {
            typeMenu(type);
        })
        .catch((err) => {
            console.log("initializeLiff: " + err);
        });
}
