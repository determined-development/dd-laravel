const moduleName = /([^/]+)\.js$/;

const alpineData = import.meta.glob('./data/**/*.js', {
    eager: true,
    import: 'default',
});

const alpineStores = import.meta.glob('./stores/**/*.js', {
    eager: true,
    import: 'default',
});

document.addEventListener('alpine:init', () => {
    for (const path in alpineStores) {
        window.Alpine.store(moduleName.exec(path)[1], alpineStores[path]());
    }
    for (const path in alpineData) {
        window.Alpine.data(moduleName.exec(path)[1], alpineData[path]);
    }
});
