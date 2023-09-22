<div class="p-3"
x-transition:enter.delay.80ms
x-show="tab === 3"
style="min-height: 350px;">
  <div class="sticky-top pt-1">
    <?= $this->fetch("./partials/obs/obs.php") ?>
  </div>
  <ul x-data="ObsList" class="list-group list-group-flush" x-bind="events">
    <template x-for="ob in obsList" :key="ob.id">
    <li class="list-group-item obs-list-item">
      <span
      x-text="ob.author"
      class="badge text-bg-success small"></span>
      <p class="small m-0" x-text="ob.body"></p>
      <span
      x-text="ob.at"
      class="d-block text-end text-muted small"></span>
    </li>
    </template>
  </ul>
</div>
