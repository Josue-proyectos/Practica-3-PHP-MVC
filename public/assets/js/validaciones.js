document.addEventListener('DOMContentLoaded', function () {
    const formulario = document.getElementById('formRegistro');
    if (!formulario) return;

    formulario.addEventListener('submit', function (evento) {
        const identificacion = document.getElementById('identificacion');
        const monto = document.getElementById('monto');
        const tipo = document.getElementById('tipo');

        identificacion.classList.toggle('is-invalid', identificacion.value.trim() === '');
        monto.classList.toggle('is-invalid', monto.value === '' || Number(monto.value) <= 0);
        tipo.classList.toggle('is-invalid', tipo.value === '');

        if (!formulario.checkValidity() || identificacion.value.trim() === '' ||
            Number(monto.value) <= 0 || tipo.value === '') {
            evento.preventDefault();
            evento.stopPropagation();
        }
        formulario.classList.add('was-validated');
    });
});
