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
    var url = new URL(document.URL);
    var toMenu = url.searchParams.get("route");
    const param = {route:toMenu};
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

    return selectMenu;
}

function getProfileLiffUserId() {
    liff.getProfile()
        .then(profile => {
            var userIdProfile = profile.userId;
            // var sFunction = document.getElementById('txtFunction').value;
            // var sMenu = document.getElementById('txtMenu').value;
            var url = rmxSelectMenu(sMenu, userIdProfile,sCompCode);
            alert(url);
            window.location.assign(url);
        })
        .catch((err) => {
            console.log('getProfile: ', err);
        });
}

async function rmxInitializeLineLiff(myLiffId = String,sCompCode = String) {
    console.log('initializeLiff: ', myLiffId);
    await liff.init({
        liffId: myLiffId
    })
        .then(() => {
            if (liff.isLoggedIn()) {
                liff.getProfile().then(profile => {
                    if(liff.isLoggedIn()){
                        getProfileLiffUserId(sCompCode);
                    }else{
                        liff.login();
                    }
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