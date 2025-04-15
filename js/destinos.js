document.addEventListener('DOMContentLoaded', () => {
    fetch('data/destinos.json')
        .then(response => response.json())
        .then(data => mostrarDestinos(data))
        .catch(error => console.error('Error cargando destinos:', error));
});

function mostrarDestinos(destinos) {
    const contenedor = document.getElementById('destinosContainer');
    contenedor.innerHTML = '';

    destinos.forEach(destino => {
        const colDiv = document.createElement('div');
        colDiv.classList.add('col-md-4');

        const cardDiv = document.createElement('div');
        cardDiv.classList.add('card', 'h-100', 'shadow');

        const img = document.createElement('img');
        img.src = destino.imagen;
        img.classList.add('card-img-top');
        img.alt = destino.nombre;

        const cardBody = document.createElement('div');
        cardBody.classList.add('card-body');

        const cardTitle = document.createElement('h5');
        cardTitle.classList.add('card-title', 'text-brand');
        cardTitle.textContent = destino.nombre;

        const cardText = document.createElement('p');
        cardText.classList.add('card-text');
        cardText.textContent = destino.descripcion;

        const reservaLink = document.createElement('a');
        reservaLink.href = '#';
        reservaLink.setAttribute('data-bs-toggle', 'modal');
        reservaLink.setAttribute('data-bs-target', '#modalReservaTour');
        reservaLink.addEventListener('click', () => {
            document.getElementById('reserva-tour-id').value = destino.id;
            document.getElementById('reserva-tour-nombre').textContent = destino.nombre;
        });
        reservaLink.classList.add('btn', 'btn-amarillo');
        reservaLink.textContent = 'Reservar';

        // Botón Ver Detalles
        const verDetallesBtn = document.createElement('button');
        verDetallesBtn.classList.add('btn', 'btn-outline-secondary', 'ms-2');
        verDetallesBtn.textContent = 'Ver detalles';
        verDetallesBtn.setAttribute('data-bs-toggle', 'modal');
        verDetallesBtn.setAttribute('data-bs-target', '#modalDetallesDestino');

        // Evento click para mostrar el modal con detalles
        verDetallesBtn.addEventListener('click', () => {
            document.getElementById('modal-img').src = destino.imagen;
            document.getElementById('modal-titulo').textContent = destino.nombre;
            document.getElementById('modal-descripcion').textContent = destino.descripcion_larga || 'Descripción no disponible.';

            // Itinerario
            const itinerario = document.getElementById('modal-itinerario');
            itinerario.innerHTML = '';
            if (destino.itinerario) {
                destino.itinerario.forEach(paso => {
                    const li = document.createElement('li');
                    li.textContent = paso;
                    itinerario.appendChild(li);
                });
            }

            // Condiciones de reserva
            const reserva = document.getElementById('modal-reserva');
            reserva.innerHTML = '';
            if (destino.condiciones_reserva) {
                destino.condiciones_reserva.forEach(punto => {
                    const li = document.createElement('li');
                    li.textContent = punto;
                    reserva.appendChild(li);
                });
            }

            // Condiciones de cancelación
            const cancelacion = document.getElementById('modal-cancelacion');
            cancelacion.innerHTML = '';
            if (destino.condiciones_cancelacion) {
                destino.condiciones_cancelacion.forEach(punto => {
                    const li = document.createElement('li');
                    li.textContent = punto;
                    cancelacion.appendChild(li);
                });
            }
        });

        // Armar tarjeta
        cardBody.appendChild(cardTitle);
        cardBody.appendChild(cardText);
        cardBody.appendChild(reservaLink);
        cardBody.appendChild(verDetallesBtn);

        cardDiv.appendChild(img);
        cardDiv.appendChild(cardBody);
        colDiv.appendChild(cardDiv);
        contenedor.appendChild(colDiv);
    });
}
