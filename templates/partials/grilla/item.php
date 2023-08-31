<tr
x-data="GrillaItem( r.id )"
class="small align-middle position-relative">
  <td x-text="item?.id" class="text-nowrap"></td>
  <td x-text="item?.area_nombre" class="text-nowrap"></td>
  <td x-text="item?.cargo" class="text-nowrap"></td>
  <td x-text="item?.created_at" class="text-nowrap px-2"></td>
  <td :class="['p-0 position-relative', stateClass]">
    <span class="position-absolute top-0 end-0 h-100 d-flex align-items-center
    ps-2 bg-white bg-opacity-50 text-black" style="width: 97%;">
      <span x-html="item?._state"></span>
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
