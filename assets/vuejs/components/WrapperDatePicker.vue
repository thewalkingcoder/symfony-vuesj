<script>
        import { fr } from 'vuejs-datepicker/dist/locale'
        import Datepicker from 'vuejs-datepicker';
        import moment from 'moment'

    export default {
        data () {
            return {
                fr: fr,                
            }
        },
        props: {
           inputCible:{
               type: String,
               require: true
           } 
        },
        name: "WrapperDatePicker",
        components: {
            Datepicker
        },
        methods: {
            dateSelected: function (date) {
                
                const inputCible = document.getElementById(this.inputCible)
                inputCible.value = moment(date).format('DD/MM/YYYY')                                                
            },
            dateFormat: function(date){
                return moment(date).format('DD/MM/YYYY')
            }            
        }

    }
</script>
<template>    
    <div>     
        
        <datepicker :language="fr" :format="dateFormat" @selected="dateSelected" />
    </div>
</template>