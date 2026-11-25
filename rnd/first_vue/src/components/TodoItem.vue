<template>
    <div class="pinkball"></div>
    <li v-bind="$attrs"style="margin: '5px 0'">
        {{ itemName }}
    </li>
    <div class="pinkball"></div>
</template>

<script>
    export default{
        props: {"itemName": { 
            type: String,
            required: true}
        }
    }  
</script>