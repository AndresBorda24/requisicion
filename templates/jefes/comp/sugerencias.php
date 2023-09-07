<div
x-data="Sugerencias"
x-modelable="input"
x-model="state.cargo"
class="position-relative">
  <input
  type="text"
  id="cargo"
  required
  autocomplete="off"
  placeholder="Ej: Auxiliar de Sistemas"
  x-model="input"
  @input.debounce.300="searchCargo($event.target.value)"
  @keyup="$el.value = $el.value.toUpperCase()"
  @keydown.up.prevent="goUp"
  @keydown.down.prevent="goDown"
  @keydown.enter.prevent="selectItem"
  class="form-control form-control-sm text-uppercase" id="cargo">

  <ul
  x-show="! isEmpty"
  class="position-absolute z-1 top-100 star t-0 list-group list-group-hover small w-100 shadow"
  x-transition>
    <template x-for="(sug, i) in sugerencias" :key="i">
      <li
      @click.prevent="selectedItem = i; selectItem()"
      :class="{
        'list-group-item small list-group-item-action': true,
        'active': (i === selectedItem)
      }"
      x-text="sug.cargo"></li>
    </template>
  </ul>
</div>
