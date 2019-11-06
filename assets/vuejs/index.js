import Vue from 'vue'
import HelloWord from "./components/HelloWord";
import WrapperDatePicker from "./components/WrapperDatePicker";


new Vue({
    el: '#app',
    components: {
        HelloWord,
        WrapperDatePicker
    },
    data: {
        toto : "Yoooooo"
    }
});

