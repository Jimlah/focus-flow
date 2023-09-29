import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';
import Sortable from "./sortable.js";
import './bootstrap.js';

Alpine.plugin(Sortable);

Livewire.directive('sortable', ({el, directive, component, cleanup}) => {
    let attribute = directive.rawName.replace('wire:sortable', 'x-sortable').replace('.', ':');
    let cleanupBinding = Alpine.bind(el, {
        [attribute](){
            this.$nextTick(() => {
                // Alpine.evaluate(el, '$wire.' + directive.expression, {scope: {event: 0}} )
            })
        },
        ['@sortable:stop'](){
            let items = []
            el.querySelectorAll('[wire\\:sortable\\.item]').forEach((el, index) => {
                items.push({ order: index + 1, value: el.getAttribute('wire:sortable.item')})
            })
            component.$wire.call(directive.method, items);
        }
    })

    cleanup(cleanupBinding);
});

Livewire.start()

