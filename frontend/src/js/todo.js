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
const table = document.getElementById('table');
const posts = document.getElementById('posts');

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
        response.forEach(e => {
            const tr = document.createElement('tr');
            tr.className = 'd-flex mt-2';
            tr.id = 'todo' + e.id;

            const td = document.createElement('td');
            td.className = 'd-flex flex-row justify-content-between card p-4';
            td.style = 'width: 18rem;'
            
            const input = document.createElement('input');
            input.className = "form-check-input";
            input.type = 'checkbox';
            input.checked = e.status;
            input.disabled = true;

            const title = document.createElement('h3');
            title.innerHTML = e.title;

            const description = document.createElement('p');
            description.innerHTML = e.description;
            
            const button = document.createElement('button');
            button.innerHTML = 'Ver Detalhes';
            button.id = e.id;
            button.type = 'button';
            button.className = 'btn btn-primary';
            button.setAttribute('data-bs-toggle' , 'modal');
            button.setAttribute('data-bs-target' , '#modalCadastro');
            button.setAttribute("onclick","GetOneTask(this);")

            const btn_delete = document.createElement('button');
            btn_delete.innerHTML = 'Excluir';
            btn_delete.id = e.id;
            btn_delete.type = 'button';
            btn_delete.className = 'btn btn-danger';
            btn_delete.setAttribute("onclick","DeleteOne(this);")

            td.appendChild(input);
            td.appendChild(title);
            td.appendChild(description);
            td.appendChild(button);
            td.appendChild(btn_delete);
            tr.appendChild(td);
            table.appendChild(tr);

            /*const elem = document.createElement('tr');
            elem.className = "d-flex mt-2";
        
            const elemCard = document.createElement('td');
            elemCard.className = "d-flex flex-row justify-content-between card p-4";
            elemCard.style = "width: 18rem;"
            elem.appendChild(elemCard);
        
            const cardItem = document.createElement('div');
            cardItem.className = "form-check";
            elemCard.appendChild(cardItem);
    
            const inputCard = document.createElement('input');
            inputCard.className = "form-check-input";
            inputCard.type = 'text';
            if(e.status == 'A') {
                inputCard.value = 'yes';
            } else {
                inputCard.value = 'no';
            }
            cardItem.appendChild(inputCard);
    
            const textCard = document.createElement('p');
            textCard.innerHTML = e.title;
            cardItem.appendChild(textCard);
    
            const buttonCard = document.createElement('button');
            buttonCard.innerHTML = 'Ver Detalhes';
            buttonCard.type = 'button';
            buttonCard.className = 'btn btn-primary';
            buttonCard.className = 'btn btn-primary';
            buttonCard.setAttribute('data-bs-toggle' , 'modal');
            buttonCard.setAttribute('data-bs-target' , '#modalCadastro');
            //buttonCard.onclick(GetOneTask(e.id , e.fk_user));
            elemCard.appendChild(buttonCard);
    
            document.getElementById('table').appendChild(elem);*/
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
                //alert('Tarefa criado com sucesso!');
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
                //alert('Tarefa criado com sucesso!');
            }
        })

    }
}