async function initializeLiff(myLiffId,type) {
    await liff.init({
            liffId: myLiffId
        })
        .then(() => {
            if(type=='LOGOUT'){
                liff.isLoggedIn() ? liff.closeWindow() : alert('Thx');
            }else if(type=='REGISTER'){
                liff.isLoggedIn() ? getProfileLiffUserId() : liff.login();
            }
        })
        .catch((err) => {
            console.log("initializeLiff: " + err);
        });
}
