async function initializeLiff(myLiffId) {
    
    await liff.init({
            liffId: myLiffId
        })
        .then(() => {
            liff.isLoggedIn() ? liff.closeWindow() : alert('Thx');
        })
        .catch((err) => {
            console.log("initializeLiff: " + err);
        });
}