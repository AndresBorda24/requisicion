<div class="p-3"
x-transition:enter.delay.80ms
x-show="tab === 3"
style="min-height: 300px;">
  <div class="sticky-top pt-1">
    <?= $this->fetch("./partials/obs/obs.php") ?>
  </div>
  <ul x-data="ObsList" class="list-group" x-bind="events">
    <template x-for="ob in obsList" :key="ob.id">
    <li class="bg-transparent list-group-item p-2 border-0">
      <p class="m-0 text-bg-light p-1 rounded border shadow-sm small">
        <span
        x-text="ob.author"
        class="d-block text-muted small"></span>
        <span x-text="ob.body"></span>
        <span
        x-text="ob.created_at"
        class="d-block text-end text-muted small"></span>
      </p>
    </li>
    </template>
  </ul>
</div>
