function GetOneTask(e){
    console.log(e.id);

    fetch('http://localhost/todo/backend/todo/list.php', {
        method: 'POST',
        headers: {
        'Content-Type': 'application/json',
        'authorization': `${localStorage.getItem('token')}`,
        },
        body: JSON.stringify({ "id": e.id })
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
            console.log('->'+response.id+'<-');
            console.log('->'+response.fk_user+'<-');
            console.log('->'+response.title+'<-');
            console.log('->'+response.description+'<-');
            console.log('->'+response.deadline+'<-');
            console.log('->'+response.status+'<-');

            document.getElementById('id').value = response.id;
            document.getElementById('id_user').value = response.fkuser;
            if(response.title)
            document.getElementById('title').value = response.title;
            if(response.description)
            document.getElementById('description').value = response.description;
            if(response.deadline)
            document.getElementById('deadline').value = response.deadline;
            document.getElementById('check').checked = response.status;
        }
    })
}

function DeleteOne(e) {
    console.log(e.id);
    
    fetch('http://localhost/todo/backend/todo/delete.php', {
        method: 'POST',
        headers: {
        'Content-Type': 'application/json',
        'authorization': `${localStorage.getItem('token')}`,
        },
        body: JSON.stringify({ "id": e.id })
    })
    .then(response => { 
        status = response.status;
        //return response.json();
    })
    .then(response => {
        console.log(response);
        if(status != 200){
            alert(response.message);
        }
        else{
            window.location.replace('todo.html');
        }
    })
}
const thead = document.getElementById('thead');
const tbody = document.getElementById('tbody');
/*const posts = document.getElementById('posts');*/

fetch("http://localhost/todo/backend/todo/list.php", {
    method: 'POST',
    headers: {
        'authorization': `${localStorage.getItem('token')}`,
    }
})
.then(response => {
    status = response.status;
    return response.json();
})
.then(response => {
    if(status != 200){
        alert(response.message);
    }
    else{
        const tr = document.createElement('tr');

        const th1 = document.createElement('th');
        th1.setAttribute('scope' , 'col');
        th1.innerHTML = '#'

        const th2 = document.createElement('th');
        th2.setAttribute('scope' , 'col');
        th2.innerHTML = 'Title'

        const th3 = document.createElement('th');
        th3.setAttribute('scope' , 'col');
        th3.innerHTML = 'Description'

        const th4 = document.createElement('th');
        th4.setAttribute('scope' , 'col');
        th4.innerHTML = 'Deadline'

        const th5 = document.createElement('th');
        th5.setAttribute('scope' , 'col');
        th5.innerHTML = 'More'

        const th6 = document.createElement('th');
        th6.setAttribute('scope' , 'col');
        th6.innerHTML = 'Delete'

        tr.appendChild(th1);
        tr.appendChild(th2);
        tr.appendChild(th3);
        tr.appendChild(th4);
        tr.appendChild(th5);
        tr.appendChild(th6);
        thead.appendChild(tr);

        response.forEach(e => {
            const tr = document.createElement('tr');
            //tr.className = 'd-flex mt-2';
            tr.id = 'todo' + e.id;

            const td = document.createElement('td');
            //td.className = 'd-flex flex-row justify-content-between card p-4';
            td.style = 'width: 18rem;'
            
            const td1 = document.createElement('td');
            const input = document.createElement('input');
            input.className = "form-check-input";
            input.type = 'checkbox';
            input.checked = e.status;
            input.disabled = true;

            const td2 = document.createElement('td');
            const title = document.createElement('h5');
            title.innerHTML = e.title;

            const td3 = document.createElement('td');
            const description = document.createElement('p');
            description.innerHTML = e.description;

            const td4 = document.createElement('td');
            const deadline = document.createElement('p');
            deadline.innerHTML = e.deadline;
            
            const td5 = document.createElement('td');
            const button = document.createElement('button');
            button.innerHTML = 'Ver Detalhes';
            button.id = e.id;
            button.type = 'button';
            button.className = 'btn btn-sm btn-primary';
            button.setAttribute('data-bs-toggle' , 'modal');
            button.setAttribute('data-bs-target' , '#modalCadastro');
            button.setAttribute("onclick","GetOneTask(this);")

            const td6 = document.createElement('td');
            const btn_delete = document.createElement('button');
            btn_delete.innerHTML = 'Excluir';
            btn_delete.id = e.id;
            btn_delete.type = 'button';
            btn_delete.className = 'btn btn-sm btn-danger';
            btn_delete.setAttribute("onclick","DeleteOne(this);")

            td1.appendChild(input);
            td2.appendChild(title);
            td3.appendChild(description);
            td4.appendChild(deadline);
            td5.appendChild(button);
            td6.appendChild(btn_delete);

            tr.appendChild(td1);
            tr.appendChild(td2);
            tr.appendChild(td3);
            tr.appendChild(td4);
            tr.appendChild(td5);
            tr.appendChild(td6);
            tbody.appendChild(tr);
        })
    }
})

function CreateTask(){
    const idIput = document.getElementById('id');
    const idUserIput = document.getElementById('id_user');
    const titleInput = document.getElementById('title');
    const descriptionInput = document.getElementById('description');
    const deadlineInput = document.getElementById('deadline');
    const checkInput = document.getElementById('check');
    
    const id = idIput.value;
    const idUser = idUserIput.value;
    const title = titleInput.value;
    const description = descriptionInput.value;
    const deadline = deadlineInput.value;
    const check = checkInput.checked;
    
    if(!id) {
        fetch('http://localhost/todo/backend/todo/create.php', {
            method: 'POST',
            headers: {
            'Content-Type': 'application/json',
            'authorization': `${localStorage.getItem('token')}`,
            },
            body: JSON.stringify({ "title": title, "description":  description, "deadline": deadline,   "status": check})
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
                window.location.replace('todo.html');
            }
        })
    } else {
        fetch('http://localhost/todo/backend/todo/update.php', {
            method: 'POST',
            headers: {
            'Content-Type': 'application/json',
            'authorization': `${localStorage.getItem('token')}`,
            },
            body: JSON.stringify({ "id": id, "title": title, "description": description, "deadline": deadline, "status": check})
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
                window.location.replace('todo.html');
            }
        })

    }
}