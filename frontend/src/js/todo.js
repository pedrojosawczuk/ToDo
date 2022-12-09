

                                const idSession = localStorage.getItem('id');
                                console.log(idSession);

                                fetch("http://localhost/todo/backend/todo/create.php?id_user="+idSession) 

                                
                const table = document.getElementById('table');
                const posts = document.getElementById('posts');
    
                fetch("http://localhost/todo/backend/todo/list.php?token="+localStorage.getItem('token'))
                    .then(function (response) {
                        return response.text();
                    })
                    .then(function (arraybuffer) {
                        //console.log(arraybuffer);
                        const postsArray = JSON.parse(arraybuffer);
    
                        postsArray.forEach(e => {
                            const elem = document.createElement('tr');
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

                            document.getElementById('table').appendChild(elem);
                        })
                    }
                )
                



/*
        function GetOneTask(id , id_user){

            fetch('http://localhost/todo/backend/todo/list.php')
                        .then(function (response) {
                            return response.text();
                        })
                        .then(function (buffer) {
                            const post = JSON.parse(buffer);    
            })

            const idInput = document.getElementById('id');
            idInput.value = post.id;


            const idUserInput = document.getElementById('id_user');
            idUserInput.value = post.fkuser;


            const TitleInput = document.getElementById('nome');
            TitleInput.value = post.title;


            const DescriptionInput = document.getElementById('description');
            DescriptionInput.value = post.description;


            const deadLineInput = document.getElementById('deadline');
            deadLineInput.value = post.deadline;


            const statusCheck = document.getElementById('check');
            statusCheck.value = post.status;
        }*/


        function CreateTask(){

            const titleInput = document.getElementById('title');
            const descriptionInput = document.getElementById('description');
            const deadlineInput = document.getElementById('deadline');
            const checkInput = document.getElementById('check');
    
    
            const title = titleInput.value;
            const description = descriptionInput.value;
            const deadline = deadlineInput.value;
            const check = checkInput.value;
    
    
    
    
    
            fetch('http://localhost/todo/backend/todo/create.php', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    //'Authorization': localStorage.getItem('token'),
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ "title": title, "description":  description, "deadline": deadline, "check": check})
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
                    alert('Tarefa criado com sucesso!');
                }
            })
    
            }