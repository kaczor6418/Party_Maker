export function displayErrors(errors) {
    let ul = document.querySelector('.errors'), // it is to print server error (login/register successful or unsuccessful)
        parent = document.querySelector('.status'); // we have to decide where we want to print errors so now it is abstract(.status doesn't exist)
    if (!ul) {
        ul = document.createElement('ul');
        ul.classList.add('errors');
    }
    if (ul.hasChildNodes()) {
        while (ul.firstChild) {
            ul.removeChild(ul.firstChild);
        }
    }
    if (errors) {
        errors.forEach(function (error) {
            let li = document.createElement('li');
            li.textContent = error;
            ul.appendChild(li);
        });
        parent.appendChild(ul);
    }
}