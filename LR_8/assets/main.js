const cmtBody=document.querySelector('#cmt tbody');
const ptBody=document.querySelector('#pt tbody');
const ttBody=document.querySelector('#tt tbody');
const cttBody=document.querySelector('#ctt tbody');
const pttBody=document.querySelector('#ptt tbody');

const cmf=document.getElementById('cmf');
const pf=document.getElementById('pf');
const tf=document.getElementById('tf');
const ctf=document.getElementById('ctf');
const ptf=document.getElementById('ptf');

const cmrow=document.getElementById('cmrow');
const prow=document.getElementById('prow');
const trow=document.getElementById('trow');
const ctrow=document.getElementById('ctrow');
const ptrow=document.getElementById('ptrow');

const pS = document.getElementById('pS');
const tS = document.getElementById('tS');
const ctS = document.getElementById('ctS');
const ptS = document.getElementById('ptS');

const mainnav=document.getElementById('mainnav');
const loginf=document.getElementById('loginf');

let cmData = {};
let pData = {};
let tData = {};
let ctData = {};
let ptData = {};

fetch('../api/profile')
    .then((response) => response.json())
    .then((data) => {
        if(data['login'] == true) {
            mainnav.style.display = "flex";
            loginf.style.display = "none";
        }
        else {
            mainnav.style.display = "none";
            loginf.style.display = "block";
            cmrow.style.display = "none";
            prow.style.display = "none";
            trow.style.display = "none";
            ctrow.style.display = "none";
            ptrow.style.display = "none";
        }
    })
    .catch(console.error);

function displayCoffeeMachines(query) {
    let url = '../api/Coffee_machines';
    if (query !== null) {
        url = '../api/Coffee_machines?query=' + query;
    }
    fetch(url)
    .then((response) => response.json())
    .then((data) => {
        cmData = data;
        let content = '';
        for (i=0; i<data.length; i++) {
            content += `<tr> 
            <td>${data[i]['id']}</td>
            <td>${data[i]['model']}</td>
            <td>${data[i]['producer_id']}</td>
            <td>${data[i]['type_id']}</td>
            <td>${data[i]['coffee_type_id']}</td>
            <td>${data[i]['power_type_id']}</td>
            <td><a href = "#" class = "edit-coffeeMachine" data-id = "${data[i]['id']}">Edit</a>
            <a href = "#" class = "delete-coffeeMachine" data-id = "${data[i]['id']}">Delete</a></td>
            </tr>`
        }
        cmtBody.innerHTML=content;
    })
    .catch(console.error);
}

function displayProducers() {
fetch('../api/Producers')
    .then((response) => response.json())
    .then((data) => {
        pData = data;
        let content = '';
        let inputContent = ''; 
        for (i=0; i<data.length; i++) {
            content += `<tr> 
            <td>${data[i][`id`]}</td>
            <td>${data[i][`name`]}</td>
            <td><a href = "#" class = "edit-producer" data-id = "${data[i][`id`]}">Edit</a>
            <a href = "#" class = "delete-producer" data-id = "${data[i][`id`]}">Delete</a></td>
            </tr>`
            inputContent += `<option value="${data[i][`id`]}">${data[i][`name`]}</option>`;
        }
            ptBody.innerHTML=content;
            pS.innerHTML = inputContent;
    })
    .catch(console.error);
}

function displayTypes() {
fetch('../api/Types')
    .then((response) => response.json())
    .then((data) => {
        tData = data;
        let content = '';
        let inputContent = '';
        for (i=0; i<data.length; i++) {
            content += `<tr> 
            <td>${data[i][`id`]}</td>
            <td>${data[i][`type`]}</td>
            <td><a href = "#" class = "edit-type" data-id = "${data[i][`id`]}">Edit</a>
            <a href = "#" class = "delete-type" data-id = "${data[i][`id`]}">Delete</a></td>
            </tr>`
            inputContent += `<option value="${data[i][`id`]}">${data[i][`type`]}</option>`;
        }
            ttBody.innerHTML=content;
            tS.innerHTML = inputContent;
    })
    .catch(console.error);
}

function displayCoffeeTypes() {
fetch('../api/Coffee_types')
    .then((response) => response.json())
    .then((data) => {
        ctData = data;
        let content = '';
        let inputContent = '';
        for (i=0; i<data.length; i++) {
            content += `<tr> 
            <td>${data[i][`id`]}</td>
            <td>${data[i][`coffee_type`]}</td>
            <td><a href = "#" class = "edit-coffeeType" data-id = "${data[i][`id`]}">Edit</a>
            <a href = "#" class = "delete-coffeeType" data-id = "${data[i][`id`]}">Delete</a></td>
            </tr>`
            inputContent += `<option value="${data[i][`id`]}">${data[i][`coffee_type`]}</option>`;
        }
            cttBody.innerHTML=content;
            ctS.innerHTML = inputContent;
    })
    .catch(console.error);
}

function displayPowerTypes() {
fetch('../api/Power_types')
    .then((response) => response.json())
    .then((data) => {
        ptData = data;
        let content = '';
        let inputContent = '';
        for (i=0; i<data.length; i++) {
            content += `<tr> 
            <td>${data[i][`id`]}</td>
            <td>${data[i][`power_type`]}</td>
            <td><a href = "#" class = "edit-powerType" data-id = "${data[i][`id`]}">Edit</a>
            <a href = "#" class = "delete-powerType" data-id = "${data[i][`id`]}">Delete</a></td>
            </tr>`
            inputContent += `<option value="${data[i][`id`]}">${data[i][`power_type`]}</option>`;
        }
            pttBody.innerHTML=content;
            ptS.innerHTML = inputContent;
    })
    .catch(console.error);
}

displayCoffeeMachines(null);
displayProducers();
displayTypes();
displayCoffeeTypes();
displayPowerTypes();

document.addEventListener('submit', function(e) {
    if(e.target.id =="loginf") {
        e.preventDefault();
        let flogin = document.querySelector('#loginf input[name="login"]').value;
        let fpassword = document.querySelector('#loginf input[name="password"]').value;
        let data = JSON.stringify({"login": flogin, "password": fpassword});
            fetch("../api/profile", {
                method: 'POST',
                headers: {
                    'Accept': 'application/json, text/plain, */*',
                    'Content-Type': 'application/json'
                },
                body: data
            })
            .then(function(res) { return res.json(); })
            .then(function(data) { 
                if(data['login'] == true) {
                    mainnav.style.display = "flex";
                    loginf.style.display = "none";
                }
                else {
                    mainnav.style.display = "none";
                    loginf.style.display = "block";
                    cmrow.style.display = "none";
                    prow.style.display = "none";
                    trow.style.display = "none";
                    ctrow.style.display = "none";
                    ptrow.style.display = "none";
                }
            })
    }
    if(e.target.id =="searchF") {
        e.preventDefault();
        let fquery = document.querySelector('#searchF input[name="query"]').value;
        displayCoffeeMachines(fquery);
    }

    if(e.target.id =="cmf") {
        e.preventDefault();
        let fid = document.querySelector('#cmf input[name="item_id"]').value;
        let fmodel = document.querySelector('#cmf input[name="model"]').value;
        let fproducerid = document.querySelector('#cmf select[name="producer_id"]').value;
        let ftypeid = document.querySelector('#cmf select[name="type_id"]').value;
        let fcoffeetypeid = document.querySelector('#cmf select[name="coffee_type_id"]').value;
        let fpowertypeid = document.querySelector('#cmf select[name="power_type_id"]').value;
        vardump = fpowertypeid;
        vardump = fcoffeetypeid;
        vardump = ftypeid;
        vardump = fproducerid;

        if (fid == '') {
            let data = JSON.stringify({"model": fmodel, "producer_id": fproducerid, "type_id": ftypeid, "coffee_type_id": fcoffeetypeid, "power_type_id": fpowertypeid});
            fetch("../api/Coffee_machines", {
                method: 'POST',
                headers: {
                    'Accept': 'application/json, text/plain, */*',
                    'Content-Type': 'application/json'
                },
                body: data
            })
            .then(function(res) { return res.json(); })
            .then(function(data) { displayCoffeeMachines(null); cmf.reset(); document.querySelector('#cmf input[name="item_id"]').value = ''; })
        }
        else {
            let data = JSON.stringify({"id":fid, "model": fmodel, "producer_id": fproducerid, "type_id": ftypeid, "coffee_type_id": fcoffeetypeid, "power_type_id": fpowertypeid});
            fetch("../api/Coffee_machines", {
                method: 'PUT',
                headers: {
                    'Accept': 'application/json, text/plain, */*',
                    'Content-Type': 'application/json'
                },
                body: data
            })
            .then(function(res) { return res.json(); })
            .then(function(data) { displayCoffeeMachines(null); cmf.reset(); document.querySelector('#cmf input[name="item_id"]').value = ''; })
        }
    }

    if(e.target.id =="pf") {
        e.preventDefault();
        let fid = document.querySelector('#pf input[name="item_id"]').value;
        let fname = document.querySelector('#pf input[name="name"]').value;
        if (fid == '') {
            let data = JSON.stringify({"name": fname});
            fetch("../api/Producers", {
                method: 'POST',
                headers: {
                    'Accept': 'application/json, text/plain, */*',
                    'Content-Type': 'application/json'
                },
                body: data
            })
            .then(function(res) { return res.json(); })
            .then(function(data) { displayProducers(); pf.reset(); document.querySelector('#pf input[name="item_id"]').value = ''; })
        }
        else {
            let data = JSON.stringify({"id":fid, "name": fname});
            fetch("../api/Producers", {
                method: 'PUT',
                headers: {
                    'Accept': 'application/json, text/plain, */*',
                    'Content-Type': 'application/json'
                },
                body: data
            })
            .then(function(res) { return res.json(); })
            .then(function(data) { displayProducers(); pf.reset(); document.querySelector('#pf input[name="item_id"]').value = ''; })
        }
    }

    if(e.target.id =="tf") {
        e.preventDefault();
        let fid = document.querySelector('#tf input[name="item_id"]').value;
        let ftype = document.querySelector('#tf input[name="type"]').value;
        if (fid == '') {
            let data = JSON.stringify({"type": ftype});
            fetch("../api/Types", {
                method: 'POST',
                headers: {
                    'Accept': 'application/json, text/plain, */*',
                    'Content-Type': 'application/json'
                },
                body: data
            })
            .then(function(res) { return res.json(); })
            .then(function(data) { displayTypes(); tf.reset(); document.querySelector('#tf input[name="item_id"]').value = ''; })
        }
        else {
            let data = JSON.stringify({"id":fid, "type": ftype});
            fetch("../api/Types", {
                method: 'PUT',
                headers: {
                    'Accept': 'application/json, text/plain, */*',
                    'Content-Type': 'application/json'
                },
                body: data
            })
            .then(function(res) { return res.json(); })
            .then(function(data) { displayTypes(); tf.reset(); document.querySelector('#tf input[name="item_id"]').value = ''; })
        }
    }

    if(e.target.id =="ctf") {
        e.preventDefault();
        let fid = document.querySelector('#ctf input[name="item_id"]').value;
        let fcoffeetype = document.querySelector('#ctf input[name="coffee_type"]').value;
        if (fid == '') {
            let data = JSON.stringify({"coffee_type": fcoffeetype});
            fetch("../api/Coffee_types", {
                method: 'POST',
                headers: {
                    'Accept': 'application/json, text/plain, */*',
                    'Content-Type': 'application/json'
                },
                body: data
            })
            .then(function(res) { return res.json(); })
            .then(function(data) { displayCoffeeTypes(); ctf.reset(); document.querySelector('#ctf input[name="item_id"]').value = ''; })
        }
        else {
            let data = JSON.stringify({"id":fid, "coffee_type": fcoffeetype});
            fetch("../api/Coffee_types", {
                method: 'PUT',
                headers: {
                    'Accept': 'application/json, text/plain, */*',
                    'Content-Type': 'application/json'
                },
                body: data
            })
            .then(function(res) { return res.json(); })
            .then(function(data) { displayCoffeeTypes(); ctf.reset(); document.querySelector('#ctf input[name="item_id"]').value = ''; })
        }
    }

    if(e.target.id =="ptf") {
        e.preventDefault();
        let fid = document.querySelector('#ptf input[name="item_id"]').value;
        let fpowertype = document.querySelector('#ptf input[name="power_type"]').value;
        if (fid == '') {
            let data = JSON.stringify({"power_type": fpowertype});
            fetch("../api/Power_types", {
                method: 'POST',
                headers: {
                    'Accept': 'application/json, text/plain, */*',
                    'Content-Type': 'application/json'
                },
                body: data
            })
            .then(function(res) { return res.json(); })
            .then(function(data) { displayPowerTypes(); ptf.reset(); document.querySelector('#ptf input[name="item_id"]').value = ''; })
        }
        else {
            let data = JSON.stringify({"id":fid, "power_type": fpowertype});
            fetch("../api/Power_types", {
                method: 'PUT',
                headers: {
                    'Accept': 'application/json, text/plain, */*',
                    'Content-Type': 'application/json'
                },
                body: data
            })
            .then(function(res) { return res.json(); })
            .then(function(data) { displayPowerTypes(); ptf.reset(); document.querySelector('#ptf input[name="item_id"]').value = ''; })
        }
    }
}, false);

document.addEventListener('click', function(e) {
    if(e.target.classList.contains('edit-coffeeMachine')) {
        e.preventDefault();
        for (i=0; i<cmData.length; i++) {
            if(cmData[i]['id'] == e.target.getAttribute('data-id')) {
                let itemData = cmData[i];
                document.querySelector('#cmf input[name="item_id"]').value = itemData['id'];
                document.querySelector('#cmf input[name="model"]').value = itemData['model'];
                document.querySelector('#cmf select[name="producer_id"]').value = itemData['producer_id'];
                document.querySelector('#cmf select[name="type_id"]').value = itemData['type_id'];
                document.querySelector('#cmf select[name="coffee_type_id"]').value = itemData['coffee_type_id'];
                document.querySelector('#cmf select[name="power_type_id"]').value = itemData['power_type_id'];
            }
        }
    } 
    else if(e.target.classList.contains('delete-coffeeMachine')) {
        e.preventDefault();
        let data = JSON.stringify({"id":e.target.getAttribute('data-id')});
            fetch("../api/Coffee_machines", {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json, text/plain, */*',
                    'Content-Type': 'application/json'
                },
                body: data
            })
            .then(function(res) { return res.json(); })
            .then(function(data) { displayCoffeeMachines(null);})
    }

    if(e.target.classList.contains('edit-producer')) {
        e.preventDefault();
        for (i=0; i<pData.length; i++) {
            if(pData[i]['id'] == e.target.getAttribute('data-id')) {
                let itemData = pData[i];
                document.querySelector('#pf input[name="item_id"]').value = itemData['id'];
                document.querySelector('#pf input[name="name"]').value = itemData['name'];
            }
        }
    } 
    else if(e.target.classList.contains('delete-producer')) {
        e.preventDefault();
        let data = JSON.stringify({"id":e.target.getAttribute('data-id')});
            fetch("../api/Producers", {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json, text/plain, */*',
                    'Content-Type': 'application/json'
                },
                body: data
            })
            .then(function(res) { return res.json(); })
            .then(function(data) { displayProducers();})
    }

    if(e.target.classList.contains('edit-type')) {
        e.preventDefault();
        for (i=0; i<tData.length; i++) {
            if(tData[i]['id'] == e.target.getAttribute('data-id')) {
                let itemData = tData[i];
                document.querySelector('#tf input[name="item_id"]').value = itemData['id'];
                document.querySelector('#tf input[name="type"]').value = itemData['type'];
            }
        }
    } 
    else if(e.target.classList.contains('delete-type')) {
        e.preventDefault();
        let data = JSON.stringify({"id":e.target.getAttribute('data-id')});
            fetch("../api/Types", {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json, text/plain, */*',
                    'Content-Type': 'application/json'
                },
                body: data
            })
            .then(function(res) { return res.json(); })
            .then(function(data) { displayTypes();})
    }

    if(e.target.classList.contains('edit-coffeeType')) {
        e.preventDefault();
        for (i=0; i<ctData.length; i++) {
            if(ctData[i]['id'] == e.target.getAttribute('data-id')) {
                let itemData = ctData[i];
                document.querySelector('#ctf input[name="item_id"]').value = itemData['id'];
                document.querySelector('#ctf input[name="coffee_type"]').value = itemData['coffee_type'];
            }
        }
    } 
    else if(e.target.classList.contains('delete-coffeeType')) {
        e.preventDefault();
        let data = JSON.stringify({"id":e.target.getAttribute('data-id')});
            fetch("../api/Coffee_types", {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json, text/plain, */*',
                    'Content-Type': 'application/json'
                },
                body: data
            })
            .then(function(res) { return res.json(); })
            .then(function(data) { displayCoffeeTypes();})
    }

    if(e.target.classList.contains('edit-powerType')) {
        e.preventDefault();
        for (i=0; i<ptData.length; i++) {
            if(ptData[i]['id'] == e.target.getAttribute('data-id')) {
                let itemData = ptData[i];
                document.querySelector('#ptf input[name="item_id"]').value = itemData['id'];
                document.querySelector('#ptf input[name="power_type"]').value = itemData['power_type'];
            }
        }
    } 
    else if(e.target.classList.contains('delete-powerType')) {
        e.preventDefault();
        let data = JSON.stringify({"id":e.target.getAttribute('data-id')});
            fetch("../api/Power_types", {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json, text/plain, */*',
                    'Content-Type': 'application/json'
                },
                body: data
            })
            .then(function(res) { return res.json(); })
            .then(function(data) { displayPowerTypes();})
    }

    if(e.target.id =="cmb") {
        e.preventDefault();
        cmrow.style.display = "flex";
        prow.style.display = "none";
        trow.style.display = "none";
        ctrow.style.display = "none";
        ptrow.style.display = "none";
    }
    else if(e.target.id =="pb") {
        e.preventDefault();
        prow.style.display = "flex";
        cmrow.style.display = "none";
        trow.style.display = "none";
        ctrow.style.display = "none";
        ptrow.style.display = "none";
    }
    else if(e.target.id =="tb") {
        e.preventDefault();
        trow.style.display = "flex";
        cmrow.style.display = "none";
        prow.style.display = "none";
        ctrow.style.display = "none";
        ptrow.style.display = "none";
    }
    else if(e.target.id =="ctb") {
        e.preventDefault();
        ctrow.style.display = "flex";
        cmrow.style.display = "none";
        prow.style.display = "none";
        trow.style.display = "none";
        ptrow.style.display = "none";
    }
    else if(e.target.id =="ptb") {
        e.preventDefault();
        ptrow.style.display = "flex";
        cmrow.style.display = "none";
        prow.style.display = "none";
        trow.style.display = "none";
        ctrow.style.display = "none";
    }
    else if(e.target.id =="logoutb") {
        e.preventDefault();
        fetch("../api/profile?action=logout")
            .then(function(res) { return res.json(); })
            .then(function(data) { 
                mainnav.style.display = "none";
                loginf.style.display = "block";
                cmrow.style.display = "none";
                prow.style.display = "none";
                trow.style.display = "none";
                ctrow.style.display = "none";
                ptrow.style.display = "none";
            });   
    }
}, false);