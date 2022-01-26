async function initializeLiff(myLiffId,type) {
    await liff.init({
            liffId: myLiffId
        })
        .then(() => {
            alert(type);
            if(type=='LOGOUT'){
                liff.isLoggedIn() ? liff.closeWindow() : alert('Thx');
            }else if(type==''){
                liff.isLoggedIn() ? getProfileLiffUserId() : liff.login();
            }
        })
        .catch((err) => {
            console.log("initializeLiff: " + err);
        });
}
