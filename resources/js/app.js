import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';
import Sortable from "./sortable.js";

Alpine.plugin(Sortable);
Livewire.start()

