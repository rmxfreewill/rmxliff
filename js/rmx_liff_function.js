
function rmxCloseWindow() {
    if (liff.getOS() != "web") {
        liff.closeWindow();
    } else {

        // var elementRegisterForm = document.getElementById('registerForm');
        // var elementSuccessMsg = document.getElementById('successMsg');

        // elementRegisterForm.style.display = "none";
        // elementSuccessMsg.removeAttribute("hidden");



    }
}

function getProfileLiffUserId() {
    liff.getProfile()
        .then(profile => {
            var userIdProfile = profile.userId;
            // var sFunction = document.getElementById('txtFunction').value;
            var sMenu = document.getElementById('txtMenu').value;
            var url = rmxSelectMenu(sMenu, userIdProfile);
            window.location.assign(url);
        })
        .catch((err) => {
            console.log('getProfile: ', err);
        });
}

function rmxSelectMenu(toMenu, userId) {
    var folder = 'screen/';
    var routes = '?LinkCode=CHECK&route=MENU';
    var URL = document.getElementById('txtsURL').value;
    var sCompCode = document.getElementById('txtCompanyCode').value;
    var sCmd = "call sp_main_check_register ('" + userId + "','" + sCompCode + "')";
    var para = routes + "&LineId=" + userId + "&CmdCommand=" + sCmd;
    switch (toMenu) {
        //
        case "registerScreen":
            url = URL + folder + "registerScreen.php" + para;
            break;
        //
        case "register":
            url = URL + "frmRegister.php" + para;
            break;
        case "ticket":
            url = URL + "frmTicket.php" + para;
            break;
        case "search":
            url = URL + "frmSearch.php" + para;
            break;
        case "profile":
            url = URL + folder + "registerScreen.php" + para;
            break;
        // default:
        //     url = URL + "frmLogout.php" + para;
        //     break;
    }

    return url;
}

async function rmxInitializeLiff(myLiffId, type) {
    await liff.init({
        liffId: myLiffId
    })
        .then(() => {
            type == 'logout' && liff.isLoggedIn() ? liff.closeWindow() : alert('Logout');
            type == 'close' && liff.isLoggedIn() ? liff.closeWindow() : alert('Register Success');
        })
        .catch((err) => {
            console.log("initializeLiff: " + err);
        });
}

async function rmxInitializeLineLiff(myLiffId) {
    console.log('initializeLiff: ', myLiffId);
    await liff.init({
        liffId: myLiffId
    })
        .then(() => {
            if (liff.isLoggedIn()) {
                liff.getProfile().then(profile => {
                    const userName = profile.displayName;
                    const userId = profile.userId;
                })
                    .catch((err) => {
                        console.log('error ', err);
                    });
            }
        })
        .catch((err) => {
            console.log('initializeLiff: ', err);
        });
}
