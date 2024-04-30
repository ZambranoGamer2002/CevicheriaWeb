let loadMoreBtn = document.querySelector('#load-more');
let currentItem = 4;

loadMoreBtn.onclick = () => {
    let boxes = [...document.querySelectorAll('.box-container .box')];
    for(var i = currentItem; i< currentItem + 4; i++) {
        boxes[i].style.display = 'inline-block';
    }
    currentItem +=4;
    if(currentItem >= boxes.length) {
        loadMoreBtn.style.display ='none'
    }
}

let loadMoreBtn2 = document.querySelector('#load-more-2');
let currentItem2 = 4;

loadMoreBtn2.onclick = () => {
    let boxes = [...document.querySelectorAll('.box-container-2 .box-2')];
    for(var i = currentItem2; i< currentItem2 + 4; i++) {
        boxes[i].style.display = 'inline-block';
    }
    currentItem2 +=4;
    if(currentItem2 >= boxes.length) {
        loadMoreBtn2.style.display ='none'
    }
}


let loadMoreBtn3 = document.querySelector('#load-more-3');
let currentItem3 = 4;

loadMoreBtn3.onclick = () => {
    let boxes = [...document.querySelectorAll('.box-container-3 .box-3')];
    for(var i = currentItem3; i< currentItem3 + 4; i++) {
        boxes[i].style.display = 'inline-block';
    }
    currentItem3 +=4;
    if(currentItem3 >= boxes.length) {
        loadMoreBtn3.style.display ='none'
    }
}

let loadMoreBtn4 = document.querySelector('#load-more-4');
let currentItem4 = 4;

loadMoreBtn4.onclick = () => {
    let boxes = [...document.querySelectorAll('.box-container-4 .box-4')];
    for(var i = currentItem4; i< currentItem4 + 4; i++) {
        boxes[i].style.display = 'inline-block';
    }
    currentItem4 +=4;
    if(currentItem4 >= boxes.length) {
        loadMoreBtn4.style.display ='none'
    }
}


const carrito = document.getElementById('carrito');
const elementos1 = document.getElementById('lista-1');
const elementos2 = document.getElementById('lista-2');
const elementos3 = document.getElementById('lista-3');
const elementos4 = document.getElementById('lista-4');
const lista = document.querySelector('#lista-carrito tbody');
const vaciarCarritoBtn = document.getElementById('vaciar-carrito');

cargarEventListeners();

function cargarEventListeners() {
    elementos1. addEventListener('click', comprarElemento);
    elementos2. addEventListener('click', comprarElemento);
    elementos3. addEventListener('click', comprarElemento);
    elementos4. addEventListener('click', comprarElemento);
    
    carrito.addEventListener('click', eliminarElemento);
    vaciarCarritoBtn.addEventListener('click', vaciarCarrito);
}

function comprarElemento(e) {
    e.preventDefault();

    if(e.target.classList.contains('agregar-carrito')) {
        const elemento = e.target.parentElement.parentElement;
        leerDatosElemento(elemento);
    }
}

function leerDatosElemento(elemento) {
    const infoElemento = {
        imagen: elemento.querySelector('img').src,
        titulo: elemento.querySelector('h3').textContent,
        precio: elemento.querySelector('.precio').textContent,
        id: elemento.querySelector('a').getAttribute('data-id')
    }
    insertarCarrito(infoElemento)
}

function insertarCarrito(elemento) {
    const row = document.createElement('tr');
    row.innerHTML = `
    
        <td>
            <img src="${elemento.imagen}" width=100   />
        </td>

        <td>
            ${elemento.titulo}
        </td>

        <td>
            ${elemento.precio}
        </td>

        <td>

            <a herf="#" class="borrar" data-id="${elemento.id0}">X</a>

        </td>

    `;

    lista.appendChild(row);
}


function eliminarElemento(e) {
    
    e.preventDefault();
    let elemento,
        elementoId;

    if(e.target.classList.contains('borrar')) {
        e.target.parentElement.parentElement.remove();
        elemento = e.target.parentElement.parentElement;
        elementoId = elemento.querySelector('a').getAttribute('data-id');
    }
}


function vaciarCarrito() {
    while(lista.firstChild) {
        lista.removeChild(lista.firstChild);
    }
    return false;
}