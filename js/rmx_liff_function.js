function getProfileLiffUserId(type) {
    liff.getProfile()
        .then(profile => {
            // var sFunction = document.getElementById('txtFunction').value;
            var sFunction = type;
            if (sFunction == 'index') {
                var userIdProfile = profile.userId;
                var url = selectMenu(sFunction, userIdProfile);
                window.location.assign(url);
            }
        })
        .catch((err) => {
            console.log('getProfile: ', err);
        });
}

async function initializeLiff(myLiffId,type) {
    await liff.init({
            liffId: myLiffId
        })
        .then(() => {
            if(type=='LOGOUT'){
                liff.isLoggedIn() ? liff.closeWindow() : alert('Thx');
            }else if(type=='index'){
                liff.isLoggedIn() ? getProfileLiffUserId(type) : liff.login();
            }
        })
        .catch((err) => {
            console.log("initializeLiff: " + err);
        });
}
