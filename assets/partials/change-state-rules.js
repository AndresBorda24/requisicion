import Alpine from "alpinejs";

/**
 * Reglas para mostrar o no el el componente en general
*/
export function CHANGE_STATE_RULES({ state, by, jefe_id, director }) {
  if (state === Alpine.store("META").get("estados")?.ANULADO) return false;
  if (by === Alpine.store("AUTH").get("tipo")) return false;

  if (Alpine.store("AUTH").get("tipo") === Alpine.store("META").get("u_tipos")?.TH) {
    return (state === Alpine.store("META").get("estados")?.SOLICITADO)
    || (state !== Alpine.store("META").get("estados")?.DEVUELTO)
  }

  if ([
    Alpine.store("META").get("u_tipos")?.DIRECTOR_CIENTIFICO,
    Alpine.store("META").get("u_tipos")?.DIRECTOR_ADMINISTRATIVO
  ].includes(Alpine.store("AUTH").get("tipo"))) {
    return (
      state === Alpine.store("META").get("estados")?.APROBADO
      && by == Alpine.store("META").get("u_tipos")?.TH
    ) && director === Alpine.store("AUTH").get("tipo")
  }

  if (Alpine.store("AUTH").get("tipo") === Alpine.store("META").get("u_tipos")?.GERENTE) {
    return state === Alpine.store("META").get("estados")?.APROBADO
      && ([
        Alpine.store("META").get("u_tipos")?.DIRECTOR_CIENTIFICO,
        Alpine.store("META").get("u_tipos")?.DIRECTOR_ADMINISTRATIVO
      ].includes(by) || (
        by === Alpine.store("META").get("u_tipos")?.TH
        && director === Alpine.store("AUTH").get("tipo")
      ))
  }

  console.log("mmm")
  return false;
}

/**
 * Estas "reglas" son para mostrar o no el boton de cada estado
 * posible
*/
export function CHANGE_STATE_BTN_RULES(st, { state, by }) {
  if (st === Alpine.store("META").get("estados")?.APROBADO) {
    return Alpine.store("AUTH").get("tipo")
      != Alpine.store("META").get("u_tipos")?.TH;
  }

  if (st === Alpine.store("META").get("estados")?.ANULADO) {
    return Alpine.store("AUTH").get("tipo")
      === Alpine.store("META").get("u_tipos")?.TH;
  }

  if (st === Alpine.store("META").get("estados")?.RECHAZADO) {
    return Alpine.store("AUTH").get("tipo")
      != Alpine.store("META").get("u_tipos")?.TH;
  }

  if (st === Alpine.store("META").get("estados")?.DEVUELTO) {
    return !(
      state === Alpine.store("META").get("estados")?.APROBADO
      && by === Alpine.store("META").get("u_tipos")?.GERENTE
    ) && (
      Alpine.store("AUTH").get("tipo")
      === Alpine.store("META").get("u_tipos")?.TH
    );
  }

  if (st == Alpine.store("META").get("estados")?.CUMPLIDO) {
    return (
      state === Alpine.store("META").get("estados")?.APROBADO
      && by === Alpine.store("META").get("u_tipos")?.GERENTE
    ) && (
      Alpine.store("AUTH").get("tipo")
      === Alpine.store("META").get("u_tipos")?.TH
    );
  }

  return false;
};
