<details
x-data="ReqPlantillas"
class="position-relative"
x-show="total > 0"
@click.outside="$el.removeAttribute('open')">
  <summary
  x-text="total"
  title="Plantillas"
  class="btn btn-sm btn-primary rounded-full shadow"></summary>

  <div
  style="width: 280px;"
  class="border bg-body shadow p-2 small position-absolute mt-1 end-0 rounded">
    <p class="text-center fw-bold">Plantillas disponibles:</p>
    <ul class="list-group list-group-flush">
      <template x-for="(item, index) in list" :key="item.id">
        <li class="list-group-item d-flex align-items-center">
          <span class="flex-grow-1">
            <span
            class="fw-bold"
            x-text="item.cargo"></span><br>
            <span x-text="item.created_at"></span>
          </span>
          <button
          type="button"
          title="Cargar plantilla"
          @click="cargar( index )"
          class="btn btn-sm btn-success px-1 py-0">+</button>
        </li>
      </template>
    </ul>
  </div>
</details>
