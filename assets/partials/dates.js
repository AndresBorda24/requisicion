const __today = new Date();


/**
 * Retorna la diferencia en dias entre una fecha y el dia actual.
 *
 * @throws Error En caso de que la fecha sea invalida.
*/
export function getTodayDiff( date ) {
    const d = checkValidDate(date);
    if(d === false) throw new Error("Invalid Date Provided");

    const diff = (__today < d)
        ? d - __today
        : __today - d;

    return Math.round(diff / (1000 * 60 * 60 * 24));
}

function checkValidDate( date ) {
    if (typeof date === 'string') {
        date = new Date( date );
    }

    if (! date instanceof Date) return false;
    if (isNaN(date.getDate())) return false;

    return date;
}
