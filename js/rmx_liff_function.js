function hi() {
    alert('Hi');
}

function rmxCloseWindow() {
    liff.closeWindow();
    // if (liff.getOS() != "web") {
    //     liff.closeWindow();
    // } else {

    //     var elementRegisterForm = document.getElementById('registerForm');
    //     var elementSuccessMsg = document.getElementById('successMsg');

    //     elementRegisterForm.style.display = "none";
    //     elementSuccessMsg.removeAttribute("hidden");



    // }
}

function rmxSelectMenu(toMenu, userId) {
    var URL = document.getElementById('txtsURL').value;
    var sCompCode = document.getElementById('txtCompanyCode').value;
    var sCmd = "call sp_main_check_register ('" + userId + "','" + sCompCode + "')";
    var para = "?LinkCode=CHECK&LineId=" + userId + "&CmdCommand=" + sCmd;
    alert(para);
    switch (toMenu) {
        case "register":
            url = URL + "menu_register.php" + para;
            break;
        case "search":
            url = URL + "frmLogout.php" + para;
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
