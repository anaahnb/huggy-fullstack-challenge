<template>
    <svg :width="size" :height="size" viewBox="0 0 16 16" :fill="color" xmlns="http://www.w3.org/2000/svg">
      <path v-if="path" :d="path" />
    </svg>
  </template>
  
  <script>
  export default {
    props: {
      size: {
        type: [String, Number],
        default: 24
      },
      color: {
        type: String,
        default: "currentColor"
      },
      path: {
        type: String,
        default: ""
      }
    }
  };
  </script>
  