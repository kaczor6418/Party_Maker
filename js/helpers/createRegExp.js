export function createRegExp(expression) {

    if (Array.isArray(expression)) {
        return new RegExp(`${expression.join('|')}`, 'ig');
    } else {
        return new RegExp(`(${expression})`, 'ig');
    }

}