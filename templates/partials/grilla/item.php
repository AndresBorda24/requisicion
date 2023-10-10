<tr
x-data="GrillaItem( r.id )"
class="small align-middle position-relative">
  <td x-text="item?.id" class="text-nowrap"></td>
  <td x-text="item?.area_nombre" class="text-nowrap"></td>
  <td x-text="item?.cargo" class="text-nowrap"></td>
  <td x-text="item?.created_at" class="text-nowrap px-2"></td>
  <td :class="['text-nowrap border border-opacity-50', style]" x-html="item?._state"></td>
  <td class="position-sticky end-0">
    <button
    class="btn btn-sm btn-warning py-0"
    @click="verRequisicion( item )"
    type="button">
      <span class="small">Ver</span>
    </button>
  </td>
</tr>
