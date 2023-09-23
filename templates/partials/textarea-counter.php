<div x-data="{
  _el: undefined,
  counter: 0
}" x-init="
  _el = document.querySelector('<?= $id ?>');
  _el?.addEventListener('input', () => counter = _el.value.length)
">
  <span class="small text-muted">
    <span x-text="counter"></span>
    <template x-if="_el?.getAttribute('maxlength')">
      <span>
        / <span x-text="_el?.getAttribute('maxlength')"></span>
      </span>
    </template>
  </span>
</div>
