function rmxSelectMenu(toMenu, userId) {
    var URL = document.getElementById('txtsURL').value;
    var sCompCode = document.getElementById('txtCompanyCode').value;
    var sCmd = "call sp_main_check_register ('" + userId + "','" + sCompCode + "')";
    var para = "?LinkCode=CHECK&LineId=" + userId + "&CmdCommand=" + sCmd;
    switch (toMenu) {
        case "register":
            url = URL + "menu_register.php" + para;
            break;
        case "REGISTER":
            url = URL + "frmRegister.php" + para;
            break;
        case "QUERY":
            url = URL + "frmQuery.php" + para;
            break;
        case "VIEW":
            url = URL + "frmView.php" + para;
            break;
        case "TICKET":
            url = URL + "frmTicket.php" + para;
            break;
        case "LOGOUT":
            url = URL + "frmLogout.php" + para;
            break;
        default:
            url = 'closeWindow.php';
            break;
    }

    return url;
}

function rmxGetProfileLiffUserId() {
    liff.getProfile()
        .then(profile => {
            // var sFunction = document.getElementById('txtFunction').value;
            // var sFunction = type;
            // if (sFunction != '') {
            var userIdProfile = profile.userId;
            var url = selectMenu(sFunction, userIdProfile);
            window.location.assign(url);
            // }
        })
        .catch((err) => {
            console.log('getProfile: ', err);
        });
}

async function rmxInitializeLiff(myLiffId, type) {
    await liff.init({
        liffId: myLiffId
    })
        .then(() => {
            type == 'logout' && liff.isLoggedIn() ? liff.closeWindow() : alert('Thx');
        })
        .catch((err) => {
            console.log("initializeLiff: " + err);
        });
}
