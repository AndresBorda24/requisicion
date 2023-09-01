export default (itemId) => ({
    id: itemId,

    get item() {
        return this.grillaData.find( ({ id }) => id == this.id );
    }
});
