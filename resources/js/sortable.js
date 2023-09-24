import {Sortable} from "@shopify/draggable";

Livewire.directive('sortable', ({el, directive, component, cleanup}) => {
    if (directive.modifiers.length > 0) return

    let options = { draggable: '[wire\\:sortable\\.item]' }

    if (el.querySelector('[wire\\:sortable\\.handle]')) {
        options.handle ='[wire\\:sortable\\.handle]'
    }

    const sortable = new Sortable(el, options);

    sortable.on('sortable:stop', () => {
        setTimeout(() => {
            let items = []

            el.querySelectorAll('[wire\\:sortable\\.item]').forEach((el, index) => {
                items.push({ order: index + 1, value: el.getAttribute('wire:sortable.item')})
            })

            component.$wire.call(directive.method, items)
        }, 0)
    })

    cleanup(() => {
        sortable.destroy()
    })
})
