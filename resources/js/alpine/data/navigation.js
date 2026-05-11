export default () => ({
    open: false,
    title() {
        return `${this.open ? 'Hide' : 'Show'} Navigation Menu`;
    },
    toggle() {
        this.open = !this.open;
    },
    close() {
        this.open = false;
    },
    menuClass() {
        return this.open ? 'flex' : 'hidden';
    },
});
