export function sendMessage(inputFields, form) {

    const xhr = new XMLHttpRequest(),
          data = new FormData(),
          method = form.getAttribute('method'),
          action = form.getAttribute('action');
    inputFields.forEach(field => {
        data.append(field.name, field.value);
    });
    xhr.open(method, action, true);
    xhr.onreadystatechange = function() {
        if(this.readyState === 4 && this.status >= 200 && this.status < 400) {
            console.log(this.response);
        }
    };
    xhr.send(data);

}