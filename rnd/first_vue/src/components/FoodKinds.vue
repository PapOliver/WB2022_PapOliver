<template>
    <h2>Ételek</h2>
    <div v-for="x in foods" :key="x.name">
        <img :src="x.url" :alt="x.name">
        <p>{{x.name}}</p>
    </div>

</template>

<script>
    export default {
        inject: ['foods'],
    }
</script>

<style>

</style>
