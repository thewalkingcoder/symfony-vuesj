<script>
    export  default {
        name: 'HelloWord'
    }
</script>
<template>
    <div>
        <div class="title">Mon composant qui fait HelloWord</div>
    </div>
</template>
<style lang="scss">

    $colorTitle: #6daacb;

    .title {
        background: $colorTitle;
        color: #FFF;
        border-radius: 4px;
        padding: 10px;
        opacity: 1;
        transition: opacity 0.5s;
    }

    .title:hover{
        opacity: 0;
    }

</style>