<template>
    <svg :width="size" :height="size" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
      <path d="M13.3 12.29C12.91 11.9 12.28 11.9 11.89 12.29L8 16.17V1C8 0.45 7.55 0 7 0C6.45 0 6 0.45 6 1V16.18L2.12 12.3C1.73 11.91 1.1 11.91 0.71 12.3C0.32 12.69 0.32 13.32 0.71 13.71L6.3 19.3C6.69 19.69 7.32 19.69 7.71 19.3L13.3 13.71C13.68 13.32 13.68 12.68 13.3 12.29Z" :fill="color" />
    </svg>
  </template>
  
  <script>
  export default {
    props: {
      size: {
        type: [String, String],
        default: 18
      },
      color: {
        type: String,
        default: "currentColor"
      }
    }
  };
  </script>
  