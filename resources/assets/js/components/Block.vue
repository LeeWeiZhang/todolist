<template id="block-template">
  <div :class="[name, 'block']">
    <div class="text name" v-on:click="removeItem(item)">@{{ name }}</div>
    <span class="delete" v-on:click="removeItem(item)">&#x2717;</span>
  </div>
</template>