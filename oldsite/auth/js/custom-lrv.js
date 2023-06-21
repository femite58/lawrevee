function LoginSwipe(Switcher) {
    if (Switcher === 'emailLogin') {
        document.getElementById('emailLogin').style.display = 'inline';
        document.getElementById('faceBookLogin').style.display = 'none';

        document.getElementById('emailLoginCheck').style.display = 'inline';
        document.getElementById('faceBookLoginCheck').style.display = 'none';
    } else {
        document.getElementById('emailLogin').style.display = 'none';
        document.getElementById('faceBookLogin').style.display = 'inline';

        document.getElementById('emailLoginCheck').style.display = 'none';
        document.getElementById('faceBookLoginCheck').style.display = 'inline';
    }
}

function MobileNumberStatus(LnMobile) {

    var MobLn = LnMobile.length;

    if (MobLn === 11 || MobLn < 1) {
        document.getElementById('mob-policy').innerHTML = '';
    }
    else if (MobLn > 1 && MobLn < 10) {
        document.getElementById('mob-policy').innerHTML = 'Invalid phone number';
    }
    else if (MobLn > 11) {
        document.getElementById('mob-policy').innerHTML = 'Phone number is above length, eg: 080X XXX XXXX';
    }
}

function PasswordVerification(LnPassword) {
    //alert('just to check');
    var PwdLn = LnPassword.length;

    if (PwdLn < 1) {
        document.getElementById('psw-policy').innerHTML = '';
    }
    else if (PwdLn > 1 && PwdLn < 6) {
        document.getElementById('psw-policy').style.color = 'red';
        document.getElementById('psw-policy').innerHTML = 'Password Policy: Length must be above 6';
    }
    else if (PwdLn >= 6) {
        document.getElementById('psw-policy').style.color = 'green';
        document.getElementById('psw-policy').innerHTML = 'Password looking good !';
    }
}

function getRegPackage(getPkgCode,getSponsor) {
    location.href = 'index.php?pkg='+getPkgCode+'&bib='+getSponsor;
}

function usrIdValidator(UsrIdVal) {

    $.ajax({
        url: 'lrv.process.php',
        method: 'POST',
        data: {
            UsrIdVal: UsrIdVal
        },
        success: function (data) {
            // document.getElementById(TabCol).click();
             //document.getElementById('usrId-policy').innerHTML = data;
            document.getElementById('usrId-policy').innerHTML = 'Not available -- ( Please choose another Username )';
        },
    });
}