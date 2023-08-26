<div class="p-3"
x-transition:enter.delay.80ms
x-show="tab === 3"
style="min-height: 300px;">
  <div class="sticky-top pt-1">
    <?= $this->fetch("./partials/obs/obs.php") ?>
  </div>
  <ul x-data class="list-group">
    <template x-for="n in 10" :key="n">
    <li class="bg-transparent list-group-item p-2 border-0">
      <p class="m-0 text-bg-light p-1 rounded border shadow-sm small">
        <span class="d-block text-muted small">
          Andr&eacute;s Borda
        </span>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua.
        <span class="d-block text-end text-muted small">
          2023-04-28
        </span>
      </p>
    </li>
    </template>
  </ul>
</div>
