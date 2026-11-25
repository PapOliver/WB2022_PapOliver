import { createApp } from 'vue'
import App from './App.vue'

import fooditem from './components/fooditem.vue'
import todoitem from './components/TodoItem.vue'
import CompOne from './components/CompOne.vue'
import CompTwo from './components/CompTwo.vue'
import SlotComp from './components/SlotComp.vue'
import CompThree from './components/CompThree.vue'
import FoodKinds from './components/FoodKinds.vue'

createApp(App)
    .component('food-item', fooditem)
    .component('todo-item', todoitem)
    .component('comp-one', CompOne)
    .component('comp-two', CompTwo)
    .component('slot-comp', SlotComp)
    .component('comp-three', CompThree)
    .component('food-kinds', FoodKinds)
    .mount('#app')
