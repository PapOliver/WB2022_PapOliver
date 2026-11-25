<template>
    <div v-on:click="countClick"> 
        <h2>{{ foodName }}
            <img src="\img_quality.svg" v-show="toggleFavorite" />
        </h2>
        <p>{{ foodDesc }}</p>
        <button @click="toggleFavorite">Kedvenc</button>
    </div>
</template>

<script>

    export default{
        props: {
            foodName: { 
                type: String,
                required: true
                     },
            foodDesc: { 
                type: String,
                required: false,
                default: "Lehet, hogy nem nyers",
                validator: function(value) {
                    if(2 < value.length && value.length < 50){
                        return true;    
                     }
                    else{
                        return false;
                    }
                }
            },
            isFavorite: { 
                type: Boolean, 
                required: false,
                default: false
                        }
        },
        emits: ["toggle-favorite"],
        data(){
            return{
                //foodIsFavorite: this.isFavorite,
            }
        },methods: {
            toggleFavorite(){
                //this.foodIsFavorite = !this.foodIsFavorite;
                this.$emit("toggle-favorite", this.foodName);
            }
        }
    }
</script>

<style>
    
    img {
        height: 30px;
        float: right;
    }
</style>