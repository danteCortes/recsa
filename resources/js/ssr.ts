import { createSSRApp, DefineComponent, h } from 'vue'
import { renderToString } from '@vue/server-renderer'
import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { createPinia } from 'pinia';

export default function render(page: any) {
    return createInertiaApp({
		page,
		render: renderToString,
		resolve: (name) =>
			resolvePageComponent(
				`./src/infrastructure/${name}.vue`, 
				import.meta.glob<DefineComponent>('./src/infrastructure/**/*.vue')
			),
		setup({ App, props, plugin }) {
			const pinia = createPinia();
			return createSSRApp({ render: () => h(App, props) })
            	.use(pinia)
				.use(plugin)
		},
    })
}