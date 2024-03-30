<template>
    <button class="icon-button" @click="$emit('click')">
       <img v-if="icon" :src="iconPath"></img>
    </button>
   </template>
   
   <script>
   export default {
    name: 'IconButtonComponent',
    props: {
       icon: {
         type: String,
         required: true
       }
    },
    computed: {
       iconPath() {
         return `/icons/${this.icon}.svg`;
       }
    }
   }
   </script>
   
   <style lang="scss" scoped>

    .icon-button {
        background-color: transparent;
        border: none;
        cursor: pointer;
    }
    
    .icon-button img {
        width: 1rem;
        height: 1rem;
        fill: #505050;
    }
   </style>
   