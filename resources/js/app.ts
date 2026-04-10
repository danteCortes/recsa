import { createApp, DefineComponent, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createPinia } from 'pinia';

createInertiaApp({
    resolve: (name: string) => resolvePageComponent(
        `./src/infrastructure/${name}.vue`, 
        import.meta.glob<DefineComponent>('./src/infrastructure/**/*.vue')
    ),
    setup({el, App, props, plugin}) {
        const pinia = createPinia();
        createApp({render: () => h(App, props)})
            .use(pinia)
            .use(plugin)
            .mount(el);
    },
});