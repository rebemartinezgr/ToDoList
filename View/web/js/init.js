
function editItem(data)
{
    // Create an XMLHttpRequest object
    const xhttp = new XMLHttpRequest();
    // Define a callback function to reload the list
    xhttp.onload = function() {
        if (xhttp.status === 200) {
            try{
                response = JSON.parse(xhttp.response);
                processUpdate(data.get('id'), response);
            } catch(err) {
                alert("La acción no ha podido ser completada. Por favor, inténtalo de nuevo");
                throw new Error("Did not receive JSON, instead received: " + xhttp.response)
            }
        } else {
            alert("La acción no ha podido ser completada. Por favor, inténtalo de nuevo");
            throw new Error("Did not receive JSON, instead received: " + xhttp.response)
        }
    }
    // Send a request
    xhttp.open("POST", "/Controller/Put.php");
    xhttp.send(data);
}

function addItem(data)
{
    // Create an XMLHttpRequest object
    const xhttp = new XMLHttpRequest();
    // Define a callback function to reload the list
    xhttp.onload = function() {
        if (xhttp.status === 200) {
            try{
                response = JSON.parse(xhttp.response);
                processNew(response);
            } catch(err) {
                alert("La acción no ha podido ser completada. Por favor, inténtalo de nuevo");
                throw new Error("Did not receive JSON, instead received: " + xhttp.response)
            }
        } else {
            alert("La acción no ha podido ser completada. Por favor, inténtalo de nuevo");
            throw new Error("Did not receive JSON, instead received: " + xhttp.response)
        }
    }
    // Send a request
    xhttp.open("POST", "/Controller/Post.php");
    xhttp.send(data);
}

function deleteItem(data)
{
    // Create an XMLHttpRequest object
    const xhttp = new XMLHttpRequest();
    // Define a callback function to reload the list
    xhttp.onload = function() {
        if (xhttp.status === 200) {
            try{
                response = JSON.parse(xhttp.response);
                processDeleted(data.get('id'))
            } catch(err) {
                alert("La acción no ha podido ser completada. Por favor, inténtalo de nuevo");
                throw new Error("Did not receive JSON, instead received: " + xhttp.response)
            }
        } else {
            alert("La acción no ha podido ser completada. Por favor, inténtalo de nuevo");
            throw new Error("Did not receive JSON, instead received: " + xhttp.response)
        }
    }
    // Send a request
    xhttp.open("POST", "/Controller/Delete.php");
    xhttp.send(data);
}

function processUpdate(id, items)
{
    for (const key of Object.keys(items)) {
        let itemElement = document.getElementById(key);
        itemElement.innerHTML = items[key];
    }
}

function processItems(items) {
    for (const key of Object.keys(items)) {
        createHtmlItem(key, items[key]);
    }
}

function processNew(items)
{
    processItems(items);
}

function processDeleted(id)
{
    let itemElement = document.getElementById(id);
    itemElement.remove();
}

function getListElement() {
    return document.getElementById("list");
}

function getNewItemInput() {
    return document.getElementById("new-item");
}

function createHtmlItem(key, itemHtml) {
    list = getListElement();
    let newItem = document.createElement('li');
    newItem.id = key
    newItem.innerHTML = itemHtml;
    newItem.classList.add("list-group-item");
    list.appendChild(newItem);
}

function handleStatusClick(checkbox)
{
    var data = new FormData();
    let itemValue = document.getElementById("value-" + checkbox.dataset.id);
    let status = checkbox.checked ? '1' : '0';
    data.append('id', checkbox.dataset.id);
    data.append('status', status);
    data.append('value',  itemValue.innerText);
    editItem(data);
}

function handleRemoveItem(removeButton)
{
    var data = new FormData();
    data.append('id', removeButton.dataset.id);
    deleteItem(data);
}

