function myfunc(id) {
    const menu = document.querySelectorAll('.details');
    // const main = document.querySelectorAll('.container');

    for (i = 0; i < menu.length; i++) {
        menu[i].classList.remove('active');
        // main[i].classList.remove('active2');
    }
    document.getElementById(id).classList.add('active');
    document.getElementById(id + 'cont').classList.add('active2');

}

function addFunc() {
    var task = document.getElementById("task_container");
    task.style.display = 'block';
    // wrapper.style.color = '#hhh';
}

function close_div() {
    var task = document.getElementById("task_container");
    task.style.display = task.style.display == "none" ? "block" : "none";
    // wrapper.style.color = '#fff';
}

function edit_close_div() {

    var blem = document.getElementById("edit_task_container");
    blem.style.display = blem.style.display == "none" ? "block" : "none";
    // wrapper.style.color = '#fff';
}

function update(table, id) {
    var bread = document.getElementById("edit_task_container");
    bread.style.display = 'block';

    var descript = document.getElementById("descrip");
    descrip.value = document.getElementById(table + id).innerHTML;

    var titles = document.getElementById("title");
    titles.value = document.getElementById(table + id + 'a').innerHTML;

    document.getElementById('edit').addEventListener('click', () => {
        let lalala = document.getElementById('status_edit').options[document.getElementById('status_edit').selectedIndex].value.toLowerCase()
        fetch("home.php?table=" + table + "&id=" + id + "&data=" + document.getElementById('descrip').value + "&title=" + document.getElementById('title').value + "&status_edit=" + lalala + "&change=" + table.includes(lalala));

        // alert("home.php?table=" + table + "&id=" + id + "&data=" + document.getElementById('descrip').value + "&title=" + document.getElementById('title').value + "&status_edit=" + lalala + "&change=" + table.includes(lalala));
        alert("Updated");

        location.href = 'home.php';
    })
    
}

function deleted(tabled, idd) {

    var bread = document.getElementById("edit_task_container");
    bread.style.display = 'block';

    var descript = document.getElementById("descrip");
    descrip.value = document.getElementById(tabled + idd).innerHTML;

    var titles = document.getElementById("title");
    titles.value = document.getElementById(tabled + idd + 'a').innerHTML;


    document.getElementById('delete').addEventListener('click', () => {
        let lalala = document.getElementById('status_edit').options[document.getElementById('status_edit').selectedIndex].value.toLowerCase()
        fetch("home.php?tabled=" + tabled + "&idd=" + idd + "&data=" + document.getElementById('descrip').value + "&title=" + document.getElementById('title').value);

        // alert("home.php?tabled=" + tabled + "&idd=" + idd + "&data=" + document.getElementById('descrip').value + "&title=" + document.getElementById('title').value + "&status_edit=" + lalala + "&change=" + tabled.includes(lalala));
        alert("Deleted");

        location.href = 'home.php'
    })
}





// var query_submit = document.getElementsByClassName('query_submit');
// var i=0;
// for(i=0;i<query_submit.length;i++){
//     query_submit[i].addEventListener('click', () => {
//          let lalala = document.getElementById('status_edit').options[document.getElementById('status_edit').selectedIndex].value.toLowerCase()
//          fetch("home.php?table=" + table + "&id=" + id + "&data=" + document.getElementById('descrip').value + "&title=" + document.getElementById('title').value + "&status_edit=" + lalala + "&change=" + table.includes(lalala));
 
//          // alert("home.php?table=" + table + "&id=" + id + "&data=" + document.getElementById('descrip').value + "&title=" + document.getElementById('title').value + "&status_edit=" + lalala + "&change=" + table.includes(lalala));
//          alert("Updated");
 
//          location.href = 'home.php'
//      })

// }