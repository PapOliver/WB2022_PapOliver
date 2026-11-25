<template>
    <div>
        <slot statictext="Ez egy statikus szöveg" :dynamictext="text">
        </slot>
    </div>
        <slot name="leftSlot" :text="leftText" style="float: left">
        </slot>
         
        <slot name ="rightSlot" :text="rightText" style="float: right">
        </slot>

</template>

<script>
    export default {
        data() {
            return {
            leftText: "Ez a bal oldali szöveg",
            rightText: "Ez a jobb oldali szöveg"
                }
        }
    }
</script>

<style scoped>
    div{
       box-shadow: 0px 4px 8px 0px rgba(0, 0, 0, 0.2);
       border-radius: 10px;
       margin: 10px;
    }
</style>