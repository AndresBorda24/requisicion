<tr
x-data="GrillaItem( r.id )"
class="small align-middle position-relative">
  <td x-text="item?.id" class="text-nowrap"></td>
  <td x-text="item?.area_nombre" class="small text-nowrap"></td>
  <td x-text="item?.cargo" class="small text-nowrap"></td>
  <td class="text-nowrap px-2">
    <span x-text="item?.created_at.substring(0, 10)"></span>
    <span class="small text-muted">
      (<span x-text="diffDays('created_at')"></span> d&iacute;as)
    </span>
  </td>
  <td :class="['text-nowrap border border-opacity-50', style]">
    <span x-text="item?._state"></span>
    <span class="small text-muted">
      (<span x-text="diffDays('state_at')"></span> d&iacute;as)
    </span>
  </td>
  <td class="position-sticky end-0">
    <button
    class="btn btn-sm btn-warning py-0"
    @click="verRequisicion( item )"
    type="button">
      <span class="small">Ver</span>
    </button>
  </td>
</tr>
