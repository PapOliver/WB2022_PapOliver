<template>
    <div>
        <h2>Ürla Komponens</h2>
        <form @submit.prevent>
            <p>Név: <input type="text" ref="nameInput"></p>
            <button @click="">Küldés</button>
        </form>
    </div>

    <!--
    computed: {
            bgColor() {
                if (this.toggleVal) {
                    return "lightgreen";
                }
                return "lightblue";
            }
        }
    -->
</template>

<script>
    export default {
        
        data() {
            return {
                text: "WAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA",
                toggleVal: true
            }
        },

        beforeCreate() {
            this.text = "Kezdeti szöveg.";
            console.log("beforeCreate: a komponens még nem jött létre." );
        },
        created() {
            this.text = "Kezdeti szöveg a created hookban.";
            console.log("created: a komponens most jött létre.");
        },

        mounted() {
            this.$refs.nameInput.focus();
            this.$refs.nameInput.value = "13.67.69.420❤️🧑‍🦼‍➡️";
            
        },
    }
</script>

<style scoped>
    #redDiv{
        margin: 10px;
        padding: 10px;
        display: inline-block;
    }
    #redDiv:hover{
        cursor: pointer;
    }
</style>