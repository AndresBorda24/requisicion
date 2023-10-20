<div
x-data="Sugerencias"
x-modelable="input"
x-model="state.cargo"
class="position-relative flex-grow-1">
  <input
  type="text"
  id="cargo"
  required autocomplete="off"
  placeholder="Ej: Auxiliar de Sistemas"
  x-model.debounce.400="input"
  @input.debounce.300="searchCargo($event.target.value)"
  @keydown.up.prevent="goUp"
  @keydown.tab="sugerencias = []"
  @keydown.down.prevent="goDown"
  @keydown.enter.prevent="selectItem"
  class="form-control form-control-sm text-uppercase" id="cargo">

  <ul
  @click.outside="sugerencias = []"
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
