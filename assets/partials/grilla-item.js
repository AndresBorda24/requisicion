export default (itemId) => ({
    id: itemId,

    get item() {
        return this.grillaData.find(({ id }) => id == this.id);
    },

    get show() {
        return this.item.state.includes(this.filters.state)
        && this.item.cargo.includes(this.filters.cargo)
        && this.item.area_id.includes(this.filters.area);
    }
});
