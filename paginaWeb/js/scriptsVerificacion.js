function validEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function correoValidoFuncion(correo) {
    if(correo) {
        return false;
    } else if(validEmail(correo)) {
        return true;      
    } else {
        return false;
    }
}

function esNumero3(n) {
    if (n==3) {
        return true;
    } else {
        return false;
    }
}