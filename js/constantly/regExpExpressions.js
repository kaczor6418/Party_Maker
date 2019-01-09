export const regExpExpressions = {

    firstName: '^[A-Za-z]{1,32}$',
    lastName: '^[A-Za-z]{1,32}$',
    login: '^((([^<>()\\[\\]\\\\.,;:\\s@\']+(\\.[^<>()\\[\\]\\\\.,;:\\s@\']+)*)|(\'.+\'))@((\\[[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}\\])|(([a-zA-Z\\-0-9]+\\.)+[a-zA-Z]{2,}))|([A-Za-z]([A-Za-z0-9]){2,31}))$',
    username: '^[A-Za-z]([A-Za-z0-9]){2,31}$',
    password: '^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)(?=.*[@$!%*?&#^_])[A-Za-z\\d@$!%*?&#^_]{8,}$',
    username2: '^[A-Za-z]([A-Za-z0-9]){2,31}$',
    password2: '^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)(?=.*[@$!%*?&#^_])[A-Za-z\\d@$!%*?&#^_]{8,}$',
    email: '^(([^<>()\\[\\]\\\\.,;:\\s@\']+(\\.[^<>()\\[\\]\\\\.,;:\\s@\']+)*)|(\'.+\'))@((\\[[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}\\])|(([a-zA-Z\\-0-9]+\\.)+[a-zA-Z]{2,}))$',
    date: '^[0-3][0-9]\\/[0-1][0-9]\\/[1-2][0-9][0-9][0-9]$', // if date format will looks like dd/mm/yyyy
    search: '^([a-zA-z])([a-z A-z0-9])+([a-zA-z0-9])$',
    category: '^(?![cC]ategory).+',
    sort: '^(?![sS]ort by).+',
    localization: '',
    age: ''
};
