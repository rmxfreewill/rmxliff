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

function rmxGetParams() {
    var toStatus = null;
    var url = new URL(document.URL);
    var toMenu = url.searchParams.get("menu");
    toStatus = url.searchParams.get("status");
    const param = {menu:toMenu,status:toStatus};
    return param;
}

function rmxSelectMenu(toMenu = String, userId = String,sCompCode = String) {
    //paramCmdCommand
    // var sCompCode = document.getElementById('txtCompanyCode').value;
    var sCmd = '';
    sCmd = toMenu=='register' ?? "call sp_main_check_register ('" + userId + "','" + sCompCode + "')";
    var paramCmdCommand = "&CmdCommand=" + sCmd;

    //paramUserId
    var paramUserId = "&LineId=" + userId;

    //paramRoutes
    var RoutesStatus = "status=init";
    var paramRoutes = RoutesStatus + '&route=' + toMenu;

    var param = "?" + paramRoutes + paramUserId + paramCmdCommand;
    var url = document.getElementById('txtsURL').value + "index.php";
    var selectMenu = url + param;

    alert(selectMenu);

    return selectMenu;
}



// async function initializeLiff() {
//     var myLiffId = document.getElementById('txtLiffId').value;
//     await liff.init({
//             liffId: myLiffId
//         })
//         .then(() => {
//             liff.isLoggedIn() ? getProfileLiffUserId() : liff.login();
//         })
//         .catch((err) => {
//             console.log("initializeLiff: " + err);
//         });
// }



// async function rmxInitializeLiff(myLiffId, type) {
//     await liff.init({
//         liffId: myLiffId
//     })
//         .then(() => {
//             type == 'logout' && liff.isLoggedIn() ? liff.closeWindow() : alert('Logout');
//             type == 'close' && liff.isLoggedIn() ? liff.closeWindow() : alert('Register Success');
//         })
//         .catch((err) => {
//             console.log("initializeLiff: " + err);
//         });
// }

    // switch (toMenu) {
    //     case "register":
    //         // url = URL + "frmRegister.php" + para;
    //         url = URL + folder + "registerScreen.php" + para; 
    //         break;
    //     case "ticket":
    //         url = URL + "frmTicket.php" + para;
    //         break;
    //     case "search":
    //         url = URL + "frmSearch.php" + para;
    //         break;
    //     case "profile":
    //         url = URL + "frmProfile.php" + para;
    //         break;
    //     default:
    //         url = URL + folder + "registerScreen.php" + para;
    //         break;
    // } 