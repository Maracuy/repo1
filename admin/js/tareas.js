const formulariop = document.querySelector("#form");
formulariop.addEventListener('submit', (e) =>{
    e.preventDefault();
    const datos = new FormData(document.getElementById('form'));
    var nombre = datos.get('nombre');
    var url = "../modelo/tareas.php";
    fetch(url,{
        method:'post',
        body:datos
    })
    .then (data => data.json())
    .then (data =>{
        console.log('Success', data);
    })
    .catch(function(error){
        console.log('error', error);
    });
})