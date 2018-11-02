export function isNameOrSurname(field) {
    let re = /[a-ząćęłńóśżź]{1,35}$/i;
    if (re.test(String(field.value).toLowerCase())) {
        field.style.borderColor = "#7dbd6e";
        return true;
    } else {
        field.style.borderColor = "#f22a2a";
        return undefined;
    }
}

export function isEmpty(field) {
    if (field.value !== '') {
        field.style.borderColor = "#7dbd6e";
        return true;
    } else {
        field.style.borderColor = "#f22a2a";
        return undefined;
    }
}

export function isAtLeast(field, min) {
    if (field.value.length > min) {
        field.style.borderColor = "#7dbd6e";
        return true;
    } else {
        field.style.borderColor = "#f22a2a";
        return undefined;
    }
}

export function isEmail(field) {
    let re = /^(([^<>()\[\]\\.,;:\s@']+(\.[^<>()\[\]\\.,;:\s@']+)*)|('.+'))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (re.test(String(field.value).toLowerCase())) {
        field.style.borderColor = "#7dbd6e";
        return true;
    } else {
        field.style.borderColor = "#f22a2a";
        return undefined;
    }
}

export function isPhoneNo(field) {
    let re = /[ 0-9\+\-]/;
    if (field.value.length >= 9 && re.test(String(field.value))) {
        field.style.borderColor = "#7dbd6e";
        return true;
    } else {
        field.style.borderColor = "#f22a2a";
        return undefined;
    }
}

export function isUser(field) {

}

export function isPass(field) {

}

export function isBirthDate(field) {

}