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

function RegistrationStatusSelect(gender) {
    if (gender === 'Male') {

        document.getElementById('Male').style.background = 'lightseagreen';
        document.getElementById('Female').style.background = '';
    } else if (gender === 'Female') {
        document.getElementById('Female').style.background = 'lightseagreen';
        document.getElementById('Male').style.background = '';
    }
}

function RegistrationCategory(Category) {

    if(Category === 'WorkingClass'){
        document.getElementById('WorkingClass').style.background = 'lightseagreen';
        document.getElementById('Student').style.background = '';
    }else if(Category === 'Student'){
        document.getElementById('Student').style.background = 'lightseagreen';
        document.getElementById('WorkingClass').style.background = '';
    }
}