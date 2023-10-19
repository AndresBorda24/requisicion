/**
 * Remueve el oveflow de un elemento. Esto nos ayuda a que a la hora de abrir un
 * modal y hacer scroll, no se realice el scroll en el contenido que esta atras
 * del modal.
 * @param {Bool} o Quita o no el overflow
 * @param {String} el Query selector del elemento a remover el overflow.
*/
window.overflow = function(o = false, el = 'body') {
    if (o) {
        document.querySelector(el)?.classList.remove("overflow-hidden");
    } else {
        document.querySelector(el)?.classList.add("overflow-hidden");
    }
};

/**
 * Setea un alto al textarea dependiendo de su contenido.
 *
 * @param {Event} $e El evento, preferiblemente oninput
 * @return {void}
*/
window.resizeTextarea = function($e) {
    $e.target.style.height = "auto";
    $e.target.style.height = ($e.target.scrollHeight + 4) + "px";
}
