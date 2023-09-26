
// Livewire.directive('sortable', ({el, directive, component, cleanup}) => {
//     if (directive.modifiers.length > 0) return
//
//     let options = { draggable: '[wire\\:sortable\\.item]' }
//
//     if (el.querySelector('[wire\\:sortable\\.handle]')) {
//         options.handle ='[wire\\:sortable\\.handle]'
//     }
//
//     const sortable = new Sortable(el, options);
//
//     sortable.on('sortable:stop', () => {
//         setTimeout(() => {
//             let items = []
//
//             el.querySelectorAll('[wire\\:sortable\\.item]').forEach((el, index) => {
//                 items.push({ order: index + 1, value: el.getAttribute('wire:sortable.item')})
//             })
//
//             component.$wire.call(directive.method, items)
//         }, 0)
//     })
//
//     cleanup(() => {
//         sortable.destroy()
//     })
// })

export default (Alpine) => {
    Alpine.directive('sortable', (el, directives) => {
        if (!directives.value) handleRoot(el, Alpine);
        if (directives.value === 'item') handleItem(el, Alpine);
        if (directives.value === 'handle') handleHandler(el, Alpine);
    })
}

const handleRoot = (el, Alpine) => {
    Alpine.bind(el, {
        'x-data'(){
            return {
                __items: [],
            }
        },
        '@sortable:item:stop'(){
            const items = this.$data.__items.map(item => item.getAttribute('wire:sortable.item'));
            this.$dispatch('sortable:stop', items);
        }
    })
}

const handleItem = (el, Alpine) => {
    Alpine.bind(el, {
        'x-data'(){
            return {
                __handle: null,
                __dragging: false,
                __overing: false,
                __draggable: true,
                init(){
                    this.$data.__items.push(this.$el);
                },
            }
        },
        ':draggable'(){
            return this.$data.__draggable;
        },
        ':data-dragging'(){
            return this.$data.__dragging;
        },
        ':data-overing'(){
            return this.$data.__overing;
        },
        '@dragstart'(){
            this.$data.__dragging = true;
        },
        '@drop'(){
            const element = this.$data.__items.find(item => Alpine.$data(item).__dragging);
            this.$el.compareDocumentPosition(element) === 4
                ? this.$el.before(element)
                : this.$el.after(element);
            this.$data.__overing = false;
            this.$data.__dragging = false;
            this.$data.__draggable = false;
            this.$dispatch('sortable:item:stop');
        },
        '@dragenter.prevent'(){
            this.$data.__overing = true;
        },
        '@dragover.prevent'(){
            this.$data.__overing = true;
        },
        '@dragleave.prevent'(){
            this.$data.__overing = false;
        },
        '@dragend'(){
            this.$data.__dragging = false;
            this.$data.__draggable = false;
        }

    })
}

const handleHandler = (el, Alpine) => {
    Alpine.bind(el, {
        'x-data'(){
            return {
                init(){
                    this.$data.__handle = this.$el;
                    this.$data.__draggable = false;
                }
            }
        },
        ['@mousedown.stop'](){
            this.$data.__draggable = true;
        },
        ['@mouseup.stop'](){
            this.$data.__draggable = false;
        }
    })
}
