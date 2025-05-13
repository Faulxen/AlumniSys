document.getElementById('AnnBoxCon').style.display = 'block';
 document.getElementById('EventsBoxCon').style.display = 'none';
document.getElementById('FeedBoxCon').style.display = 'none';

document.getElementById('AnnSwitch').addEventListener('click', function (e) {
    document.getElementById('AnnBoxCon').style.display = 'block';
    document.getElementById('EventsBoxCon').style.display = 'none';
    document.getElementById('FeedBoxCon').style.display = 'none';
})

document.getElementById('EventSwitch').addEventListener('click', function (e) {
    document.getElementById('AnnBoxCon').style.display = 'none';
    document.getElementById('EventsBoxCon').style.display = 'block';
    document.getElementById('FeedBoxCon').style.display = 'none';
})

document.getElementById('FeedSwitch').addEventListener('click', function (e) {
    document.getElementById('AnnBoxCon').style.display = 'none';
    document.getElementById('EventsBoxCon').style.display = 'none';
    document.getElementById('FeedBoxCon').style.display = 'block';
})


document.getElementById('moreIMG').addEventListener('click', function (e) {
    const infoBar = document.getElementById('InfoBar');
    if (infoBar.style.display === 'none' || infoBar.style.display === '') {
        infoBar.style.display = 'block';
    } else {
        infoBar.style.display = 'none';
    }
});

document.getElementById('notifButton').addEventListener('click', function (e) {
    const NotifBar = document.getElementById('NotifBar');
    if (NotifBar.style.display === 'none' || NotifBar.style.display === '') {
        NotifBar.style.display = 'block';
    } else {
        NotifBar.style.display = 'none';
    }
});

document.getElementById('logoutButton').addEventListener('click', function (e) {
    const LogoutPopup = document.getElementById('LogoutPopup');
    if (LogoutPopup.style.display === 'none' || LogoutPopup.style.display === '') {
        LogoutPopup.style.display = 'block';
    } else {
        LogoutPopup.style.display = 'none';
    }
});

document.getElementById('yesLogout').addEventListener('click', function (e) {
    window.location.href = '../../includes/logout.php';
});

document.getElementById('SettingButton').addEventListener('click', function (e) {
    document.getElementById('SettingPopup').style.display = 'none';
});

document.getElementById('settingsButton').addEventListener('click', function (e) {
    const SettingPopup = document.getElementById('SettingPopup');
    if (SettingPopup.style.display === 'none' || SettingPopup.style.display === '') {
        SettingPopup.style.display = 'block';
    } else {
        SettingPopup.style.display = 'none';
    }
});

document.getElementById('noLogout').addEventListener('click', function (e) {
    document.getElementById('LogoutPopup').style.display = 'none';
    document.getElementById('InfoBar').style.display = 'none';
});