function Login() {
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const email = emailInput.value;
    const password = passwordInput.value;
    console.log(password , email);
    let status;

    fetch('http://localhost/todo/backend/user/login.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ "email":  email, "password":password })
    })
    .then(response => { 
        status = response.status;
        return response.json();
    })
    .then(response => {
        console.log(response);
        if(status != 200){
            alert(response.message);
        }
        else{
            localStorage.setItem('token', response.token);
            console.log('Token Index ='+localStorage.getItem('token'));
            window.location.replace('todo.html');
        }
    })
}

function CreateUser() {
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email2');
    const passwordInput = document.getElementById('password2');
    const name = nameInput.value;
    const email = emailInput.value;
    const password = passwordInput.value;
    
    fetch('http://localhost/todo/backend/user/create.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ "name": name, "email": email, "password": password })
    })
    .then(response => { 
        status = response.status;
        return response.json();
    })
    .then(response => {
        console.log(response);
        if(status != 200){
            alert(response.message);
        }
        else{
            alert('Usuário criado com sucesso!');
        }
    })
}